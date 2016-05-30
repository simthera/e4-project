<?php
    /*
     * Cache Attempt Version 1.
     *
     * This is a super basic cache concept. It takes the whole wordpress output and writes it to a file.
     * If the file is less than x old it includes the file instead of running wordpress.
     *
     */

    global $user_login;

    if(!$user_login && !is_admin()) {
        ob_start();
        add_action('init', 'cacheMain');
    }

    function shutdownCatcher()
    {
        $html = '';
        //Checking how many object levels there are.
        $levels = ob_get_level();
        for($i = 0; $i < $levels; $i++) {
            $html .= ob_get_clean();
        }
        // Apply any filters to the final output
        echo apply_filters('outputWriter', $html);
    }

    if(!is_admin()) {
        add_filter('outputWriter', function ($output) {
            //RANDOM REGEX TO FIND OUT IF MOBILE OR DESKTOP
            $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
            if(preg_match($mobile_agents, $_SERVER['HTTP_USER_AGENT'])) {
                $mobile = 'mobile';
            } else {
                $mobile = 'desktop';
            }
            // BUILDING FILE NAME BASED ON URL
            $fileName = ABSPATH . 'cache/cached-' . str_replace('/', '-', $_SERVER["REQUEST_URI"]) . '-' . $mobile . '.html';

            // Optimising all images we can
            $doc = new DOMDocument();
            @$doc->loadHTML($output);

            $imgs = $doc->getElementsByTagName('img');
            foreach($imgs as $img) {
                $src = $img->getAttribute('src');
                $url = parse_url($src);
                if((array_key_exists('host', $url) && $_SERVER['SERVER_NAME'] == $url['host']) || !array_key_exists('host', $url)) {
                    $src = '/'.\CSI\Image\ImageResizer::imageResize(0, 0, 0, false, array('cache' => $src,'quality' => 100 ));
                    //$src = CSI\Image\ImageResizer::imageResize(5 , 100, 1000, false, array('cache'));
                    if($src) {
                        $img->setAttribute('src', $src);
                    }
                }

            }

            // Cache the contents to a file
            $cached = fopen($fileName, 'w');
            fwrite($cached, $doc->saveHTML());
            fclose($cached);

            return $output;
        });
    }
    function cacheMain()
    {
        //RANDOM REGEX TO FIND OUT IF MOBILE OR DESKTOP
        $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
        if(preg_match($mobile_agents, $_SERVER['HTTP_USER_AGENT'])) {
            $mobile = 'mobile';
        } else {
            $mobile = 'desktop';
        }
        $fileName = ABSPATH . 'cache/cached-' . str_replace('/', '-', $_SERVER["REQUEST_URI"]) . '-' . $mobile . '.html';
        $time = 100;
        // Serve from the cache if it is younger than $cachetime
        if(file_exists($fileName) && time() - $time < filemtime($fileName)) {
            echo "<!-- Cached copy, generated " . date('H:i', filemtime($fileName)) . " -->\n";
            include($fileName);
            exit;
        }
        echo strtotime(time());
        add_action('shutdown', 'shutdownCatcher', 0);
    }