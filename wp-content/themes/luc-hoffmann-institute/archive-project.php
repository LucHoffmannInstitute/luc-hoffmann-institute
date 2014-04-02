<?php 
/**
 * The project archive
 */
get_header();

$query = array(
	'post_type' => 'project',
    'posts_per_page' => -1,
    'post_parent' => 0,
    'orderby' => 'menu_order',
    'order' => 'DESC'
);

$status_values = array('pending', 'current', 'completed', 'all');

$status = 'current';

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

$projects = new WP_Query( $query );

?>

	<section class="Projects Projects--list">
		
		<div class="u-container">

			<header class="Projects-header">

				<form class="Filter-menu" action="">

					<div class="Filter-menu-content">

						<span class="Select Filter-menu-item">	
							<select name="darin" id="">
								<option value="current">Current Projects</option>
								<option value="pending">Pending Projects</option>
								<option value="past">Past Projects</option>
							</select>
						</span>

						<span class="Select Filter-menu-item">	
							<select name="darin" id="">
								<option value="">All Work Streams</option>
								<option value="place-based-conservation-effectiveness">Place Based Conservation Effectiveness</option>
								<option value="natural-capital-and-ecosystem-services">Natural Capital and Ecosystem Services</option>
								<option value="sustainable-consumption-and-production">Sustainable Consumption and Production</option>
							</select>
						</span>

						<span class="Select Filter-menu-item">	
							<select name="darin" id="">
								<option value="current">All Themes</option>
							</select>
						</span>

					</div>

				</form>

			</header>

			<div>
			
				<?php if ( $projects->have_posts() ) : ?>

					<?php while ( $projects->have_posts() ) : $projects->the_post() ?>

	       				<?php get_template_part( 'templates/project' ); ?>

					<?php endwhile ?>

				<?php endif ?>

			</div>

			<?php wp_reset_postdata(); ?>

		</div>

	</section>

    <?php get_template_part( 'templates/page-footer' ) ?>

<?php get_footer() ?>