<section class="footer col-1-1">
    <div class="footer-contact-details">
        <?php
        $args = array(
            'posts_per_page'   => 4,
            'post_type'		   => 'contactdetails',
            'orderby'          => 'menu_order',
            'order'            => 'DESC',
            'post_status'	   => 'publish');
        $contactdetails = get_posts($args);
        ?>
        <?php foreach ($contactdetails as $region) {
            $meta = get_post_meta($contactdetails->ID);
        ?>
        <div class="col-1-4">
            <div class="pin-icon">
                <img src="<?php echo get_template_directory_uri() ?>/images/pin.gif" width="80" height="70" alt="Pin"/>
            </div>
            <h3><?php echo $region->post_title; ?></h3>
            <div class="contact-content">
                <?php echo $region->post_content; ?>
            </div>

        </div>
        <?php } ?>
    </div>
</section>
<section class="support-footer col-1-1">
    <p class="support-line">Need Help or Have a Question? <span><a href="">Support</a> </span></p>
</section>
<?php wp_footer(); ?>
</body>
</html>