<div class="col-3-12 ">
    <div class="left-bar">
        <?php get_header(); ?>
    </div>
</div>

<div class="col-9-12 right-side">
    <section class="banner">
        <?php get_template_part('section','banner'); ?>
    </section>

    <section class="featured-content-blocks col-1-1">

        <div class="col-1-3">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/about_us.gif" alt="about us" class="about-us-icon"/>
            </div>
            <h2>About us</h2>

            <div class="block-content">
                <p>e4 is a technology company offering leading edge, trusted electronic solutions and services.  See more...</p>
            </div>
        </div>
        <div class="col-1-3">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/service.gif" alt="about us" class="about-us-icon"/>
            </div>
            <h2>Services</h2>

            <div class="block-content">
                <p>e4 offers a range of Products and Servies ranging from Document Automation to Bespoke Development. See more...
                </p>
            </div>
        </div>

        <div class="col-1-3">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/service.gif" alt="about us" class="about-us-icon"/>
            </div>
            <h2>Downloads</h2>

            <div class="block-content">
                <p>For more information on Signup documents, Support info, Installation files, Hardware brochures and
                    Hardware support click here...</p>
            </div>
        </div>
    </section>
    <section class="products-section">
        <div class="col-1-1 section-header">
            <h2>e4 PRODUCTS</h2>
        </div>

        <div class="products-blocks">
            <?php
            $args = array(
                'posts_per_page'   => 6,
                'post_type'		   => 'products',
                'orderby'          => 'menu_order',
                'order'            => 'DESC',
                'post_status'	   => 'publish');
            $products = get_posts($args);

            foreach ($products as $product) {
                $meta = get_post_meta($product->ID);
                ?>
                <div class="col-1-3">
                    <img src="<?php echo \CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id($product),400,300,true,array()) ?>"/>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="section-header col-1-1">
        <h3>SEE MORE PRODUCTS & SERVICES ></h3>
    </section>
    <section class="col-1-1 slider-section">
        <?php
        $args = array(
            'posts_per_page'   => -1,
            'post_type'		   => 'products',
            'orderby'          => 'menu_order',
            'order'            => 'DESC',
            'post_status'	   => 'publish');
        $products = get_posts($args);


        ?>

        <ul class="bxslider">
            <?php foreach ($products as $product) {
            $meta = get_post_meta($product->ID); ?>
            <li>
            <div class="col-1-2">
                <div class="product-logo">
                    <img src="<?php echo \CSI\Image\ImageResizer::imageResize($meta['csi_home_page_sliderlogo'][0],600,600,true,array()) ; ?>" alt="<?php echo $product->post_title; ?>"/>
                </div>
                <div class="product-slider-content">
                    <?php echo $product->post_content; ?>
                </div>
            </div>
                <div class="col-1-2">
                    <img src="<?php echo \CSI\Image\ImageResizer::imageResize($meta['csi_home_page_sliderfeatured_image'][0],600,600,true,array())  ?>" width="400" alt="Broucher"/>
                </div>
            </li>
            <?php } ?>
        </ul>

    </section>
    <div class="col-1-1 section-header">
        <h2>Executives</h2>
    </div>

    <section class="executives">
        <?php
        $args = array(
            'posts_per_page'   => 5,
            'post_type'		   => 'executives',
            'orderby'          => 'menu_order',
            'order'            => 'DESC',
            'post_status'	   => 'publish');
        $executives = get_posts($args);

        foreach ($executives as $executive) {
            $meta = get_post_meta($executive->ID); ?>

            <div class="col-1-5">
                <img src="<?php echo \CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id($executive),400,500,true,array()) ?>" width="100%" height="" alt="<?php echo $executive->post_title; ?>"/>
            </div>
            <?php
        }
        ?>
    </section>

    <section class="three-featured-blocks col-1-1">
        <?php
        $args = array(
            'posts_per_page'   => 5,
            'post_type'		   => 'threefeaturedblock',
            'orderby'          => 'menu_order',
            'order'            => 'DESC',
            'post_status'	   => 'publish');
        $threefeaturedblock = get_posts($args);

        foreach ($threefeaturedblock as $featured) {
            $meta = get_post_meta($featured->ID); ?>
            <div class="col-1-3 block-1-featured">
                <p class="featured-title"> <?php echo $featured->post_title; ?></p>
                <p><?php echo $featured->post_content; ?></p>
            </div>
        <?php } ?>
    </section>

    <section class="bee-news col-1-1">
        <div class="news-and-bee">
            <?php

            $args = array(
                'posts_per_page'   => 2,
                'post_type'		   => 'beeandnews',
                'orderby'          => 'menu_order',
                'order'            => 'DESC',
                'post_status'	   => 'publish');
            $beeandnews = get_posts($args);

            foreach ($beeandnews as $feat) {
                $meta = get_post_meta($feat->ID);
                ?>
                <div class="col-1-2 <?php echo $feat->post_title; ?> ">
                    <div class="featured-elements">
                        <div class="featured-icon"><img src="<?php echo \CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id($feat),100,100,true,array()) ?>" alt="<?php echo $feat->post_title; ?>"/></div>
                        <p class="featured-title"><?php echo $feat->post_title; ?></p>
                        <p class="featured-content"><?php echo $feat->post_content; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php get_footer(); ?>
</div>
