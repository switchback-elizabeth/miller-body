<?php
/**
 * Aesthetic Body Shaping.
 *
 * This file adds functions to the Aesthetic Body Shaping theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'miller_body_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function miller_body_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Admin area Message
function remove_footer_admin () {
echo 'Site powered by <a href="https://www.pumc.com" title="Visit PUMC.com">PUMC</a>. Need help? Email <a href="mailto:pumcweb@pumc.com" title="Send an email">pumcweb@pumc.com</a>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Remove title tag support to enable force rewrites in Yoast SEO
remove_theme_support( 'title-tag' );

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'miller_body_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function miller_body_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- see https://core.trac.wordpress.org/ticket/49742
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		null
	);

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

	// Typekit Fonts
	wp_enqueue_style( 'miller-body-typekit-fonts', '//use.typekit.net/ljt4kli.css');

}

add_filter( 'body_class', 'miller_body_body_classes' );
/**
 * Add additional classes to the body element.
 *
 * @since 3.4.1
 *
 * @param array $classes Classes array.
 * @return array $classes Updated class array.
 */
function miller_body_body_classes( $classes ) {

	if ( ! genesis_is_amp() ) {
		// Add 'no-js' class to the body class values.
		$classes[] = 'no-js';
	}
	return $classes;
}

add_action( 'genesis_before', 'miller_body_js_nojs_script', 1 );
/**
 * Echo the script that changes 'no-js' class to 'js'.
 *
 * @since 3.4.1
 */
function miller_body_js_nojs_script() {

	if ( genesis_is_amp() ) {
		return;
	}

	?>
	<script>
	//<![CDATA[
	(function(){
		var c = document.body.classList;
		c.remove( 'no-js' );
		c.add( 'js' );
	})();
	//]]>
	</script>
	<?php
}

add_filter( 'wp_resource_hints', 'miller_body_resource_hints', 10, 2 );
/**
 * Add preconnect for Google Fonts.
 *
 * @since 3.4.1
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function miller_body_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( genesis_get_theme_handle() . '-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = [
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		];
	}

	return $urls;
}

add_action( 'after_setup_theme', 'miller_body_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function miller_body_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

// Allow Gravity Form to be embedded in theme file
gravity_form_enqueue_scripts( 1, false );

add_action( 'after_setup_theme', 'miller_body_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function miller_body_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 702, 526, true );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove support for structural wraps
remove_theme_support( 'genesis-structural-wraps' );

// Remove the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );

// Add Mega Menu
function miller_body_menu(){
	wp_nav_menu( array( 'theme_location' => 'primary' ) );
}
add_action( 'genesis_header', 'miller_body_menu', 14 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 20 );

add_filter( 'wp_nav_menu_args', 'miller_body_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function miller_body_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'miller_body_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function miller_body_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'miller_body_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function miller_body_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

// Footer
add_action('genesis_before_footer', 'footer_form');
add_action('genesis_before_footer', 'footer_maps');

// Reposition the footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_after_footer', 'genesis_footer_widget_areas', 1 );

function footer_form(){ ?>
	<section class="landing-form wrap">
	  <?php gravity_form( 1, true, false, false, '', false ); ?>
	</section>
<?php
}

function footer_maps(){ ?>
	<section class="landing-maps wrap">
	  <div class="one-half first">
			<div class="card">
				<h4>Salem Office</h4>
				<address>
					224 Main Street, Suite 1-D
					<br/>Salem, NH 03079</address>
					<a href="tel:6038983461" title="Call now"><span class="number">603-898-3461</span></a>
					<img src="/wp-content/themes/miller-body/images/map-salem.jpg" title="Salem office location" alt="Map of the Salem area around AVCMD"/>
			</div>
		</div>
		<div class="one-half">
			<div class="card">
				<h4>Nashua Office</h4>
				<address>
					400 Amherst Street, Suite 402
					<br/>Nashua, NH 03063</address>
					<a href="tel:6038983461" title="Call now"><span class="number">603-898-3461</span></a>
					<img src="/wp-content/themes/miller-body/images/map-nashua.jpg" title="Nashua office location" alt="Map of the Nashua area around AVCMD"/>
			</div>
		</div>
	</section>
<?php
}
