<?php 
/**
 * The project archive
 */
get_header();

// set up query
$query = array(
	'post_type' => 'project',
    'posts_per_page' => -1,
    'post_parent' => 0,
    'orderby' => 'menu_order',
    'order' => 'DESC'
);

/**
 * Filter by status
 */
$status = 'current';
$statuses = array(
	array(
		'title' => 'Pending Projects',
		'slug' => 'pending'
	),
	array(
		'title' => 'Current Projects',
		'slug' => 'current'
	),
	array(
		'title' => 'Completed Projects',
		'slug' => 'completed'
	)
);

$status_values = array_map(function ($status) {
	return $status['slug'];
}, $statuses);

// check if status is passed as URL arg
if ( isset($_GET['status']) && in_array($_GET['status'], $status_values) )
{
	$status = $_GET['status'];
}

if ($status !== 'all')
{
	$query['meta_query'] = array(
		array(
			'key' => 'status',
			'value' => $status
		)
	);
}

/**
 * Filter by work stream
 */
$work_stream = 'all';
$work_streams = get_categories(array(
    'taxonomy' => 'work_streams'
));

$work_stream_values = array_map(function ($stream) {
	return $stream->slug;
}, $work_streams);

// check if work stream is passed as URL arg
if ( isset($_GET['stream']) && in_array($_GET['stream'], $work_stream_values) )
{
	$work_stream = $_GET['stream'];
}

if ($work_stream !== 'all') 
{
	$query['tax_query'][] = array(
		'taxonomy' => 'work_streams',
		'field' => 'slug',
		'terms' => $work_stream
	);
}

/**
 * Filter by theme
 */
$theme = 'all';
$themes = get_categories(array(
	'taxonomy' => 'project_themes'
));

$theme_values = array_map(function ($item) {
	return $item->slug;
}, $themes);

// check if theme is passed as URL arg
if ( isset($_GET['theme']) && in_array($_GET['theme'], $theme_values) ) 
{
	$theme = $_GET['theme'];
}

if ($theme !== 'all') 
{
	$query['tax_query'][] = array(
		'taxonomy' => 'project_themes',
		'field' => 'slug',
		'terms' => $theme
	);
}


$projects = new WP_Query( $query );
?>

	<section class="Projects Projects--list">
		
		<div class="u-container">

			<header class="Projects-header">

				<form class="Filter-menu" action="">

					<div class="Filter-menu-content">

						<?php if (isset($statuses) && !empty($statuses)) : ?>

							<span class="Select Filter-menu-item">	
								<select name="status" id="">
									<?php foreach ($statuses as $value) : ?>
										<option value="<?php echo $value['slug'] ?>"<?php if ($value['slug'] === $status) echo ' selected="selected"' ?>><?php echo $value['title'] ?></option>
									<?php endforeach ?>
								</select>
							</span>

						<?php endif ?>

						<?php if (isset($work_streams) && !empty($work_streams)) : ?>

							<span class="Select Filter-menu-item">	
								<select name="stream" id="">
									<option value="all">All Work Streams</option>
									<?php foreach ($work_streams as $value) : ?>
										<option value="<?php echo $value->slug ?>"<?php if ($value->slug === $work_stream) echo ' selected="selected"' ?>><?php echo $value->name ?></option>
									<?php endforeach ?>
								</select>
							</span>

						<?php endif ?>

						<?php if (isset($themes) && !empty($themes)) : ?>

							<span class="Select Filter-menu-item">	
								<select name="theme" id="">
									<option value="all">All Themes</option>
									<?php foreach ($themes as $value) : ?>
										<option value="<?php echo $value->slug ?>"<?php if ($value->slug === $theme) echo ' selected="selected"' ?>><?php echo $value->name ?></option>
									<?php endforeach ?>
								</select>
							</span>

						<?php endif ?>

					</div>

					<div class="Filter-menu-content u-no-js">
						<span class="Filter-menu-item">
							<button type="submit">Submit</button>
						</span>
					</div>

				</form>

			</header>

			<div>
			
				<?php if ( $projects->have_posts() ) : ?>

					<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

	       				<?php get_template_part( 'templates/project' ); ?>

					<?php endwhile ?>

				<?php else : ?>

					<p style="text-align: center; color: #fff;">No projects were found matching your selection.</p>

				<?php endif ?>

			</div>

			<?php wp_reset_postdata(); ?>

		</div>

	</section>

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>