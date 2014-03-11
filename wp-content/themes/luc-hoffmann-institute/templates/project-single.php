<?php  

$banner_id = get_field( 'image', $post->ID );

$banner_post = get_post( $banner_id );

$image_src = wp_get_attachment_image_src( $banner_id, 'banner' );

$banner = array(
	'url' => $image_src[0],
	'credit' => $banner_post->post_excerpt
);
?>

<article class="Project Project--single" <?php the_ID() ?>>
	
	<div class="Project-inner">

		<div class="Project-image" style="background-image: url(<?php echo $banner['url'] ?>)"></div>

		<div class="Project-header">

			<h1 class="Project-title"><?php the_title() ?></h1>

			<div class="u-cols">
			
				<div class="u-col u-col-4of12">

					<p class="Project-author"><?php echo get_field('author') ?></p>

				</div>

				<div class="u-col u-col-8of12">

					<nav class="Project-menu">
						<ul>
							<li><a href="#">Sub-page 1</a></li>
							<li><a href="#">Sub-page 2</a></li>
							<li><a href="#">Sub-page 3</a></li>
							<li><a href="#">Sub-page 4</a></li>
						</ul>
					</nav>

				</div>

			</div><!-- .u-cols -->

		</div><!-- .Project-header -->

		<div class="Project-content entry">

			<div class="entry-content">
				<?php the_content() ?>
			</div>

		</div>

		<div class="Project-footer">
			
			<nav class="Project-footer-nav">
				<ul>
					<li><a href="#"><i class="icon-arrow-left"></i> <span>Title of Previous Project</span></a></li>
					<li><a href="#"><span>Title of Next Project</span> <i class="icon-arrow-right"></i></a></li>
				</ul>
			</nav>

		</div>

	</div>

</article>