<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DOK_Blog
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		get_template_part( 'template-parts/content', 'home' ); ?>

		<div class="entry-content">
			<div class="ultimos-artigos">
				<h2><?= __( 'Últimos artigos', 'dok-blog' ) ?></h2>
				<ul class="lista">
				<?php	
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'post' );

				endwhile; // End of the loop.
				?>
				</ul>
				<?php
				dok_blog_pagination(); ?>
			</div>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php //dok_blog_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
