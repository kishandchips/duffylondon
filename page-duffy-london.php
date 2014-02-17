<?php
/*
Template Name: Duffy London
*/
?>

<?php get_header(); ?>

<?php $id = (isset($id)) ? $id : $post->ID; ?>

<?php $args = array(
	'child_of'		=> $id,
	'title_li' 		=> '' ,
	'echo'			=> '1',
	'sort_column'	=> 'menu_order'
); ?>
<?php $pages = get_pages($args); ?>

	<div class="list-pages clearfix">
		<ul>
			<?php foreach($pages as $page){ ?>
			       <li class="span one-fourth">
			       	<a href="<?php echo $page->guid ?>" title="<?php echo $page->post_title; ?>">
			            <?php echo get_the_post_thumbnail($page->ID, 'misc-thumb'); ?>
			            <h3><?php echo $page->post_title; ?></h3>
			        </a>
			        </li>
			<?php } ?>
		</ul>
	</div>

<?php get_footer(); ?>