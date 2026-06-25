<?php
/**
 * Template Name: Page Contact
 *
 * Renders the Contact page content from the database, allowing full editing via Elementor.
 *
 * @package hello-elementor-isi
 */

defined('ABSPATH') || die();

get_header();

while ( have_posts() ) : the_post();
    ?>
    <main id="content" <?php post_class( 'site-main' ); ?>>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </main>
    <?php
endwhile;

get_footer();
