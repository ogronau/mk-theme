<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
	<div class="col-md-3 widget-area" id="left-sidebar">
<?php else : ?>
	<div class="col-md-3 widget-area" id="left-sidebar">
<?php endif; ?>

    <div tabindex="-1" id="navbarNavOffcanvas" class="offcanvas offcanvas-start">

        <div class="offcanvas-header justify-content-end d-md-none d-lg-none d-xl-none d-xxl-none">
            <button type="button" class="btn-close btn-close-black text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div><!-- .offcancas-header -->

        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
        </h2>

        <!-- The WordPress Menu goes here -->
        <?php
        if (in_array(get_query_var( 'montessoriContext' ), ['kinderhaus', 'kinderdorf'])) {
            wp_nav_menu(
                array(
                    'theme_location'  => get_query_var( 'montessoriContext' ),
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav justify-content-end flex-grow-1',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    // 'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                    'walker'          => new Walker_Nav_Menu(),
                )
            );
        }
        ?>
    </div><!-- .offcanvas -->

    <?php dynamic_sidebar( 'left-sidebar' ); ?>

</div><!-- #left-sidebar -->
