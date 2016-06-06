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

        <div class="col-1-3 about-block about-service-download">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/about_us.gif" width="120" alt="about us" class="about-us-icon"/>
            </div>
            <h2>About us</h2>

            <div class="block-content">
                <p>e4 is a technology company offering leading edge, trusted electronic solutions and services.  See more...</p>
            </div>
        </div>
        <div class="col-1-3 service-block about-service-download">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/service.gif" width="55" alt="about us" class="about-us-icon"/>
            </div>
            <h2>Services</h2>

            <div class="block-content">
                <p>e4 offers a range of Products and Servies ranging from Document Automation to Bespoke Development. See more...
                </p>
            </div>
        </div>

        <div class="col-1-3 download-block about-service-download">
            <div class="conent-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/downloads.gif" width="55" alt="about us" class="about-us-icon"/>
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
                <div class="col-1-3 products-product">
                    <div class="product-icon">
                        <img src="<?php echo \CSI\Image\ImageResizer::imageResize($meta['csi_products_sectionicon'][0],100,100,true,array()) ?>"/>
                    </div>
                    <div class="product-featured-image">
                        <img src="<?php echo \CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id($product),400,300,true,array()) ?>"/>
                    </div>


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
                    <div class="col-1-2 slider-sides">
                        <h3 class="featured-slide-heading"><span class="with-border">Featured</span>  Product</h3>
                        <div class="product-logo">
                            <img src="<?php echo \CSI\Image\ImageResizer::imageResize($meta['csi_home_page_sliderlogo'][0],600,600,true,array()) ; ?>" alt="<?php echo $product->post_title; ?>"/>
                        </div>
                        <div class="product-slider-content">
                            <?php echo $product->post_content; ?>
                        </div>
                        <div class="slider-buttons">
                            <div class="slider-button visit-website">
                                <a href="<?php echo $meta['csi_home_page_sliderlink_to_website'][0]; ?>">Visit website</a>
                            </div>
                            <div class="slider-button view-broucher">
                                <a href="<?php echo $meta['csi_home_page_sliderlink_to_broucher'][0] ?>">View Broucher</a>
                            </div>
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

            <div class="col-1-5 executives-blocks">
                <div class="executives-image">
                    <img src="<?php echo \CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id($executive),400,500,true,array()) ?>" width="100%" height="" alt="<?php echo $executive->post_title; ?>"/>
                </div>
                <div class="executives-infor-overlay">
                    <p class="executive-name"><?php echo $executive->post_title; ?></p>
                    <p class="executive-position"><?php echo $meta['csi_executive_positionposition'][0]; ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </section>

    <section class="three-featured-blocks col-1-1">

        <div class="col-1-3 block-1-featured">
            <div class="black-white-icons">
            <div class="changing-icons">
                <img src="<?php echo get_template_directory_uri(); ?>/images/career-black.png" width="70"/>
            </div>
            <div class="black-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/career-white.gif" width="70"/>
            </div>
            </div>
            <?php
            query_posts('post_type=threefeaturedblock&p=56');
            if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <p class="featured-title"><?php the_title(); ?></p>
                <p><?php the_content("Read more &raquo;"); ?></p>

            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
        <div class="col-1-3 block-1-featured">
            <div class="black-white-icons">
            <div class="changing-icons">
                <img src="<?php echo get_template_directory_uri(); ?>/images/acedemy-black.png" width="70"/>
            </div>
            <div class="black-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/acedemy-white.gif" width="70"/>
            </div>
                </div>
            <?php
            query_posts('post_type=threefeaturedblock&p=57');
            if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <p class="featured-title"><?php the_title(); ?></p>
                <p><?php the_content("Read more &raquo;"); ?></p>
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
        <div class="col-1-3 block-1-featured">
            <div class="black-white-icons">
                <div class="changing-icons">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/clients-black.png" width="55"/>
                </div>
                <div class="black-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/clients-white.gif" width="55"/>
                </div>
            </div>

            <?php
            query_posts('post_type=threefeaturedblock&p=58');
            if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <p class="featured-title"><?php the_title(); ?></p>
                <p><?php the_content(); ?></p>
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>


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
    <section>
        
    </section>

    <?php get_footer(); ?>
</div>
