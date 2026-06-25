<?php
/**
 * Page d'archives des programmes - archive-programme.php
 */
get_header(); ?>

<!-- PAGE HERO -->
<section class="relative bg-primary-dark overflow-hidden py-24">
  <div class="absolute inset-0 opacity-20" style="background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.3) 1px,transparent 0);background-size:32px 32px"></div>
  <div class="absolute right-0 top-0 w-1/2 h-full opacity-10">
    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=900&q=70" class="w-full h-full object-cover" alt="">
  </div>
  <div class="relative max-w-7xl mx-auto px-6">
    <div class="badge bg-gold/20 text-gold border border-gold/30 mb-5 anim-1">
      <span class="material-symbols-outlined" style="font-size:13px">book</span>
      Catalogue complet
    </div>
    <h1 class="font-display font-black text-white text-5xl leading-tight mb-4 anim-2">Nos Formations</h1>
    <p class="text-white/70 text-lg max-w-xl anim-3">Des programmes d'excellence de Bac+2 a Bac+5, concus pour repondre aux besoins du marche africain et international des technologies de l'information.</p>
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mt-8 text-sm text-white/50">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors">Accueil</a>
      <span class="material-symbols-outlined text-white/30" style="font-size:16px">chevron_right</span>
      <span class="text-white/80">Formations</span>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<div class="bg-white border-b border-slate-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-5 grid grid-cols-2 md:grid-cols-4 gap-6 divide-x divide-slate-100">
    <div class="px-6 first:pl-0 text-center">
      <div class="font-display font-black text-3xl text-primary"><?php echo wp_count_posts('programme')->publish; ?></div>
      <div class="text-xs text-slate-500 font-medium mt-1">Programmes disponibles</div>
    </div>
    <div class="px-6 text-center">
      <div class="font-display font-black text-3xl text-primary">5</div>
      <div class="text-xs text-slate-500 font-medium mt-1">Domaines de specialite</div>
    </div>
    <div class="px-6 text-center">
      <div class="font-display font-black text-3xl text-primary">Bac+2</div>
      <div class="text-xs text-slate-500 font-medium mt-1">Niveau d'entree minimum</div>
    </div>
    <div class="px-6 text-center">
      <div class="font-display font-black text-3xl text-primary">98%</div>
      <div class="text-xs text-slate-500 font-medium mt-1">Insertion professionnelle</div>
    </div>
  </div>
</div>

