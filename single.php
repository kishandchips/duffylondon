<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<?php the_title( ); ?>
				<?php the_content(); ?>
				<?php the_post_thumbnail( ); ?>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>