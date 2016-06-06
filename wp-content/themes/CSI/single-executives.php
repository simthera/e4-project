<?php
	/**
	 * Single __NAME__
	 */
?>
	<div>
		<?php get_header(); ?>

		<?php while(have_posts()) : the_post(); ?>
			<?php the_title() ?>
			<?php the_content() ?>
			<?php
			$meta = get_post_meta(get_the_ID());
			foreach($meta as $key => $val) {
				echo '<p>';
				echo $key . ' - - ' . $val[0];
				echo '</p>';
			}
			?>

		<?php endwhile; ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>