<?php
    /**
     * Page
     */
?>
<?php get_header(); ?>
    <div class="grid grid-pad">
        <div class="col-8-12">
            <div class="content">
                <?php while(have_posts()) : the_post(); ?>
                    <section class="page-title">
                        <h1><?php the_title() ?></h1>
                    </section>
                    <h4><?php print date('d M Y', strtotime(get_the_date())); ?></h4>
                    <div class="col-1-1">
                        <div class="content">
                            <?php echo get_the_excerpt() ?>
                            <hr/>
                            <?php if(get_post_thumbnail_id(get_the_ID())) { ?>
                                <img style="width: 100%;" src="/<?php echo CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id(get_the_ID()), 1000, 1000, false, array()) ?>" alt="<?php the_title() ?>">
                            <?php } ?>
                            <?php the_content() ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>