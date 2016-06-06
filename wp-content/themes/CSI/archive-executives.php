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
		<h2>Executives</h2>
	</div>
	<section class="col-1-1">
		<div class="col-1-2">
			<img src="<?php echo get_template_directory_uri(); ?>/images/executives-icon.png"  alt=""/>
		</div>
		<div class="col-1-2">
			<?php
			$page_id = 70;  //Page ID
			$page_data = get_page( $page_id );

			//store page title and content in variables
			$title = $page_data->post_title;
			$content = apply_filters('the_content', $page_data->post_content);

			echo $content;
			?>
		</div>
	</section>
	<hr />
	<section class="listing-content">

		<?php while(have_posts()) : the_post(); ?>
			<?php $meta = get_post_meta(get_the_ID()); ?>
				<div class="col-1-5">
					<div class="executives-page-image">

						<img style="width:100%;" src="/<?php echo CSI\Image\ImageResizer::imageResize(get_post_thumbnail_id(get_the_ID()), 201, 200, true, array()) ?>" width="201" height="200" alt="Content Teaser Sample">
					</div>
					<div class="executives-dets">
						<?php echo the_title(); ?>
						<div class=""><?php echo $meta['csi_executive_positionposition'][0]; ?></div>
					</div>
				</div>
		<?php endwhile; ?>
	</section>
<!--	--><?php //get_footer(); ?>
</div>
