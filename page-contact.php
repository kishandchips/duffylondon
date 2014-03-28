<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="contact row">
		<div class="page-header">
				<h2 class="text-frame gold"><?php the_title(); ?></h2>
		</div>

		<div class="form span seven">	
				<?php the_content(); ?>
		</div>

		<div class="span three">
			<?php $image = get_field('map_picture'); ?>
			<a href="<?php the_field('map_directions'); ?>" title="Google Map Directions to Duffy London">
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			</a>

			<div class="details">
				<?php the_field('details'); ?>
				<a href="<?php the_field('map_directions'); ?>" title="Google Map Directions to Duffy London" target="_blank">Get directions on google maps.</a>
			</div>
		</div>
	</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>