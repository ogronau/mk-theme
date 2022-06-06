<?php
/**
 * Sidebar setup for footer full
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<!-- ******************* The Footer Full-width Widget Area ******************* -->

<div class="wrapper" id="wrapper-footer-full" role="footer">

	<div id="footer-full-content" tabindex="-1">

		<footer class="<?php echo esc_attr( $container ); ?> fixed-bottom mk-footer">

			<div class="row">

				<div class="col-md-12">

			        <?php
			        wp_nav_menu(
			            array(
			                'theme_location'  => 'footer',
			                'container_class' => '',
			                'container_id'    => '',
			                'menu_class'      => '',
			                'fallback_cb'     => '',
			                'menu_id'         => 'footer-menu',
			                'depth'           => 2,
			                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			            )
			        );
			        ?>

				</div><!--col end -->

			</div>

		</footer>

	</div>

</div><!-- #wrapper-footer-full -->
