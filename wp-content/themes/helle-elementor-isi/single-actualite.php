<?php
/**
 * Single Template for Actualité CPT
 *
 * @package hello-elementor-isi
 */

defined('ABSPATH') || die();

get_header();

if ( have_posts() ) : the_post();
    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    if ( ! $img_url ) {
        $img_url = 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&q=70';
    }
    
    // Custom post metas
    $date_evt = get_post_meta( get_the_ID(), '_isi_date_evenement', true );
    $lieu     = get_post_meta( get_the_ID(), '_isi_lieu', true );
    $auteur   = get_post_meta( get_the_ID(), '_isi_auteur', true );
    if ( ! $auteur ) {
        $auteur = get_the_author();
    }
    
    $post_cats = get_the_terms( get_the_ID(), 'categorie_actualite' );
    $cat_name = 'Actualité';
    if ( ! empty( $post_cats ) && ! is_wp_error( $post_cats ) ) {
        $cat_name = $post_cats[0]->name;
    }
    ?>

    <!-- HERO -->
    <section class="bg-primary-dark py-20 relative overflow-hidden">
      <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.4) 1px,transparent 0);background-size:32px 32px"></div>
      <div class="relative max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-3 mb-5">
            <span class="badge bg-gold text-gray-900"><?php echo esc_html( $cat_name ); ?></span>
            <span class="text-white/60 text-sm"><?php echo esc_html( get_the_date('j F Y') ); ?></span>
        </div>
        <h1 class="font-display font-black text-white text-4xl lg:text-5xl mb-4 max-w-4xl leading-tight"><?php the_title(); ?></h1>
        <div class="flex items-center gap-2 text-white/70 text-sm">
            <span class="material-symbols-outlined" style="font-size:16px">person</span>
            <span>Par <?php echo esc_html( $auteur ); ?></span>
            <?php if ( $lieu ) : ?>
                <span class="mx-2">•</span>
                <span class="material-symbols-outlined" style="font-size:16px">location_on</span>
                <span><?php echo esc_html( $lieu ); ?></span>
            <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-6 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Article Content -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 lg:p-8">
            <div class="rounded-xl overflow-hidden mb-8 h-[380px] img-zoom-wrap">
              <img src="<?php echo esc_url( $img_url ); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
            </div>
            
            <?php if ( $date_evt ) : ?>
              <!-- Event Details Banner -->
              <div class="bg-primary-light/50 border border-primary/10 rounded-xl p-5 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                  <div class="text-primary font-bold text-xs uppercase tracking-wider">Date de l'événement</div>
                  <div class="text-slate-800 font-extrabold text-lg mt-1">
                    <?php echo esc_html( date_i18n('j F Y', strtotime($date_evt)) ); ?>
                  </div>
                </div>
                <?php if ( $lieu ) : ?>
                  <div>
                    <div class="text-primary font-bold text-xs uppercase tracking-wider">Lieu</div>
                    <div class="text-slate-800 font-extrabold text-lg mt-1"><?php echo esc_html( $lieu ); ?></div>
                  </div>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="bg-primary hover:bg-primary-mid text-white text-xs font-bold px-5 py-3 rounded-lg transition-all flex-shrink-0">S'inscrire</a>
              </div>
            <?php endif; ?>

            <div class="prose max-w-none text-slate-600 leading-relaxed space-y-6">
              <?php the_content(); ?>
            </div>
            
            <div class="mt-12 pt-6 border-t border-slate-100 flex items-center justify-between">
              <a href="<?php echo esc_url( get_post_type_archive_link( 'actualite' ) ); ?>" class="inline-flex items-center gap-1 text-slate-500 hover:text-primary font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px">arrow_back</span>
                Retour aux actualités
              </a>
              <div class="flex gap-2">
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Partager:</span>
                <a href="#" class="text-slate-400 hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">public</span></a>
                <a href="#" class="text-slate-400 hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">groups</span></a>
              </div>
            </div>
          </div>
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
                  'post__not_in'   => array( get_the_ID() ),
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
endif;

get_footer();
