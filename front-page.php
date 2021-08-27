<?php
/**
 * Aesthetic Body Shaping Front Page
 *
 * Custom home page template for the custom Aesthetic Body Shaping theme.
 *
 * Template Name: Home Page
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://www.studiopress.com/
 */

add_filter( 'body_class', 'miller_body_add_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function miller_body_add_body_class( $classes ) {

	$classes[] = 'miller_body-homepage';
	return $classes;

}

// Add front page scripts.
function miller_body_front_page_script() {
	if ( ! wp_is_mobile() && is_front_page() ) {
		// Animate on Scroll
		wp_enqueue_style( 'aos-style', get_stylesheet_directory_uri() . '/aos/aos.css', array(), null);
		wp_enqueue_script( 'animate-on-scroll', get_stylesheet_directory_uri() . '/aos/aos.js', false, null, true);
		wp_enqueue_script( 'animate-scripts', get_stylesheet_directory_uri() . '/js/aos-initiate.js', false, null, true);
	}
}
// add_action( 'wp_enqueue_scripts', 'miller_body_front_page_script' );

// Remove page title on home
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action('genesis_entry_content', 'home_intro');
add_action('genesis_entry_content', 'home_services');
add_action('genesis_entry_content', 'home_gallery');
add_action('genesis_entry_content', 'home_testimonials');
add_action('genesis_entry_content', 'home_form');
add_action('genesis_entry_content', 'home_maps');


function home_intro(){	?>
	<section class="intro wrap">
		<div>
			<?php the_content(); ?>
		</div>
	</section>
<?php
}

function home_services(){ ?>
  <section class="category-boxes">
		<div>
			<div>
			  <h3>CoolSculpting®</h3>
			  <p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
			  <a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
		<div>
			<div>
		  	<h3>SmartLipo®</h3>
		  	<p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
		<div>
			<div>
		  	<h3>Cellulite Treatment</h3>
		  	<p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
		<div>
			<div>
		  	<h3>Skin Tightening</h3>
		  	<p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
		<div>
			<div>
		  	<h3>Other Services</h3>
		  	<p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
		<div>
			<div>
		  	<h3>Special Offer</h3>
		  	<p>Are you frustrated that you can’t get rid of cellulite no matter how hard you try? You’ve tried special diets, exercising and purchased all types of lotions and potions with limited or no visible results.</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Learn More</a>
			</div>
		</div>
  </section>
<?php
}

function home_gallery(){ ?>
	<section class="landing-gallery wrap">
	  <h2>Before & After</h2>
	  [images here]
	</section>
<?php
}

function home_testimonials(){ ?>
	<section class="landing-testimonials wrap">
	  <h2>Patient Testimonials</h2>
	  [testimonials here]
	</section>
<?php
}

function home_form(){ ?>
	<section class="landing-form wrap">
	  <h2>Request a Consultation</h2>
	  [testimonials here]
	</section>
<?php
}

function home_maps(){ ?>
	<section class="landing-maps wrap">
	  <div class="one-half first">
			[map here]
		</div>
		<div class="one-half">
			[map here]
		</div>
	</section>
<?php
}


// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Runs the Genesis loop.
genesis();
