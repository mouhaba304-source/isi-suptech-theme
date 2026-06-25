<?php
/**
 * Database setup, seeding, and mockup migration script for ISI SUPTECH
 *
 * Migrates static HTML contents from mockup files into the WordPress database
 * and replaces static grids with dynamic shortcodes to make pages fully editable via Elementor.
 */

// Removed WP_CLI definition to avoid conflict with plugins

define( 'WP_USE_THEMES', false );
require_once( dirname( __FILE__ ) . '/wp-load.php' );

if ( ! function_exists( 'wp_insert_post' ) ) {
    die( "Error: WordPress load failed.\n" );
}

// 1. Activate Child Theme
if ( get_stylesheet() !== 'helle-elementor-isi' ) {
    switch_theme( 'helle-elementor-isi' );
    echo "Theme activated: helle-elementor-isi\n";
}

require_once( ABSPATH . 'wp-admin/includes/media.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/image.php' );

$mockup_dir = 'C:/Users/DELL/Downloads/CMS2_maquette_ecole/';

/**
 * Extract body content from static HTML mockup and replace mock URLs with WP links
 */
function isi_extract_html_content( $filepath ) {
    if ( ! file_exists( $filepath ) ) {
        echo "Warning: Mockup file not found: $filepath\n";
        return '';
    }
    
    $html = file_get_contents( $filepath );
    
    // Extract contents between </header> and <footer>
    $start_pos = strpos( $html, '</header>' );
    $end_pos   = strpos( $html, '<footer' );
    
    if ( $start_pos !== false && $end_pos !== false ) {
        $start_pos += strlen( '</header>' );
        $content = substr( $html, $start_pos, $end_pos - $start_pos );
    } else {
        $start_pos = strpos( $html, '<body' );
        if ( $start_pos !== false ) {
            $start_pos = strpos( $html, '>', $start_pos ) + 1;
            $end_pos   = strpos( $html, '</body>' );
            if ( $end_pos !== false ) {
                $content = substr( $html, $start_pos, $end_pos - $start_pos );
            } else {
                $content = substr( $html, $start_pos );
            }
        } else {
            $content = $html;
        }
    }
    
    // Replace mockup paths with live WP permalinks
    $replacements = array(
        'isi-suptech-maquette.html' => home_url( '/' ),
        'formations.html'           => home_url( '/formations/' ),
        'admissions.html'           => home_url( '/admissions/' ),
        'vie-etudiante.html'         => home_url( '/vie-etudiante/' ),
        'a-propos.html'             => home_url( '/a-propos/' ),
        'contact.html'              => home_url( '/contact/' ),
        'actualites.html'           => home_url( '/actualites/' ),
        'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&q=70' => get_stylesheet_directory_uri() . '/admission-photo.jpg',
        
        // Location replacements (Ivory Coast -> Senegal)
        "Cote d'Ivoire" => "Sénégal",
        "Côte d'Ivoire" => "Sénégal",
        "Cocody Angre" => "Sacré-Cœur 3",
        "Cocody" => "Sacré-Cœur",
        "Abidjan 08" => "Dakar",
        "Abidjan" => "Dakar",
        "contact@isi-suptech.ci" => "contact@isi-suptech.sn",
        "finance@isi-suptech.ci" => "finance@isi-suptech.sn",
        "http://isi-suptech.ci" => "http://isi-suptech.sn",
        "https://isi-suptech.ci" => "https://isi-suptech.sn",
        "+225 27 22" => "+221 33 824",
        "+225 07" => "+221 77 123",
        "+225 05" => "+221 78 456",
        "+225" => "+221"
    );
    
    foreach ( $replacements as $key => $val ) {
        $content = str_replace( $key, $val, $content );
    }
    
    return trim( $content );
}

/**
 * Find the position of the matching closing tag for a given open tag position
 */
function isi_find_matching_close_tag( $html, $start_pos, $tag_name = 'div' ) {
    $len = strlen( $html );
    $pos = $start_pos;
    $depth = 0;
    
    $open_pattern = '<' . $tag_name;
    $close_pattern = '</' . $tag_name;
    
    while ( $pos < $len ) {
        $next_open = strpos( $html, $open_pattern, $pos );
        $next_close = strpos( $html, $close_pattern, $pos );
        
        if ( $next_close === false ) {
            return false;
        }
        
        if ( $next_open !== false && $next_open < $next_close ) {
            $depth++;
            $pos = $next_open + strlen( $open_pattern );
        } else {
            $depth--;
            if ( $depth === 0 ) {
                return $next_close;
            }
            $pos = $next_close + strlen( $close_pattern );
        }
    }
    return false;
}

/**
 * Get or create page and load mockup HTML into post_content with shortcodes
 */
