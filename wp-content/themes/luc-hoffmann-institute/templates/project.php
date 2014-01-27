<?php 
	$image_src = wp_get_attachment_image_src( get_field('image'), 'banner' );
	$image_caption = get_post( get_field( 'image' ) );

	$project_image = array(
		'url' => $image_src[0],
		'caption' => $image_caption->post_excerpt
	);
?>

<article class="project" id="<?php the_ID() ?>">

    <div class="container">
        <a class="projects-link" href="<?php get_bloginfo('url') ?>/projects/"><i class="icon-arrow-left"></i>All projects</a>
    </div>

	<div class="project-thumb" style="background-image: url(<?php echo $project_image['url'] ?>);"></div>

    <div class="container">

        <header class="project-header">
            <p class="project-supertitle"><?php the_field('supertitle') ?></p>
            <h1 class="project-title"><?php the_field('title') ?></h1>
            <div class="project-subtitle">
                <p><?php the_field('subtitle') ?></p>
                <a class="project-link" href="<?php the_permalink() ?>"><?php the_field('link_text') ?> <i class="icon-arrow-right"></i></a>
            </div>
        </header>
	
		<p class="photo-credit"><?php echo $project_image['caption'] ?></p>

    </div>

</article>