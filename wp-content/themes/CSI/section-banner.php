<?php
/**
 * Created by PhpStorm.
 * User: smetshile
 * Date: 2016/05/30
 * Time: 12:01 PM
 */
$args = array(
    'posts_per_page'   => 1,
    'post_type'		   => 'banner',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_status'	   => 'publish');
$banners = get_posts($args);

foreach ($banners as $banner) {
    $meta = get_post_meta($banner->ID); ?>
    <img src="/<?php echo \CSI\Image\ImageResizer::imageResize($meta['csi_bannerbanner_image'][0],1700,500,true,array()) ?>" alt="E4 strategig" width="100%" height="500"/>
<?php }