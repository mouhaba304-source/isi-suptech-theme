<?php
/**
 * Archive Template for CPT Actualités
 *
 * @package hello-elementor-isi
 */

defined('ABSPATH') || die();

get_header();

// We want to handle pagination correctly.
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>

<!-- HERO -->
<section class="bg-primary-dark py-20 relative overflow-hidden">
  <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.4) 1px,transparent 0);background-size:32px 32px"></div>
  <div class="relative max-w-7xl mx-auto px-6">
    <div class="badge bg-gold/20 text-gold border border-gold/30 mb-5 anim-1"><span class="material-symbols-outlined" style="font-size:13px">article</span>Blog & Presse</div>
    <h1 class="font-display font-black text-white text-5xl mb-4 anim-2">
      <?php 
      if ( is_tax() ) {
          single_term_title('Catégorie : ');
      } else {
          echo 'Actualites ISI SUPTECH';
      }
      ?>
    </h1>
    <p class="text-white/70 text-lg max-w-xl anim-2">Suivez l'actualite de l'Institut, les succes des etudiants, les partenariats et les evenements tech.</p>
  </div>
</section>

<!-- CONTENU PRINCIPAL -->
<div class="max-w-7xl mx-auto px-6 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- Articles -->
    <div class="lg:col-span-2">

      <?php if ( have_posts() ) : ?>
          <?php 
          $post_count = 0;
          $featured_id = 0;
          
          // If on page 1, display the first post as featured "A la une"
          if ( $paged == 1 ) {
              the_post();
              $post_count++;
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
              <div class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm mb-8 group">
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
              // Loop through remaining posts
              while ( have_posts() ) : the_post();
                  // Skip the featured post if we already output it on page 1
                  if ( get_the_ID() === $featured_id ) {
                      continue;
                  }
                  
                  $img_url_sec = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                  if ( ! $img_url_sec ) {
                      $img_url_sec = 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500&q=70';
                  }
                  
                  $post_cats_sec = get_the_terms( get_the_ID(), 'categorie_actualite' );
                  $cat_name_sec = 'Actualité';
                  if ( ! empty( $post_cats_sec ) && ! is_wp_error( $post_cats_sec ) ) {
                      $cat_name_sec = $post_cats_sec[0]->name;
                  }
                  ?>
                  <a href="<?php the_permalink(); ?>" class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm group flex flex-col">
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
                  'type'      => 'plain',
                  'prev_text' => '<span class="material-symbols-outlined text-[18px]">chevron_left</span>',
                  'next_text' => '<span class="material-symbols-outlined text-[18px]">chevron_right</span>',
                  'before_page_number' => '',
                  'after_page_number'  => '',
                  'class'     => 'pagination-custom-styles' // style overrides if necessary
              ) );
              ?>
          </div>
          
          <!-- Custom styling inline to override default WP pagination markup with tailwind classes -->
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

      <?php else : ?>
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 text-center">
              <span class="material-symbols-outlined text-slate-300 text-5xl mb-4">article</span>
              <h3 class="font-display font-bold text-gray-900 text-xl mb-2">Aucune actualité trouvée</h3>
              <p class="text-slate-500">Revenez bientôt pour lire nos derniers articles.</p>
          </div>
      <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <aside class="space-y-7">

      <!-- Recherche -->
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
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
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h4 class="font-display font-bold text-gray-900 text-sm mb-4">Categories</h4>
        <ul class="space-y-2">
          <?php
          $categories = get_terms( array(
              'taxonomy'   => 'categorie_actualite',
              'hide_empty' => false,
          ) );
          if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
              foreach ( $categories as $cat ) :
                  $term_link = get_term_link( $cat );
                  if ( is_wp_error( $term_link ) ) {
                      continue;
                  }
                  ?>
                  <li class="flex items-center justify-between text-sm py-2 border-b border-slate-50">
                    <a href="<?php echo esc_url( $term_link ); ?>" class="text-slate-600 hover:text-primary transition-colors"><?php echo esc_html( $cat->name ); ?></a>
                    <span class="badge bg-primary-light text-primary"><?php echo esc_html( $cat->count ); ?></span>
                  </li>
                  <?php
              endforeach;
          else :
              ?>
              <li class="text-slate-400 text-sm">Aucune catégorie.</li>
              <?php
          endif;
          ?>
        </ul>
      </div>

      <!-- Articles recents -->
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h4 class="font-display font-bold text-gray-900 text-sm mb-4">Articles recents</h4>
        <ul class="space-y-4">
          <?php
          $recent_args = array(
              'post_type'      => 'actualite',
              'posts_per_page' => 3,
          );
          $recent_query = new WP_Query( $recent_args );
          if ( $recent_query->have_posts() ) :
              while ( $recent_query->have_posts() ) : $recent_query->the_post();
                  $recent_img = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                  if ( ! $recent_img ) {
                      $recent_img = 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=120&q=60';
                  }
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
          else :
              ?>
              <li class="text-slate-400 text-sm">Aucun article récent.</li>
              <?php
          endif;
          ?>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="bg-primary rounded-2xl p-6">
        <h4 class="font-display font-bold text-white text-base mb-2">Newsletter ISI</h4>
        <p class="text-white/60 text-sm mb-4">Recevez les actualites directement dans votre boite mail.</p>
        <input type="email" placeholder="votre@email.com" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/40 mb-3 focus:outline-none focus:border-white/50">
        <button class="w-full bg-gold hover:bg-yellow-400 text-gray-900 py-2.5 rounded-xl font-bold text-sm transition-colors">S'abonner</button>
      </div>

    </aside>
  </div>
</div>

<?php
get_footer();
