<?php
    /**
     * Archive Example
     */
?>
<?php get_header(); ?>
    <section class="page-title">
        <div class="grid grid-pad">
            <div class="col-8-12">
                <h1><?php post_type_archive_title(); ?></h1>
            </div>
        </div>
    </section>
    <section class="listing-content">
        <div class="grid grid-pad">
            <div class="col-8-12">
                <div class="content">
                    <?php while(have_posts()) : the_post(); ?>
                        <section id="content_<?php the_ID() ?>">
                            <div class="col-4-12">
                                <img style="width:100%;" src="/<?php echo CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id(get_the_ID()), 201, 151, true, array()) ?>" width="201" height="151" alt="Content Teaser Sample">
                                <?php echo date('d M Y', strtotime(get_the_date())); ?>
                            </div>
                            <div class="col-8-12">
                                <div class="content">
                                    <h2 class="teaser-title">
                                        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo the_title() ?>"><?php echo the_title() ?></a>
                                    </h2>
                                    <?php echo the_excerpt() ?>
                                </div>
                            </div>
                        </section>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </section>
<?php get_footer(); ?>