<!-- FILTRES + GRILLE -->
<section class="max-w-7xl mx-auto px-6 py-16">

  <!-- Section : Licences & BTS -->
  <h2 class="font-display font-bold text-2xl text-gray-800 mb-6 flex items-center gap-2">
    <span class="w-1 h-6 bg-primary rounded-full inline-block"></span>
    Licences & BTS (Bac+2 à Bac+3)
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-16">
    <?php
    $licences_query = new WP_Query(array(
        'post_type' => 'programme',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_isi_niveau',
                'value' => array('Bac+2', 'Bac+3'),
                'compare' => 'IN'
            )
        )
    ));
    if ($licences_query->have_posts()) : while ($licences_query->have_posts()) : $licences_query->the_post();
        $duree = get_post_meta( get_the_ID(), '_isi_duree', true ) ?: '3 ans';
        $diplome = get_post_meta( get_the_ID(), '_isi_diplome', true ) ?: 'Licence';
        $niveau = get_post_meta( get_the_ID(), '_isi_niveau', true ) ?: 'Bac+3';
        $places = get_post_meta( get_the_ID(), '_isi_places', true ) ?: '45';
        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=70';
    ?>
        <a href="<?php the_permalink(); ?>" class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm flex flex-col group">
          <div class="img-zoom-wrap h-48">
            <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
          </div>
          <div class="p-6 flex flex-col flex-1">
            <div class="flex items-center gap-2 mb-3">
              <span class="badge bg-primary-light text-primary"><?php echo esc_html($niveau); ?></span>
              <span class="badge bg-surface text-slate-500 border border-slate-200"><?php echo esc_html($diplome); ?></span>
            </div>
            <h3 class="font-display font-bold text-lg text-gray-900 mb-2 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
            <p class="text-slate-500 text-sm leading-relaxed flex-1"><?php echo esc_html(get_the_excerpt()); ?></p>
            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
              <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">schedule</span> <?php echo esc_html($duree); ?></span>
              <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">group</span> <?php echo esc_html($places); ?> places</span>
              <span class="text-primary font-semibold">Voir le programme &rarr;</span>
            </div>
          </div>
        </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
        <p class="text-slate-500 col-span-3 text-center py-10">Aucun programme de premier cycle trouvé.</p>
    <?php endif; ?>
  </div>

  <!-- Section Masters -->
  <h2 class="font-display font-bold text-2xl text-gray-800 mb-6 flex items-center gap-2">
    <span class="w-1 h-6 bg-gold rounded-full inline-block"></span>
    Masters (Bac+5) - Programmes d'excellence
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
    <?php
    $masters_query = new WP_Query(array(
        'post_type' => 'programme',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_isi_niveau',
                'value' => 'Bac+5',
                'compare' => '='
            )
        )
    ));
    if ($masters_query->have_posts()) : while ($masters_query->have_posts()) : $masters_query->the_post();
        $duree = get_post_meta( get_the_ID(), '_isi_duree', true ) ?: '2 ans';
        $diplome = get_post_meta( get_the_ID(), '_isi_diplome', true ) ?: 'Master';
        $niveau = get_post_meta( get_the_ID(), '_isi_niveau', true ) ?: 'Bac+5';
        $places = get_post_meta( get_the_ID(), '_isi_places', true ) ?: '25';
        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://images.unsplash.com/photo-1555099962-4199c345e5dd?w=600&q=70';
    ?>
        <a href="<?php the_permalink(); ?>" class="card-lift bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm flex flex-col group">
          <div class="img-zoom-wrap h-48">
            <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover" alt="<?php the_title_attribute(); ?>">
          </div>
          <div class="p-6 flex flex-col flex-1">
            <div class="flex items-center gap-2 mb-3">
              <span class="badge bg-gold-light text-yellow-800"><?php echo esc_html($niveau); ?></span>
              <span class="badge bg-surface text-slate-500 border border-slate-200"><?php echo esc_html($diplome); ?></span>
            </div>
            <h3 class="font-display font-bold text-lg text-gray-900 mb-2 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
            <p class="text-slate-500 text-sm leading-relaxed flex-1"><?php echo esc_html(get_the_excerpt()); ?></p>
            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
              <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">schedule</span> <?php echo esc_html($duree); ?></span>
              <span class="flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:15px">group</span> <?php echo esc_html($places); ?> places</span>
              <span class="text-primary font-semibold">Voir le programme &rarr;</span>
            </div>
          </div>
        </a>
    <?php endwhile; wp_reset_postdata(); else : ?>
        <p class="text-slate-500 col-span-3 text-center py-10">Aucun programme de Master trouvé.</p>
    <?php endif; ?>
  </div>

</section>

<!-- CTA ADMISSIONS -->
<section class="bg-primary py-16">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
    <div>
      <h2 class="font-display font-black text-3xl text-white mb-2">Pret a rejoindre ISI SUPTECH ?</h2>
      <p class="text-white/70">Les candidatures pour l'annee <?php echo date('Y'); ?>-<?php echo date('Y')+1; ?> sont ouvertes. Places limitees.</p>
    </div>
    <div class="flex gap-4 flex-shrink-0">
      <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="bg-gold hover:bg-yellow-400 text-gray-900 px-8 py-3 rounded-xl font-bold text-sm transition-colors">Candidater maintenant</a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-3 rounded-xl font-bold text-sm transition-colors">Nous contacter</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
