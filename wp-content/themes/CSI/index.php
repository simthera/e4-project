<?php get_header(); ?>
    <?php get_template_part('content','banner'); ?>
    <div class="grid grid-pad">
        <div class="col-1-4">
            <div class="content">
                <h3>Image with Lightbox</h3>
                <a class="fancybox" href="<?php echo get_template_directory_uri() ?>/Screenshot.jpg">
                    <img width="300" src="/<?php echo CSI\Image\ImageResizer::imageResize(0 , 100, 1000, false, array('cache'=>get_template_directory_uri().'/Screenshot.jpg')) ?>" />

                </a>
                <img src="/<?php echo CSI\Image\ImageResizer::imageResize(5 , 100, 1000, false, array()) ?>" alt="Image resizer"/>
                <a href="#" class="more-link right">Read More</a>
            </div>
        </div>
        <div class="col-1-4">
            <div class="content">
                <h3>This is a paragraph heading - H3</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="#" class="more-link right">Read More</a>
            </div>
        </div>
        <div class="col-1-4">
            <div class="content">
                <h3>This is a paragraph heading - H3</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="#" class="more-link right">Read More</a>
            </div>
        </div>
        <div class="col-1-4">
            <div class="content">
                <h3>This is a paragraph heading - H3</h3>
                <h4>Intro Text - H4 Lorem ipsum dolor sit amet, consectetur adipisicing elit,</h4>

                <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="#" class="more-link right">Read More</a>
            </div>
        </div>
    </div>
<?php get_footer(); ?>