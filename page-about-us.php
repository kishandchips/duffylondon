<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div class="about row">
		<div class="span five no-gutter">
			<div class="page-header">
					<h2 class="text-frame gold"><?php the_title(); ?></h2>
			</div>
			<div id="content">

				<?php the_content(); ?>

			</div>
		</div>

		<div class="span five no-gutter">
			<?php $image = get_field('image'); ?>
			<img class="bio-img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
		</div>
	</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>