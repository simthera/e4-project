<?php
//	/**
//	 * Archive __NAME__
//	 */
//?>
<div class="col-3-12 ">
	<div class="left-bar">
		<?php get_header(); ?>
	</div>
</div>
<div class="col-9-12 right-side">
	<section class="banner">
		<?php get_template_part('section','banner'); ?>
	</section>
	<div class="col-1-1 section-header">
		<h2>Career's</h2>
	</div>
	<section class="first-white-section col-1-1">
		<div class="col-1-2  section-icon-side">
			<img src="<?php echo get_template_directory_uri(); ?>/images/career-black.png" width="100" alt=""/>
		</div>
		<div class="col-1-2 left-border">
			<?php
			$page_id = 72;  //Page ID
			$page_data = get_page( $page_id );

			//store page title and content in variables
			$title = $page_data->post_title;
			$content = apply_filters('the_content', $page_data->post_content);

			echo $content;
			?>
		</div>

	</section>
	<div class="col-1-1 section-header">
		<h2>BEE</h2>
	</div>
	<section class="col-1-1 bee-section">
		<div class="bee-icon">
			<img src="<?php echo get_template_directory_uri(); ?>/images/bee-icon.png" width="80"/>
		</div>
	<div class="bee-content">
		<div class="col-1-2 bee-content-blocks with-white-border">
			<?php
			$page_id = 74;  //Page ID
			$page_data = get_page( $page_id );

			//store page title and content in variables
			$title = $page_data->post_title;
			$content = apply_filters('the_content', $page_data->post_content);

			echo $content;
			?>
		</div>
		<div class="col-1-2 bee-content-blocks certificate-side">
			<?php
			$page_id = 74;  //Page ID
			$page_data = get_page( $page_id );

			//store page title and content in variables
			$title = $page_data->post_title;
			$excerpt = apply_filters('the_excerpt',$page_data->post_excerpt);
			$content = apply_filters('the_content', $page_data->post_content);
			?>
			<div class="the-excerpt"> <?php echo $excerpt?></div>
		</div>

	</div>


	</section>
<!--		--><?php //get_footer(); ?>
</div>
