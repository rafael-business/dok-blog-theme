<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DOK_Blog
 */

$hero = get_posts( array(
	'include'	=> '9330,9970,9434'
));

$destaques = array();
for ( $i = 0; $i < count( $hero ); $i++ ) {
	
	$destaques[$i]['id'] 		= $hero[$i]->ID;

	$categories = get_the_category( $hero[$i]->ID );
	$category_list = join( ', ', wp_list_pluck( $categories, 'name' ) );
	$destaques[$i]['cats'] = wp_kses_post( $category_list );

	$destaques[$i]['title'] 	= $hero[$i]->post_title;
	$destaques[$i]['date'] 	= $hero[$i]->post_date;
	$destaques[$i]['thumb'] 	= get_the_post_thumbnail_url( $hero[$i]->ID, 'full' );
	$destaques[$i]['link'] 		= get_permalink( $hero[$i]->ID );
}

$hero_default = get_the_post_thumbnail_url( $destaques[0]['id'], 'full' );

$carousel = get_posts( array(
	'include'	=> '9330,9970,9434'
));

$mais_lidos = array();
for ( $i = 0; $i < count( $carousel ); $i++ ) {
	
	$mais_lidos[$i]['id'] 		= $carousel[$i]->ID;
	$mais_lidos[$i]['title'] 	= $carousel[$i]->post_title;
	$mais_lidos[$i]['thumb'] 	= get_the_post_thumbnail_url( $carousel[$i]->ID, 'mais-lidos-thumb' );
	$mais_lidos[$i]['link'] 	= get_permalink( $carousel[$i]->ID );
}

$carousel_default = get_the_post_thumbnail_url( $mais_lidos[0]['id'], 'mais-lidos-thumb' );

$page = 0;

$list = get_posts( array(
	'posts_per_page'	=> 6, 
	'page'				=> $page, 
));

$ultimos_artigos = array();
for ( $i = 0; $i < count( $list ); $i++ ) { 
	
	$ultimos_artigos[$i]['id'] 		= $list[$i]->ID;

	$categories 					= get_the_category( $list[$i]->ID );
	$category_list 					= join( ', ', wp_list_pluck( $categories, 'name' ) );
	$ultimos_artigos[$i]['cats'] 	= wp_kses_post( $category_list );

	$ultimos_artigos[$i]['title'] 	= $list[$i]->post_title;
	$ultimos_artigos[$i]['date'] 	= $list[$i]->post_date;
	$ultimos_artigos[$i]['thumb'] 	= get_the_post_thumbnail_url( $list[$i]->ID, 'full' );
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-hero" style="background-image: url(<?= $hero_default ?>);">
		<div class="sub-hero">
			<div class="entry-content">
				<?php
				for ( $j = 0; $j < count( $destaques ); $j++ ) {

					$date = ucfirst( wp_date( 'F d, Y', strtotime( $destaques[$j]['date'] ) ) );
				?>
				<div class="controls" data-id="<?= $destaques[$j]['id'] ?>" data-thumb="<?= $destaques[$j]['thumb'] ?>" data-link="<?= $destaques[$j]['link'] ?>">
					<span class="category"><?= $destaques[$j]['cats'] ?></span>
					<h2 class="title"><?= $destaques[$j]['title'] ?></h2>
					<div class="wp-date"><?= $date ?></div>
				</div>
				<?php
				}
				?>
			</div>
		</div>
    </div>
	<div class="entry-content">
		<div class="mais-lidas">
			<h2><?= __( 'Mais lidas', 'dok-blog' ) ?></h2>
			<div class="carousel">
				<?php
				for ( $k = 0; $k < count( $mais_lidos ); $k++ ) {
				?>
				<a href="<?= $mais_lidos[$k]['link'] ?>">
					<div class="post" style="background-image: url(<?= $mais_lidos[$k]['thumb'] ?>);">
						<h2 class="title"><?= $mais_lidos[$k]['title'] ?></h2>
						<div class="post-grad"></div>
					</div>
				</a>
				<?php
				}
				?>
			</div>
			<div class="controls">
				<a title="anterior" class="arrow arrow-left"></a>
				<a title="próxima" class="arrow arrow-right"></a>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
