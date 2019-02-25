<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cambodia_Portal
 */

get_header();
the_cam_portal_breadcrumbs()
?>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="b-2">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
			<div class="b-item-wrap">
					<div class="b-item row">
						<div class="b-thumnail-wrap col-5">
							<div class="b-thumnail"><?php cam_portal_the_post_thumbnail(); ?></div>
						</div>
						<div class="b-title-wrap col-7">
							<div class="b-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div class="b-date"><?php  cam_portal_posted_on(); ?></div>
						</div>
					</div>
				</div>
				<?php
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */

			endwhile;
			
			$args = array(
						'prev_text'          => __('« ក្រោយ'),
						'next_text'          => __('បន្ទាប់ »'),
					);
			$pg = 	'<div class="pagination text-center">
						%s
					</div>';
			printf( $pg, paginate_links( $args ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

			</div>
		</div>
			<?php
			get_sidebar();
			?>
		</div><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
