<?php
    /**
     * Single Example
     */
?>
<?php get_header(); ?>
    <div class="grid grid-pad">
        <div class="col-8-12">
            <div class="content">
                <?php while(have_posts()) : the_post(); ?>
                    <h1><?php the_title() ?></h1>
                    <h4><?php print date('d M Y', strtotime(get_the_date())); ?></h4>
                    <p><?php echo get_the_excerpt() ?></p>

                    <div class="col-6-12">
                        <div class="content">
                            <h2>Basic WP Content</h2>
                            <img style="width: 100%;" src="/<?php echo CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id(get_the_ID()),500,500,false,array()) ?>" alt="<?php the_title() ?>">
                            <?php the_content() ?>
                        </div>
                    </div>
                    <div class="col-6-12">
                        <div class="content">
                            <h2>Content Added With Custom Fields</h2>
                            <?php
                                $meta = get_post_meta(get_the_ID());
                                foreach($meta as $key => $val) {
                                    echo '<p>';
                                    echo $key . ' - - ' . $val[0];
                                    echo '</p>';
                                }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>