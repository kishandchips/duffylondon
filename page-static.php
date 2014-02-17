<?php
/*
Template Name: Static Page
*/
?>

<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div class="page-header">
				<h2 class="text-frame gold"><?php the_title(); ?></h2>
		</div>
		<div id="content">

			<?php the_content(); ?>

		</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>