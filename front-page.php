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

add_action('genesis_entry_content', 'landing_intro');
add_action('genesis_entry_content', 'landing_services');
add_action('genesis_entry_content', 'landing_gallery');
add_action('genesis_entry_content', 'landing_testimonials');

function landing_intro(){	?>
	<section class="intro wrap">
			<?php the_content(); ?>
	</section>
<?php
}

function landing_services(){ ?>
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
		  	<p><span>$250 OFF</span> CoolSculpting®</p>
		  	<a href="#" class="button" title="Visit the CoolSculpting® page">Book Now</a>
			</div>
		</div>
  </section>
<?php
}

function landing_gallery(){ ?>
	<section class="landing-gallery wrap">
	  <h2 class="ornate">Gallery</h2>

	</section>
<?php
}

function landing_testimonials(){ ?>
	<section class="landing-testimonials wrap">
	  <h2 class="ornate">Testimonial</h2>
		<div>
			<a class="button" class="Visit testimonials page">Read More Testimonials</a>
			<a class="button" title="Write us a testimonial">Tell Us About Your Experience</a>
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
