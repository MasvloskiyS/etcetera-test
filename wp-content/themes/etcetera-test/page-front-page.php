<?php /* Template Name: Front Page */

get_header(); ?>

<?php echo do_shortcode('[building_filter][/building_filter]'); ?>
<section id="primary" class="content-area col-sm-12 col-lg-8">
	<main id="main" class="site-main" role="main">


		<?php
		if (have_posts()) :

			if (is_home() && !is_front_page()) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

		<?php
			endif;

			/* Start the Loop */
		
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/home-content', 'page' );

			endwhile; // End of the loop.
		

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif; ?>
	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
