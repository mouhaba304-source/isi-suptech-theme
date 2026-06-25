<?php
/**
 * Front page template - front-page.php
 *
 * Renders the home page content from the database, allowing full editing via Elementor.
 *
 * @package hello-elementor-isi
 */

defined('ABSPATH') || die();

get_header();

while ( have_posts() ) : the_post();
    the_content();
endwhile;

get_footer();