function isi_migrate_page_content( $title, $slug, $mockup_filename, $template = '' ) {
    global $mockup_dir;
    
    $html_content = isi_extract_html_content( $mockup_dir . $mockup_filename );
    
    // Add page-specific dynamic shortcode replacements
    if ( $slug === 'formations' ) {
        // Replace Licences & BTS grid
        $bts_start = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-16">';
        $pos = strpos( $html_content, $bts_start );
        if ( $pos !== false ) {
            $pos_close = isi_find_matching_close_tag( $html_content, $pos, 'div' );
            if ( $pos_close !== false ) {
                $html_content = substr_replace( $html_content, "[isi_programmes niveau=\"premier_cycle\"]", $pos, $pos_close + 6 - $pos );
            }
        }
        
        // Replace Masters grid
        $masters_start = '<div class="grid grid-cols-1 lg:grid-cols-2 gap-7">';
        $pos_m = strpos( $html_content, $masters_start );
        if ( $pos_m !== false ) {
            $pos_close_m = isi_find_matching_close_tag( $html_content, $pos_m, 'div' );
            if ( $pos_close_m !== false ) {
                $html_content = substr_replace( $html_content, "[isi_programmes niveau=\"master\"]", $pos_m, $pos_close_m + 6 - $pos_m );
            }
        }
        echo "--> Injected program grid shortcodes in Formations page content.\n";
        
    } elseif ( $slug === 'actualites' ) {
        // Replace the entire content grid (featured post + grid + sidebar) with [isi_actualites]
        $blog_start = '<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">';
        $pos_blog = strpos( $html_content, $blog_start );
        if ( $pos_blog !== false ) {
            $pos_close_blog = isi_find_matching_close_tag( $html_content, $pos_blog, 'div' );
            if ( $pos_close_blog !== false ) {
                $html_content = substr_replace( $html_content, "[isi_actualites]", $pos_blog, $pos_close_blog + 6 - $pos_blog );
            }
        }
        echo "--> Injected [isi_actualites] blog shortcode in Actualites page content.\n";
        
    } elseif ( $slug === 'vie-etudiante' ) {
        // Replace the static upcoming events grid with [isi_evenements]
        $events_start = '<div class="grid grid-cols-1 md:grid-cols-3 gap-5">';
        $pos_ev = strpos( $html_content, $events_start );
        if ( $pos_ev !== false ) {
            $pos_close_ev = isi_find_matching_close_tag( $html_content, $pos_ev, 'div' );
            if ( $pos_close_ev !== false ) {
                $html_content = substr_replace( $html_content, "[isi_evenements]", $pos_ev, $pos_close_ev + 6 - $pos_ev );
            }
        }
        echo "--> Injected [isi_evenements] events shortcode in Vie Etudiante page content.\n";
    }
    
    $page = get_page_by_path( $slug );
    
    if ( ! $page ) {
        $page_id = wp_insert_post( array(
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_content' => $html_content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            echo "Created page: $title (ID: $page_id)\n";
            update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
            update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
            if ( $template ) {
                update_post_meta( $page_id, '_wp_page_template', $template );
            }
            return $page_id;
        }
    } else {
        wp_update_post( array(
            'ID'           => $page->ID,
            'post_content' => $html_content,
        ) );
        echo "Updated page content in database: $title (ID: {$page->ID})\n";
        
        update_post_meta( $page->ID, '_elementor_edit_mode', 'builder' );
        update_post_meta( $page->ID, '_elementor_template_type', 'wp-page' );
        if ( $template ) {
            update_post_meta( $page->ID, '_wp_page_template', $template );
        }
        return $page->ID;
    }
    return null;
}

echo "\n--- MIGRATING MOCKUP PAGES TO WORDPRESS DATABASE ---\n";
$home_id = isi_migrate_page_content( 'Accueil', 'accueil', 'isi-suptech-maquette.html' );
isi_migrate_page_content( 'Admissions', 'admissions', 'admissions.html', 'page-admissions.php' );
isi_migrate_page_content( 'Vie Etudiante', 'vie-etudiante', 'vie-etudiante.html', 'page-vie-etudiante.php' );
isi_migrate_page_content( 'A Propos', 'a-propos', 'a-propos.html', 'page-a-propos.php' );
isi_migrate_page_content( 'Contact', 'contact', 'contact.html', 'page-contact.php' );
isi_migrate_page_content( 'Formations', 'formations', 'formations.html', 'page-formations.php' );
isi_migrate_page_content( 'Actualites', 'actualites', 'actualites.html', 'page-actualites.php' );

echo "\n--- CONFIGURING WORDPRESS OPTIONS ---\n";
if ( $home_id ) {
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $home_id );
    echo "Static homepage set to Accueil (ID: $home_id)\n";
}

// Disable Elementor default color and typography schemes to respect theme CSS
update_option( 'elementor_disable_color_schemes', 'yes' );
update_option( 'elementor_disable_typography_schemes', 'yes' );
echo "Elementor default colors and typography disabled.\n";

global $wp_rewrite;
$wp_rewrite->set_permalink_structure( '/%postname%/' );
$wp_rewrite->flush_rules( true );
echo "Permalinks set to /%postname%/\n";

echo "\n--- SYSTEM MIGRATION COMPLETE ---\n";
