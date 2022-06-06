<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar-expand-md navbar-dark mk-header" aria-labelledby="main-nav-label">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">
			<div class="col-12">
				<button class="navbar-toggler mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			<div class="col-12 mt-3 mb-1">
				<a href="/<?php echo get_query_var( 'montessoriContext' );?>" rel="home" aria-current="page">
					<img width="180" height="81" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-header.png" class="img-fluid" alt="Montessori Bad Salzuflen">
				</a>
			</div>
			<div class="col-12">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'kontext',
						'container_class' => get_query_var( 'montessoriContext' ),
						'container_id'    => '',
						'menu_class'      => '',
						'fallback_cb'     => '',
						'menu_id'         => 'context-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div>

		</div>

	</div><!-- .container(-fluid) -->

</nav><!-- .site-navigation -->
