<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DOK_Blog
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="entry-content">
			<div class="footer-top">
				<div>
					<img src="<?= get_stylesheet_directory_uri() ?>/img/dok_logo_rodape.svg">
				</div>
				<div>
					Acompanhe nas redes
					<div class="icons">
						<img src="<?= get_stylesheet_directory_uri() . '/img/linkedin.svg' ?>" alt="Linkedin">
						<img src="<?= get_stylesheet_directory_uri() . '/img/facebook.svg' ?>" alt="Facebook">
						<img src="<?= get_stylesheet_directory_uri() . '/img/instagram.svg' ?>" alt="Instagram">
						<img src="<?= get_stylesheet_directory_uri() . '/img/twitter.svg' ?>" alt="Twitter">
					</div>
				</div>
			</div>
			<hr />
			<div class="menus">
				<div class="top">
					<div class="atend">
						<h3><?= __( 'Atendimento:', 'dok-blog' ) ?></h3>
						<ul>
							<li><a class="phone" href="#">(11) 2391-7703</a></li>
							<li><a class="whatsapp" href="#">Whatsapp</a></li>
							<li><a class="chat" href="#">Chat</a></li>
							<li><a class="messenger" href="#">Messenger</a></li>
						</ul>
					</div>
					<div class="app">
						<h3><?= __( 'Baixe nosso app', 'dok-blog' ) ?></h3>
						<a href="#">
							<img src="<?= get_stylesheet_directory_uri() . '/img/apple_store.svg' ?>">
						</a>
						<a href="#">
							<img src="<?= get_stylesheet_directory_uri() . '/img/google_play.svg' ?>">
						</a>
					</div>
					<div class="aval">
						<h3><?= __( 'Avaliações', 'dok-blog' ) ?></h3>
						<a href="#">
							<img src="<?= get_stylesheet_directory_uri() . '/img/reclame_aqui.svg' ?>">
						</a>
						<a href="#">
							<img src="<?= get_stylesheet_directory_uri() . '/img/afiliado.svg' ?>">
						</a>
					</div>
				</div>
				<div class="bottom">
					
				</div>
			</div>
			<hr />
			<div class="site-info">
				<strong>Despachante DOK Copyright © 2012 - <?= date('Y') ?></strong><br />
				Todos os direitos reservados (CNPJ: 27.838.743/0001-91) | Credencial CRDD 004130-1
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
