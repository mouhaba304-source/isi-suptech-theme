<?php
/**
 * Thème enfant "Hello Elementor ISI" - functions.php
 *
 * @package hello-elementor-isi
 */

defined('ABSPATH') || die();

/**
 * Enfiler correctement les styles du thème parent et de l'enfant
 */
function isi_child_enqueue_styles()
{
    // Récupère l'URI du thème parent
    $parent_style = 'hello-elementor-style';
    $parent_version = wp_get_theme(get_template())->get('Version');

    // Charger le style du thème parent
    wp_enqueue_style(
        $parent_style,
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_version
    );

    // Charger le style du thème enfant (en dépendance du parent)
    wp_enqueue_style(
        'hello-elementor-isi-style',
        get_stylesheet_uri(),
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'isi_child_enqueue_styles');

?>
<?php
/**
 * ===============================================
 * TYPES DE CONTENU PERSONNALISÉS (CPT)
 * Pour ISI SUPTECH
 * ===============================================
 */

// ===============================================
// 1. CPT : PROGRAMMES (formations)
// ===============================================

function isi_register_programme_cpt()
{

    $labels = array(
        'name' => _x('Programmes', 'Post Type General Name', 'isi-suptech'),
        'singular_name' => _x('Programme', 'Post Type Singular Name', 'isi-suptech'),
        'menu_name' => __('Programmes', 'isi-suptech'),
        'name_admin_bar' => __('Programme', 'isi-suptech'),
        'archives' => __('Archives des Programmes', 'isi-suptech'),
        'attributes' => __('Attributs du Programme', 'isi-suptech'),
        'parent_item_colon' => __('Programme Parent :', 'isi-suptech'),
        'all_items' => __('Tous les Programmes', 'isi-suptech'),
        'add_new_item' => __('Ajouter un nouveau Programme', 'isi-suptech'),
        'add_new' => __('Ajouter un Programme', 'isi-suptech'),
        'new_item' => __('Nouveau Programme', 'isi-suptech'),
        'edit_item' => __('Modifier le Programme', 'isi-suptech'),
        'update_item' => __('Mettre à jour le Programme', 'isi-suptech'),
        'view_item' => __('Voir le Programme', 'isi-suptech'),
        'view_items' => __('Voir les Programmes', 'isi-suptech'),
        'search_items' => __('Rechercher un Programme', 'isi-suptech'),
        'not_found' => __('Aucun programme trouvé', 'isi-suptech'),
        'not_found_in_trash' => __('Aucun programme dans la corbeille', 'isi-suptech'),
        'featured_image' => __('Image du programme', 'isi-suptech'),
        'set_featured_image' => __('Définir l\'image du programme', 'isi-suptech'),
        'remove_featured_image' => __('Supprimer l\'image du programme', 'isi-suptech'),
        'use_featured_image' => __('Utiliser comme image du programme', 'isi-suptech'),
        'insert_into_item' => __('Insérer dans le programme', 'isi-suptech'),
        'uploaded_to_this_item' => __('Téléchargé pour ce programme', 'isi-suptech'),
        'items_list' => __('Liste des programmes', 'isi-suptech'),
        'items_list_navigation' => __('Navigation des programmes', 'isi-suptech'),
        'filter_items_list' => __('Filtrer les programmes', 'isi-suptech'),
    );

    $args = array(
        'label' => __('Programme', 'isi-suptech'),
        'description' => __('Les formations proposées par ISI SUPTECH', 'isi-suptech'),
        'labels' => $labels,
        'supports' => array(
            'title',           // Titre du programme
            'editor',          // Description complète
            'excerpt',         // Résumé / accroche
            'thumbnail',       // Image à la une
            'custom-fields',   // Pour les champs personnalisés
            'page-attributes', // Pour l'ordre d'affichage
        ),
        'taxonomies' => array('category'), // Utiliser les catégories WordPress
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-book-alt', // Icône : livre
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_in_rest' => true, // IMPORTANT : compatible avec Elementor
        'rewrite' => array(
            'slug' => 'programme',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        ),
        'capability_type' => 'post',
    );

    register_post_type('programme', $args);
}
add_action('init', 'isi_register_programme_cpt', 0);

// ===============================================
// 2. CPT : ACTUALITÉS (articles de blog)
// ===============================================

function isi_register_actualite_cpt()
{

    $labels = array(
        'name' => _x('Actualités', 'Post Type General Name', 'isi-suptech'),
        'singular_name' => _x('Actualité', 'Post Type Singular Name', 'isi-suptech'),
        'menu_name' => __('Actualités', 'isi-suptech'),
        'name_admin_bar' => __('Actualité', 'isi-suptech'),
        'archives' => __('Archives des Actualités', 'isi-suptech'),
        'attributes' => __('Attributs de l\'Actualité', 'isi-suptech'),
        'parent_item_colon' => __('Actualité Parent :', 'isi-suptech'),
        'all_items' => __('Toutes les Actualités', 'isi-suptech'),
        'add_new_item' => __('Ajouter une nouvelle Actualité', 'isi-suptech'),
        'add_new' => __('Ajouter une Actualité', 'isi-suptech'),
        'new_item' => __('Nouvelle Actualité', 'isi-suptech'),
        'edit_item' => __('Modifier l\'Actualité', 'isi-suptech'),
        'update_item' => __('Mettre à jour l\'Actualité', 'isi-suptech'),
        'view_item' => __('Voir l\'Actualité', 'isi-suptech'),
        'view_items' => __('Voir les Actualités', 'isi-suptech'),
        'search_items' => __('Rechercher une Actualité', 'isi-suptech'),
        'not_found' => __('Aucune actualité trouvée', 'isi-suptech'),
        'not_found_in_trash' => __('Aucune actualité dans la corbeille', 'isi-suptech'),
        'featured_image' => __('Image de l\'actualité', 'isi-suptech'),
        'set_featured_image' => __('Définir l\'image de l\'actualité', 'isi-suptech'),
        'remove_featured_image' => __('Supprimer l\'image de l\'actualité', 'isi-suptech'),
        'use_featured_image' => __('Utiliser comme image de l\'actualité', 'isi-suptech'),
        'insert_into_item' => __('Insérer dans l\'actualité', 'isi-suptech'),
        'uploaded_to_this_item' => __('Téléchargé pour cette actualité', 'isi-suptech'),
        'items_list' => __('Liste des actualités', 'isi-suptech'),
        'items_list_navigation' => __('Navigation des actualités', 'isi-suptech'),
        'filter_items_list' => __('Filtrer les actualités', 'isi-suptech'),
    );

    $args = array(
        'label' => __('Actualité', 'isi-suptech'),
        'description' => __('Les actualités et événements de ISI SUPTECH', 'isi-suptech'),
        'labels' => $labels,
        'supports' => array(
            'title',           // Titre
            'editor',          // Contenu
            'excerpt',         // Résumé
            'thumbnail',       // Image à la une
            'custom-fields',   // Champs personnalisés
            'comments',        // Commentaires (optionnel)
            'author',          // Auteur
            'trackbacks',      // Trackbacks
        ),
        'taxonomies' => array('category', 'post_tag'), // Catégories + Tags
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-megaphone', // Icône : mégaphone
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_in_rest' => true, // Compatible avec Elementor
        'rewrite' => array(
            'slug' => 'actualite',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        ),
        'capability_type' => 'post',
    );

    register_post_type('actualite', $args);
}
add_action('init', 'isi_register_actualite_cpt', 0);

// ===============================================
// 3. TAXONOMIES PERSONNALISÉES (optionnel)
// ===============================================

// Taxonomie : "Type de programme" (Licence, Master, BTS)
function isi_register_type_programme_taxonomy()
{

    $labels = array(
        'name' => _x('Types de programme', 'Taxonomy General Name', 'isi-suptech'),
        'singular_name' => _x('Type de programme', 'Taxonomy Singular Name', 'isi-suptech'),
        'menu_name' => __('Types', 'isi-suptech'),
        'all_items' => __('Tous les types', 'isi-suptech'),
        'parent_item' => __('Type parent', 'isi-suptech'),
        'parent_item_colon' => __('Type parent :', 'isi-suptech'),
        'new_item_name' => __('Nouveau type', 'isi-suptech'),
        'add_new_item' => __('Ajouter un type', 'isi-suptech'),
        'edit_item' => __('Modifier le type', 'isi-suptech'),
        'update_item' => __('Mettre à jour le type', 'isi-suptech'),
        'view_item' => __('Voir le type', 'isi-suptech'),
        'search_items' => __('Rechercher un type', 'isi-suptech'),
        'not_found' => __('Aucun type trouvé', 'isi-suptech'),
        'no_terms' => __('Aucun type', 'isi-suptech'),
        'items_list' => __('Liste des types', 'isi-suptech'),
        'items_list_navigation' => __('Navigation des types', 'isi-suptech'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true, // Comme des catégories
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true, // Compatible avec Elementor
        'rewrite' => array('slug' => 'type-programme'),
    );

    register_taxonomy('type_programme', array('programme'), $args);
}
add_action('init', 'isi_register_type_programme_taxonomy', 0);

// Taxonomie : "Catégorie d'actualité" (Événement, Partenariat, etc.)
function isi_register_categorie_actualite_taxonomy()
{

    $labels = array(
        'name' => _x('Catégories d\'actualité', 'Taxonomy General Name', 'isi-suptech'),
        'singular_name' => _x('Catégorie d\'actualité', 'Taxonomy Singular Name', 'isi-suptech'),
        'menu_name' => __('Catégories', 'isi-suptech'),
        'all_items' => __('Toutes les catégories', 'isi-suptech'),
        'add_new_item' => __('Ajouter une catégorie', 'isi-suptech'),
        'edit_item' => __('Modifier la catégorie', 'isi-suptech'),
        'search_items' => __('Rechercher une catégorie', 'isi-suptech'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'categorie-actualite'),
    );

    register_taxonomy('categorie_actualite', array('actualite'), $args);
}
add_action('init', 'isi_register_categorie_actualite_taxonomy', 0);

// ===============================================
// 4. CHAMPS PERSONNALISÉS POUR LES PROGRAMMES
// ===============================================

// Ajouter des meta boxes
function isi_add_programme_meta_boxes()
{
    add_meta_box(
        'isi_programme_details',
        'Détails du programme',
        'isi_programme_details_callback',
        'programme',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'isi_add_programme_meta_boxes');

// Contenu des meta boxes
function isi_programme_details_callback($post)
{
    // Récupérer les valeurs existantes
    $duree = get_post_meta($post->ID, '_isi_duree', true);
    $diplome = get_post_meta($post->ID, '_isi_diplome', true);
    $places = get_post_meta($post->ID, '_isi_places', true);
    $taux_insertion = get_post_meta($post->ID, '_isi_taux_insertion', true);
    $niveau = get_post_meta($post->ID, '_isi_niveau', true);

    // Sécurité : nonce
    wp_nonce_field('isi_programme_nonce', 'isi_programme_nonce');
    ?>

    <style>
        .isi-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 10px 0;
        }

        .isi-meta-field {
            margin-bottom: 10px;
        }

        .isi-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1d2327;
        }

        .isi-meta-field input,
        .isi-meta-field select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .isi-meta-field input:focus,
        .isi-meta-field select:focus {
            border-color: #1f4085;
            box-shadow: 0 0 0 1px #1f4085;
            outline: none;
        }

        .isi-meta-description {
            color: #646970;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>

    <div class="isi-meta-grid">
        <div class="isi-meta-field">
            <label for="isi_niveau">Niveau d'études</label>
            <select id="isi_niveau" name="isi_niveau">
                <option value="">Sélectionner...</option>
                <option value="Bac+2" <?php selected($niveau, 'Bac+2'); ?>>Bac+2 (BTS)</option>
                <option value="Bac+3" <?php selected($niveau, 'Bac+3'); ?>>Bac+3 (Licence)</option>
                <option value="Bac+5" <?php selected($niveau, 'Bac+5'); ?>>Bac+5 (Master)</option>
            </select>
            <div class="isi-meta-description">Sélectionnez le niveau de la formation.</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_duree">Durée</label>
            <input type="text" id="isi_duree" name="isi_duree" value="<?php echo esc_attr($duree); ?>"
                placeholder="Ex: 3 ans">
            <div class="isi-meta-description">Durée de la formation (ex: 2 ans, 3 ans).</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_diplome">Diplôme délivré</label>
            <input type="text" id="isi_diplome" name="isi_diplome" value="<?php echo esc_attr($diplome); ?>"
                placeholder="Ex: Licence d'Informatique">
            <div class="isi-meta-description">Nom officiel du diplôme.</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_places">Nombre de places</label>
            <input type="number" id="isi_places" name="isi_places" value="<?php echo esc_attr($places); ?>"
                placeholder="Ex: 45">
            <div class="isi-meta-description">Capacité d'accueil par promotion.</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_taux_insertion">Taux d'insertion (%)</label>
            <input type="number" id="isi_taux_insertion" name="isi_taux_insertion"
                value="<?php echo esc_attr($taux_insertion); ?>" placeholder="Ex: 92" min="0" max="100">
            <div class="isi-meta-description">Pourcentage d'étudiants employés dans les 6 mois.</div>
        </div>
    </div>

    <?php
}

// Sauvegarder les données
function isi_save_programme_meta($post_id)
{
    // Vérifier les permissions
    if (!isset($_POST['isi_programme_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['isi_programme_nonce'], 'isi_programme_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sauvegarder chaque champ
    $fields = array('isi_niveau', 'isi_duree', 'isi_diplome', 'isi_places', 'isi_taux_insertion');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post_programme', 'isi_save_programme_meta');

// ===============================================
// 5. CHAMPS PERSONNALISÉS POUR LES ACTUALITÉS
// ===============================================

// Ajouter des meta boxes pour les actualités
function isi_add_actualite_meta_boxes()
{
    add_meta_box(
        'isi_actualite_details',
        'Détails de l\'actualité',
        'isi_actualite_details_callback',
        'actualite',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'isi_add_actualite_meta_boxes');

function isi_actualite_details_callback($post)
{
    $date_evenement = get_post_meta($post->ID, '_isi_date_evenement', true);
    $lieu = get_post_meta($post->ID, '_isi_lieu', true);
    $auteur = get_post_meta($post->ID, '_isi_auteur', true);

    wp_nonce_field('isi_actualite_nonce', 'isi_actualite_nonce');
    ?>

    <div class="isi-meta-grid">
        <div class="isi-meta-field">
            <label for="isi_date_evenement">Date de l'événement</label>
            <input type="date" id="isi_date_evenement" name="isi_date_evenement"
                value="<?php echo esc_attr($date_evenement); ?>">
            <div class="isi-meta-description">Pour les événements ponctuels.</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_lieu">Lieu</label>
            <input type="text" id="isi_lieu" name="isi_lieu" value="<?php echo esc_attr($lieu); ?>"
                placeholder="Ex: Campus ISI SUPTECH, Abidjan">
            <div class="isi-meta-description">Lieu où se déroule l'événement.</div>
        </div>

        <div class="isi-meta-field">
            <label for="isi_auteur">Auteur / Source</label>
            <input type="text" id="isi_auteur" name="isi_auteur" value="<?php echo esc_attr($auteur); ?>"
                placeholder="Ex: La rédaction">
            <div class="isi-meta-description">Nom de l'auteur ou de la source.</div>
        </div>
    </div>

    <?php
}

function isi_save_actualite_meta($post_id)
{
    if (!isset($_POST['isi_actualite_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['isi_actualite_nonce'], 'isi_actualite_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('isi_date_evenement', 'isi_lieu', 'isi_auteur');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post_actualite', 'isi_save_actualite_meta');

// ===============================================
// 6. SHORTCODES DYNAMIQUES POUR ELEMENTOR
// ===============================================

function isi_programmes_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'niveau' => '', // 'premier_cycle' (Bac+2/3) ou 'master' (Bac+5)
        'limit'  => -1,
    ), $atts );
    
    $meta_query = array();
    if ( $atts['niveau'] === 'premier_cycle' ) {
        $meta_query[] = array(
            'key'     => '_isi_niveau',
            'value'   => array( 'Bac+2', 'Bac+3' ),
            'compare' => 'IN',
        );
    } elseif ( $atts['niveau'] === 'master' ) {
        $meta_query[] = array(
            'key'     => '_isi_niveau',
            'value'   => 'Bac+5',
            'compare' => '=',
        );
    }
    
    $query = new WP_Query( array(
        'post_type'      => 'programme',
        'posts_per_page' => $atts['limit'],
        'meta_query'     => $meta_query,
        'orderby'        => 'ID',
        'order'          => 'ASC',
    ) );
    
    $images_map = array(
        'licence-informatique' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=70',
        'licence-reseaux-telecoms' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&q=70',
        'bts-informatique-gestion' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=70',
        'licence-data-science-bi' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&q=70',
        'licence-cybersecurite' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=70',
        'licence-management-des-si' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=600&q=70',
        'bts-systemes-numeriques' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=70',
        'master-reseaux-systemes-et-cloud-resi' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=700&q=70',
        'master-ingenierie-logicielle' => 'https://images.unsplash.com/photo-1555099962-4199c345e5dd?w=600&q=70',
        'master-intelligence-artificielle' => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=600&q=70'
    );
    
    ob_start();
    if ( $query->have_posts() ) :
        $grid_class = ( $atts['niveau'] === 'master' ) ? 'grid grid-cols-1 lg:grid-cols-2 gap-7' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7';
        ?>
        <div class="<?php echo esc_attr( $grid_class ); ?>">
            <?php while ( $query->have_posts() ) : $query->the_post(); 
                $post_slug = get_post_field( 'post_name', get_the_ID() );
                $duree = get_post_meta( get_the_ID(), '_isi_duree', true ) ?: '3 ans';
                $diplome = get_post_meta( get_the_ID(), '_isi_diplome', true ) ?: 'Licence';
                $niveau = get_post_meta( get_the_ID(), '_isi_niveau', true ) ?: 'Bac+3';
                $places = get_post_meta( get_the_ID(), '_isi_places', true ) ?: '45';
                
                $fallback_img = isset( $images_map[$post_slug] ) ? $images_map[$post_slug] : 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=70';
                $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: $fallback_img;
                
                $badge_class = ( $niveau === 'Bac+5' ) ? 'bg-gold/20 text-gold border border-gold/30' : 'bg-primary-light text-primary';
                
                if ( $atts['niveau'] === 'master' && strpos( $post_slug, 'resi' ) !== false ) :
                ?>
                    <a href="<?php the_permalink(); ?>" class="card-lift bg-primary-dark rounded-2xl overflow-hidden border border-primary/20 shadow-lg flex flex-col group col-span-1 lg:col-span-2 text-left">
                      <div class="flex flex-col lg:flex-row">
                        <div class="img-zoom-wrap lg:w-2/5 h-56 lg:h-auto">
                          <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="p-8 flex flex-col justify-between flex-1">
                          <div>
                            <div class="flex items-center gap-2 mb-4">
                              <span class="badge bg-gold text-gray-900"><?php echo esc_html($niveau); ?> <?php echo esc_html($diplome); ?></span>
                              <span class="badge bg-white/10 text-white/80 border border-white/20">Programme Phare</span>
                            </div>
                            <h3 class="font-display font-black text-2xl text-white mb-3 group-hover:text-gold transition-colors"><?php the_title(); ?></h3>
                            <p class="text-white/65 leading-relaxed mb-6"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <div class="grid grid-cols-3 gap-4 mb-6">
                              <div class="text-center p-3 bg-white/5 rounded-xl text-white">
                                <div class="font-black text-gold text-xl"><?php echo esc_html($duree); ?></div>
                                <div class="text-white/50 text-xs mt-1">Durée</div>
                              </div>
                              <div class="text-center p-3 bg-white/5 rounded-xl text-white">
                                <div class="font-black text-gold text-xl"><?php echo esc_html($places); ?></div>
                                <div class="text-white/50 text-xs mt-1">Places</div>
                              </div>
                              <div class="text-center p-3 bg-white/5 rounded-xl text-white">
                                <div class="font-black text-gold text-xl">98%</div>
                                <div class="text-white/50 text-xs mt-1">Emploi</div>
                              </div>
                            </div>
                          </div>
                          <div class="flex items-center gap-4">
                            <span class="bg-gold hover:bg-yellow-400 text-gray-900 px-6 py-2.5 rounded-xl text-sm font-bold transition-colors cursor-pointer">Découvrir le Master</span>
                            <span class="text-white/60 text-sm">Entrée sélective sur dossier</span>
                          </div>
                        </div>
                      </div>
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm flex flex-col group text-left">
                      <div class="img-zoom-wrap h-48">
                        <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                      </div>
                      <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center gap-2 mb-3">
                          <span class="badge <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($niveau); ?></span>
                          <span class="badge bg-surface text-slate-500 border border-slate-200"><?php echo esc_html($diplome); ?></span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-gray-900 mb-2 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                        <p class="text-slate-500 text-sm leading-relaxed flex-1"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                        <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                          <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">schedule</span> <?php echo esc_html($duree); ?></span>
                          <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">group</span> <?php echo esc_html($places); ?> places</span>
                          <span class="text-primary font-semibold">Voir le programme &rarr;</span>
                        </div>
                      </div>
                    </a>
                <?php 
                endif;
            endwhile; wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <p class="text-slate-500 text-center py-10">Aucun programme trouvé.</p>
    <?php endif;
    return ob_get_clean();
}
add_shortcode( 'isi_programmes', 'isi_programmes_shortcode' );

function isi_actualites_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'limit' => 5,
    ), $atts );
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $query = new WP_Query( array(
        'post_type'      => 'actualite',
        'posts_per_page' => $atts['limit'],
        'paged'          => $paged,
    ) );
    
    ob_start();
    ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Articles -->
        <div class="lg:col-span-2">
          <?php if ( $query->have_posts() ) : ?>
              <?php 
              $post_count = 0;
              $featured_id = 0;
              
              if ( $paged == 1 ) {
                  $query->the_post();
                  $featured_id = get_the_ID();
                  
                  $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                  if ( ! $img_url ) {
                      $img_url = 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&q=70';
                  }
                  
                  $post_cats = get_the_terms( get_the_ID(), 'categorie_actualite' );
                  $cat_name = 'Actualité';
                  if ( ! empty( $post_cats ) && ! is_wp_error( $post_cats ) ) {
                      $cat_name = $post_cats[0]->name;
                  }
                  ?>
                  <!-- Article a la une -->
                  <div class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-8 group text-left">
                    <div class="img-zoom-wrap h-64">
                      <img src="<?php echo esc_url( $img_url ); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                    </div>
                    <div class="p-7">
                      <div class="flex items-center gap-3 mb-3">
                        <span class="badge bg-gold text-gray-900">A la une</span>
                        <span class="badge bg-primary-light text-primary"><?php echo esc_html( $cat_name ); ?></span>
                        <span class="text-slate-400 text-xs"><?php echo esc_html( get_the_date('j F Y') ); ?></span>
                      </div>
                      <h2 class="font-display font-black text-2xl text-gray-900 mb-3 group-hover:text-primary transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h2>
                      <p class="text-slate-500 leading-relaxed mb-5"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 45, '...' ) ); ?></p>
                      <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-primary font-semibold text-sm hover:gap-2 transition-all">Lire l'article complet <span class="material-symbols-outlined" style="font-size:16px">arrow_forward</span></a>
                    </div>
                  </div>
                  <?php
              }
              ?>

              <!-- Grille articles secondaires -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                  <?php 
                  while ( $query->have_posts() ) : $query->the_post();
                      if ( get_the_ID() === $featured_id ) {
                          continue;
                      }
                      
                      $img_url_sec = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ?: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=70';
                      $post_cats_sec = get_the_terms( get_the_ID(), 'categorie_actualite' );
                      $cat_name_sec = 'Actualité';
                      if ( ! empty( $post_cats_sec ) && ! is_wp_error( $post_cats_sec ) ) {
                          $cat_name_sec = $post_cats_sec[0]->name;
                      }
                      ?>
                      <a href="<?php the_permalink(); ?>" class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm group flex flex-col text-left">
                        <div class="img-zoom-wrap h-40">
                          <img src="<?php echo esc_url( $img_url_sec ); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                          <div class="flex items-center gap-2 mb-2">
                            <span class="badge bg-primary-light text-primary"><?php echo esc_html( $cat_name_sec ); ?></span>
                            <span class="text-slate-400 text-xs"><?php echo esc_html( get_the_date('j F Y') ); ?></span>
                          </div>
                          <h3 class="font-display font-bold text-gray-900 text-base mb-2 group-hover:text-primary transition-colors flex-1"><?php the_title(); ?></h3>
                          <p class="text-slate-500 text-sm line-clamp-3"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?></p>
                        </div>
                      </a>
                      <?php
                  endwhile;
                  ?>
              </div>

              <!-- Pagination -->
              <div class="flex items-center gap-2 justify-center">
                  <?php
                  echo paginate_links( array(
                      'total'     => $query->max_num_pages,
                      'current'   => $paged,
                      'type'      => 'plain',
                      'prev_text' => '<span class="material-symbols-outlined text-[18px]">chevron_left</span>',
                      'next_text' => '<span class="material-symbols-outlined text-[18px]">chevron_right</span>',
                  ) );
                  ?>
              </div>
          <?php else : ?>
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 text-center col-span-2">
                  <span class="material-symbols-outlined text-slate-300 text-5xl mb-4">article</span>
                  <h3 class="font-display font-bold text-gray-900 text-xl mb-2">Aucune actualité trouvée</h3>
              </div>
          <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-7">
          <!-- Recherche -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 text-left">
            <h4 class="font-display font-bold text-gray-900 text-sm mb-3">Rechercher</h4>
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="relative">
                <input type="text" name="s" placeholder="Mot-cle..." value="<?php echo get_search_query(); ?>" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm pr-10 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                <input type="hidden" name="post_type" value="actualite">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                  <span class="material-symbols-outlined" style="font-size:18px">search</span>
                </button>
              </div>
            </form>
          </div>

          <!-- Categories -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 text-left">
            <h4 class="font-display font-bold text-gray-900 text-sm mb-4">Categories</h4>
            <ul class="space-y-2">
              <?php
              $categories = get_terms( array(
                  'taxonomy'   => 'categorie_actualite',
                  'hide_empty' => false,
              ) );
              if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                  foreach ( $categories as $cat ) :
                      ?>
                      <li class="flex items-center justify-between text-sm py-2 border-b border-slate-50">
                        <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="text-slate-600 hover:text-primary transition-colors"><?php echo esc_html( $cat->name ); ?></a>
                        <span class="badge bg-primary-light text-primary"><?php echo esc_html( $cat->count ); ?></span>
                      </li>
                      <?php
                  endforeach;
              endif;
              ?>
            </ul>
          </div>

          <!-- Articles recents -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 text-left">
            <h4 class="font-display font-bold text-gray-900 text-sm mb-4">Articles recents</h4>
            <ul class="space-y-4">
              <?php
              $recent_query = new WP_Query( array( 'post_type' => 'actualite', 'posts_per_page' => 3 ) );
              if ( $recent_query->have_posts() ) :
                  while ( $recent_query->have_posts() ) : $recent_query->the_post();
                      $recent_img = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=120&q=60';
                      ?>
                      <li class="flex gap-3">
                        <img src="<?php echo esc_url( $recent_img ); ?>" class="w-14 h-14 rounded-lg object-cover flex-shrink-0" alt="<?php the_title_attribute(); ?>">
                        <div>
                          <a href="<?php the_permalink(); ?>" class="text-sm font-semibold text-gray-900 hover:text-primary transition-colors leading-tight block mb-1"><?php the_title(); ?></a>
                          <div class="text-xs text-slate-400"><?php echo esc_html( get_the_date('j F Y') ); ?></div>
                        </div>
                      </li>
                      <?php
                  endwhile;
                  wp_reset_postdata();
              endif;
              ?>
            </ul>
          </div>

          <!-- Newsletter -->
          <div class="bg-primary rounded-2xl p-6 text-left">
            <h4 class="font-display font-bold text-white text-base mb-2">Newsletter ISI</h4>
            <p class="text-white/60 text-sm mb-4">Recevez les actualites directement dans votre boite mail.</p>
            <input type="email" placeholder="votre@email.com" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/40 mb-3 focus:outline-none focus:border-white/50">
            <button class="w-full bg-gold hover:bg-yellow-400 text-gray-900 py-2.5 rounded-xl font-bold text-sm transition-colors">S'abonner</button>
          </div>
        </aside>
    </div>
    <style>
        .page-numbers {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background-color: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.2s;
        }
        .page-numbers:hover {
            border-color: #1f4085;
            color: #1f4085;
        }
        .page-numbers.current {
            background-color: #1f4085;
            border-color: #1f4085;
            color: white;
        }
        .page-numbers.dots {
            border: none;
            background: transparent;
            color: #94a3b8;
        }
    </style>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'isi_actualites', 'isi_actualites_shortcode' );

function isi_evenements_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'limit' => 3,
    ), $atts );
    
    $query = new WP_Query( array(
        'post_type'      => 'actualite',
        'posts_per_page' => $atts['limit'],
        'tax_query'      => array(
            array(
                'taxonomy' => 'categorie_actualite',
                'field'    => 'slug',
                'terms'    => 'evenement',
            ),
        ),
        'meta_key'       => '_isi_date_evenement',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
    ) );
    
    ob_start();
    ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <?php
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
                $event_date = get_post_meta( get_the_ID(), '_isi_date_evenement', true );
                $lieu       = get_post_meta( get_the_ID(), '_isi_lieu', true );
                
                $day = '--';
                $month_fr = 'EVT';
                if ( $event_date ) {
                    $timestamp = strtotime( $event_date );
                    $day = date( 'd', $timestamp );
                    $months = array(
                        '01' => 'JANV', '02' => 'FEVR', '03' => 'MARS', '04' => 'AVRIL',
                        '05' => 'MAI', '06' => 'JUIN', '07' => 'JUIL', '08' => 'AOUT',
                        '09' => 'SEPT', '10' => 'OCT', '11' => 'NOV', '12' => 'DEC'
                    );
                    $m = date( 'm', $timestamp );
                    $month_fr = isset( $months[$m] ) ? $months[$m] : 'EVT';
                }
                ?>
                <div class="bg-white/10 backdrop-blur border border-white/15 rounded-2xl p-6 text-left">
                  <div class="flex items-center gap-3 mb-4">
                    <div class="w-14 h-14 bg-gold rounded-xl flex flex-col items-center justify-center flex-shrink-0 text-gray-900">
                      <div class="font-black text-xl leading-none"><?php echo esc_html( $day ); ?></div>
                      <div class="text-xs font-semibold"><?php echo esc_html( $month_fr ); ?></div>
                    </div>
                    <div>
                      <div class="font-display font-bold text-white"><?php the_title(); ?></div>
                      <div class="text-white/50 text-xs"><?php echo esc_html( $lieu ); ?></div>
                    </div>
                  </div>
                  <p class="text-white/60 text-sm"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p class="text-white/60 text-sm col-span-3 text-center">Aucun événement à venir.</p>
            <?php
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'isi_evenements', 'isi_evenements_shortcode' );

/**
 * Disable wpautop auto-formatting for standard pages to prevent breaking raw Tailwind grid/flex HTML mockups
 */
function isi_disable_wpautop_for_pages( $content ) {
    if ( is_page() ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
    }
    return $content;
}
add_filter( 'the_content', 'isi_disable_wpautop_for_pages', 1 );

?>