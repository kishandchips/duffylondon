<?php $id = (isset($id)) ? $id : $post->ID; ?>
<?php if($content = get_the_content()): ?>
<div class="page-content">
	<div class="inner container">
		<?php the_content(); ?>
	</div>
</div>
<?php endif; ?>
<?php $i = 0; ?>
<?php if(get_field('content', $id)): ?>
<?php while (has_sub_field('content', $id)) : ?>
<?php
	$layout = get_row_layout();
	switch($layout){

		case 'row':	
			if(get_sub_field('column')):
?>
			<div class="row" style="<?php the_sub_field('css'); ?>">

				<?php $total_columns = count( get_sub_field('column', $id)); ?>
				<?php while (has_sub_field('column', $id)) : ?>
					<?php
					switch($total_columns){
						case 2:
							$class = 'five';
							break;
						case 3:
							$class = 'one-third';
							break;
						case 4:
							$class = 'one-fourth';
							break;
						case 5:
							$class = 'one-fifth';
							break;
						case 6:
							$class = 'one-sixth';
							break;
						case 1:
						default:
							$class = 'ten';
							break;
					} ?>
					<div class="break-on-tablet span <?php echo $class; ?>" style="<?php the_sub_field('css'); ?>">
						<?php the_sub_field('content'); ?>
					</div>
				<?php endwhile; ?>

			</div>
			<?php endif; ?>
			<?php break;
		case 'scroller':
			if(get_sub_field('item')):
				$style = get_sub_field('style');
				$show_pagination = get_sub_field('show_pagination');
			?>
					<div class="scroller style-<?php echo $style; ?>" style="<?php the_sub_field('css'); ?>">
						<?php if($show_pagination): ?>
						<ul class="scroller-pagination">
							<?php $i = 0; ?>
							<?php while (has_sub_field('item', $id)) : ?><?php if($title = get_sub_field('title')): ?><li><a class="btn" data-id="<?php echo $i; ?>"><?php echo $title; ?></a></li><?php endif; ?><?php $i++; ?><?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<div class="scroller-mask">
						<?php $i = 0; ?>
						<?php while (has_sub_field('item', $id)) : ?>
							<?php $image = get_sub_field('image'); ?>
							<div class="scroll-item" data-id="<?php echo $i; ?>" style="<?php if($style != '3'): ?>background-image: url(<?php echo $image['url']; ?>);<?php endif; ?> <?php the_sub_field('css'); ?>">
								<div class="container inner">
									<?php if($style == 3): ?>
									<img src="<?php  echo $image['url']; ?>" />
									<?php endif; ?>
									<div class="content">
										<?php if(get_sub_field('title')): ?><h3 class="text-center"><?php the_sub_field('title'); ?></h3><?php endif; ?>
										<?php echo (get_sub_field('content')) ? the_sub_field('content') : ''; ?>
									</div>
								</div>
							</div>
							<?php $i++; ?>
						<?php endwhile; ?>
						</div>
						<div class="scroller-navigation">
							<a class="btn prev-btn"></a>
							<a class="btn next-btn"></a>
						</div>
					</div>

		<?php	endif;?>
		<?php break; ?>

		<?php case 'about_us': ?>
		<div class="span five">
			<div class="about-text-column">
				<?php if(get_sub_field('about_us_section')): ?>
 
    			<?php while(has_sub_field('about_us_section')): ?>
    			<div class="about-text-row">
    				<h3><?php the_sub_field('about_us_paragraph_title') ?></h3>
    				<?php the_sub_field('about_us_paragraph_content'); ?>
    			</div>
    			<?php endwhile; ?>
 				<?php endif;?>
			</div>
		</div>

		<div class="span four">
			<div class="about-text-column">
				<div class="exhibition-list">
					<h3>Exhibitions</h3>
					<ul>
						<?php if(get_sub_field('exhibition_list')): ?>
    					<?php while(has_sub_field('exhibition_list')): ?>
						<li>
	    					<?php if(get_sub_field('enter_exhibition')): ?>
	    					<?php while(has_sub_field('enter_exhibition')): ?>
	    					<!-- <li> -->
								<ul>
									<li><b><?php the_sub_field('year') ?></b></li>
									<p><?php the_sub_field('list') ?></p>
								</ul>
							<!-- </li> -->
							<?php endwhile; ?>
							<?php endif; ?>
						</li>
						<?php endwhile; ?>
 						<?php endif;?>
 					</ul>
 				</div>
 			</div>
 		</div>

						
		<?php	
		break;
		?>
		
		<?php
		case 'steps':
			if(get_sub_field('step')):
		?>
			<div class="steps">
				<?php $i = 0; ?>
				<?php while (has_sub_field('step', $id)) : ?>
				<?php 
					$content = get_sub_field('content');
					$content_image = get_sub_field('content_image');
					$main_image = get_sub_field('main_image');
					$class_ary = array('content-container', 'image-container');
				?>
					<div class="step <?php if(!$content) echo 'no-content'; ?>">
						<div class="inner container">

							<?php if($content): ?>
								<div class="span five omega <?php echo $class_ary[$i % 2];//echo ($i % 2 == 0) ? 'content-container' : ''; ?>">
									<?php if($i % 2): ?>
									<img src="<?php echo $main_image['url']; ?>" />
									<?php else: ?>
									<img src="<?php echo $content_image['url']; ?>" />
									<div class="content">
										<div class="circle number"><?php echo $i + 1; ?></div>
										<?php echo $content; ?>
									</div>
									<?php endif; ?>
								</div>
								<div class="span five alpha <?php echo $class_ary[($i + 1) % 2]; ?>">
									<?php if($i % 2): ?>
									<img src="<?php echo $content_image['url']; ?>" />
									<div class="content">
										<div class="circle number"><?php echo $i + 1; ?></div>
										<?php echo $content; ?>
									</div>
									<?php else: ?>
									<img src="<?php echo $main_image['url']; ?>" />
									<?php endif; ?>
								</div>
							<?php else: ?>
							<div class="circle number"><?php echo $i + 1; ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php $i++; ?>
				<?php endwhile; ?>
			</div>
		<?php
			endif;
			break; 
		case 'downloads':
			if(get_sub_field('file')):
		?>
			<ul class="downloads">
				<?php while (has_sub_field('file', $id)) : ?>
				<?php 
					$file = get_sub_field('file'); 
					$size = size_format(filesize( get_attached_file( $file['id'] ) ));
					$file_type = wp_check_filetype($file['url']);
				?>
				<li class="file">
					<a href="<?php echo $file['url']; ?>" target="_blank" class="clearfix">
						<div class="thumbnail">
							<img src="<?php echo get_template_directory_uri(); ?>/images/icons/document.png" />
						</div>
						<div class="content span seven push-two">
							<h4 class="title blue"><?php echo $file['title']; ?></h4>
							<div class="meta-data">
								<p><span class="uppercase file-type"><?php echo $file_type['ext']; ?></span>, <span class="size"><?php echo $size; ?></span></p>
							</div>
						</div>
						<i class="arrow icon-download circle"></i>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php
			endif;
			break; ?>
		
	<?php } ?>

<?php $i++; ?>
<?php endwhile; ?>
<?php endif; ?>