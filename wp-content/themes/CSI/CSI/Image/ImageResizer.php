<?php
namespace CSI\Image;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Class ImageResizer
 *
 * Busy adapting to work within a wordpress environment and cleaning up very old code.
 * Currently a black box that takes a wordpress id and resizes the image. Outputs new file to disk.
 *
 * @package CSI\Image
 */
class ImageResizer {
    const PIC_QUALITY = 80;

    static function imageResize($id,$width,$height,$crop,$config) {
        if (!$id && !array_key_exists('cache',$config)) {
            return false;
        }
        if($id !=0) {
            $url = wp_get_attachment_image_src($id, 'full');
            if(!$url) {
                return false;
            }
            $url = parse_url($url[0]);
            $url = ltrim($url['path'], '/');
        }else{
            $url = parse_url($config['cache']);
            $info = getimagesize(ABSPATH.$url['path']);
            $width = $info[0];
            $height = $info[1];
            $url = ABSPATH.ltrim($url['path'], '/');
            $crop = false;
        }

        $src = $url;

        if (!(int)$width && !(int)$height) {
            throw new \Exception('Please provide a width and height for the resized image');
        }

        $config['src'] = $src;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['crop'] = $crop;

        if(array_key_exists('copy',$config)) {
            $config['copy'] = substr($config['copy'], 0, 1) == "/" ? substr($config['copy'], 1) : $config['copy'];
            $config['copy'] = substr($config['copy'], -1) == "/" ? substr($config['copy'], 0, -1) : $config['copy'];

            $copyDir = DOCUMENT_ROOT.'copied/'.$config['copy'].'/';
            $pathInfo = pathinfo($config['src']);

            if(file_exists($copyDir.$pathInfo['basename'])) {
                $config['src'] = $copyDir.$pathInfo['basename'];
            }else{
                //will only allow single folder to be created.  why would you need to go deeper?
                if(!is_dir($copyDir)) {
                    mkdir($copyDir, 0777, true);
                    chmod($copyDir, 0777); //gotta chmod cause of a bug in mkdir's perm settings
                }
                //gotta str_replace  spaces, cause url encode uses "+" for some arb reason
                //if(copy($pathInfo['dirname'].'/'.str_replace(' ', '%20', $pathInfo['basename']), $copyDir.$pathInfo['basename'])) {
                //removed the str_replace as apprently it was giving issues with 'the holiday club' project. didn't get a chance to test and understand why. speak to shaun@wwc or buks@wwc for more
                if(copy($pathInfo['dirname'].'/'.$pathInfo['basename'], $copyDir.$pathInfo['basename'])) {
                    $config['src'] = $copyDir.$pathInfo['basename'];
                }else{
                    return false; //cant copy the file if we cant open it :(
                }
            }
        }

        if(file_exists($config["src"]) && function_exists("gd_info")) {
            $info = getimagesize($config["src"]);
            switch($info[2]) {
                case IMAGETYPE_GIF :
                    $createfrom_function = "imagecreatefromgif";
                    $saveas_function = "imagegif";
                    break;
                case IMAGETYPE_JPEG :
                    $createfrom_function = "imagecreatefromjpeg";
                    $saveas_function = "imagejpeg";
                    //use the passed quality it found. If not, use the defined constant PIC_QUALITY (defined in your site's settings). If that isn't found, use 100
                    $quality = array_key_exists('quality',$config) ? $config["quality"] : self::PIC_QUALITY ? self::PIC_QUALITY : 100;
                    break;
                case IMAGETYPE_PNG :
                    $createfrom_function = "imagecreatefrompng";
                    $saveas_function = "imagepng";
                    //use the passed quality it found. If not, use the defined constant PIC_QUALITY (defined in your site's settings). If that isn't found, use 100
                    $quality = array_key_exists('quality',$config) ? $config["quality"] : self::PIC_QUALITY ? self::PIC_QUALITY : 100;
                    $quality = ceil(($quality - 10) / 10); //quality is 0-9 in pngs
                    break;
                default	:
                    return 'No Image Type';
            }

            $pathInfo = pathinfo($config["src"]);
            $extLen = strlen($pathInfo["extension"]) + 1;
            $newFile = $pathInfo["dirname"]."/".substr($pathInfo["basename"], 0, ($extLen *= -1))."_".$config["width"]."x".$config["height"].($config["crop"] ? "_crop" : "").(array_key_exists('greyscale',$config) ? "_grey" : "").($quality ? "_".$quality : "").".".$pathInfo["extension"];

            if(file_exists($newFile)) { //create it if not created already
                $newFile = str_replace($_SERVER['DOCUMENT_ROOT'].'/','',$newFile);
                return $newFile;
            }else{
                $image = $createfrom_function($config['src']);
                // Get original width and height
                $width = imagesx($image);
                $height = imagesy($image);

                $destW = $config['width'];
                $destH = $config['height'];

                // don't allow new width or height to be greater than the original
                if($destW > $width) {
                    $destW = $width;
                }
                if($destH > $height) {
                    $destH = $height;
                }

                // generate new w/h if not provided
                if($destW && !$destH) {
                    $destH = $height * ($destW / $width);
                } elseif($destH && !$destW) {
                    $destW = $width * ($destH / $height);
                } elseif(!$destW && !$destH) {
                    $destW = $width;
                    $destH = $height;
                }

                if($config['crop']) {
                    $srcX = $srcY = 0;
                    $srcW = $width;
                    $srcH = $height;

                    $cmp_x = $width  / $destW;
                    $cmp_y = $height / $destH;

                    // calculate x or y coordinate and width or height of source
                    if ( $cmp_x > $cmp_y ) {
                        $srcW = round(($width / $cmp_x * $cmp_y));
                        $srcX = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
                    } elseif ($cmp_y > $cmp_x) {
                        $srcH = round(($height / $cmp_y * $cmp_x));
                        $srcY = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
                    }

                    //just make sure all the args are set nice and standard for the copy
                    $destX = 0;
                    $destY = 0;
                } else {
                    if($destW && $destH) {
                        //not allowed to grow, so fit sizes into original image sizes
                        $destW = $destW < $info[0] ? $destW : $info[0];
                        $destH = $destH < $info[1] ? $destH : $info[1];

                        $xPerc = $destW / $info[0] * 100;
                        $yPerc = $destH / $info[1] * 100;

                        //calc smallest ratio, and use that to get other side proportional size
                        if($xPerc >= $yPerc) {
                            $destW = round($info[0] * $yPerc / 100);
                        }else{
                            $destH = round($info[1] * $xPerc / 100);
                        }
                    }else if($destW && !$destH){
                        $destW = $destW < $info[0] ? $destW : $info[0];
                        $perc = $destW / $info[0] * 100;
                        $destH = round($info[1] * $perc / 100);
                    }else if(!$destW && $destH){
                        $destH = $destH < $info[1] ? $destH : $info[1];
                        $perc = $destH / $info[1] * 100;
                        $destW = round($info[0] * $perc / 100);
                    }

                    $destX = 0;
                    $destY = 0;
                    $srcX = 0;
                    $srcY = 0;
                    $srcW = $width;
                    $srcH = $height;
                }

                if(array_key_exists('greyscale',$config)){
                    imagefilter($image, IMG_FILTER_GRAYSCALE);
                }

                $canvas = imagecreatetruecolor($destW, $destH);

                //check transparency and alow for it
                if($info[2] == IMAGETYPE_GIF || $info[2] == IMAGETYPE_PNG) { //copied and adapted off 3rd party script. Thanks random dude :)
                    $trnprt_indx = imagecolortransparent($image);

                    // If we have a specific transparent color
                    if ($trnprt_indx >= 0) {
                        // Get the original image's transparent color's RGB values
                        $trnprt_color = imagecolorsforindex($image, $trnprt_indx);

                        // Allocate the same color in the new image resource
                        $trnprt_indx = imagecolorallocate($canvas, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                        // Completely fill the background of the new image with allocated color.
                        imagefill($canvas, 0, 0, $trnprt_indx);

                        // Set the background color for new image to transparent
                        imagecolortransparent($canvas, $trnprt_indx);
                    }elseif ($info[2] == IMAGETYPE_PNG) {	// Always make a transparent background color for PNGs that don't have one allocated already
                        // Turn off transparency blending (temporarily)
                        imagealphablending($canvas, false);

                        // Create a new transparent color for image
                        $color = imagecolorallocatealpha($canvas, 0, 0, 0, 127);

                        // Completely fill the background of the new image with allocated color.
                        imagefill($canvas, 0, 0, $color);

                        // Restore transparency blending
                        imagesavealpha($canvas, true);
                    }
                }

                imagecopyresampled($canvas, $image, $destX, $destY, $srcX, $srcY, $destW, $destH, $srcW, $srcH);

                $args = array($canvas, $newFile);
                if($quality) {
                    $args[] = $quality;
                }

                call_user_func_array($saveas_function, $args);
                imagedestroy($image);
                imagedestroy($canvas);
                $newFile = str_replace($_SERVER['DOCUMENT_ROOT'].'/','',$newFile);
                return $newFile; //return the path to the new file!
            }
        }else{
            return false;
        }


    }
}