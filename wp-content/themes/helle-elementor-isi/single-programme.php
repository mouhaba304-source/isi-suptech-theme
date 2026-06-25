<?php
/**
 * Modèle de page individuelle pour un programme - single-programme.php
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    // Récupération des données personnalisées (meta)
    $duree = get_post_meta( get_the_ID(), '_isi_duree', true ) ?: '3 ans';
    $diplome = get_post_meta( get_the_ID(), '_isi_diplome', true ) ?: 'Licence d\'Etat';
    $places = get_post_meta( get_the_ID(), '_isi_places', true ) ?: '45';
    $taux_insertion = get_post_meta( get_the_ID(), '_isi_taux_insertion', true ) ?: '92';
    $niveau = get_post_meta( get_the_ID(), '_isi_niveau', true ) ?: 'Bac+3';
    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=1600&q=70';
?>

<!-- HERO FORMATION -->
<section class="relative bg-primary-dark overflow-hidden">
  <div class="absolute inset-0">
    <img src="<?php echo esc_url($img_url); ?>" class="w-full h-full object-cover opacity-20" alt="<?php the_title_attribute(); ?>">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-dark via-primary-dark/90 to-primary-dark/50"></div>
  </div>
  <div class="relative max-w-7xl mx-auto px-6 py-20">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-white/50">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors">Accueil</a>
      <span class="material-symbols-outlined text-white/30" style="font-size:16px">chevron_right</span>
      <a href="<?php echo esc_url( get_post_type_archive_link( 'programme' ) ); ?>" class="hover:text-white transition-colors">Formations</a>
      <span class="material-symbols-outlined text-white/30" style="font-size:16px">chevron_right</span>
      <span class="text-white/80"><?php the_title(); ?></span>
    </div>

    <div class="flex flex-col lg:flex-row gap-12 items-start">
      <div class="flex-1">
        <div class="flex items-center gap-2 mb-4 anim-1">
          <span class="badge bg-primary-light text-primary"><?php echo esc_html($niveau); ?> - <?php echo esc_html($diplome); ?></span>
          <span class="badge bg-gold/20 text-gold border border-gold/30">Informatique</span>
        </div>
        <h1 class="font-display font-black text-white text-5xl leading-tight mb-5 anim-2"><?php the_title(); ?></h1>
        <p class="text-white/70 text-lg leading-relaxed max-w-xl mb-8 anim-3">
          <?php echo esc_html(get_the_excerpt()); ?>
        </p>
        <div class="flex flex-wrap gap-4 anim-3">
          <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="bg-gold hover:bg-yellow-400 text-gray-900 px-7 py-3 rounded-xl font-bold text-sm transition-colors">Candidater</a>
          <a href="#programme-details" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-7 py-3 rounded-xl font-bold text-sm transition-colors">Voir le programme</a>
        </div>
      </div>
      <!-- Fiche rapide -->
      <div class="bg-white/10 backdrop-blur border border-white/15 rounded-2xl p-7 w-full lg:w-80 flex-shrink-0">
        <h3 class="font-display font-bold text-white text-base mb-5">Fiche formation</h3>
        <ul class="space-y-4">
          <li class="flex items-center gap-3 text-sm"><span class="material-symbols-outlined text-gold" style="font-size:20px">schedule</span><div><div class="text-white/50 text-xs">Duree</div><div class="text-white font-semibold"><?php echo esc_html($duree); ?></div></div></li>
          <li class="flex items-center gap-3 text-sm"><span class="material-symbols-outlined text-gold" style="font-size:20px">school</span><div><div class="text-white/50 text-xs">Diplome</div><div class="text-white font-semibold"><?php echo esc_html($diplome); ?></div></div></li>
          <li class="flex items-center gap-3 text-sm"><span class="material-symbols-outlined text-gold" style="font-size:20px">group</span><div><div class="text-white/50 text-xs">Capacite d\'accueil</div><div class="text-white font-semibold"><?php echo esc_html($places); ?> etudiants</div></div></li>
          <li class="flex items-center gap-3 text-sm"><span class="material-symbols-outlined text-gold" style="font-size:20px">work</span><div><div class="text-white/50 text-xs">Insertion pro</div><div class="text-white font-semibold"><?php echo esc_html($taux_insertion); ?>% en 6 mois</div></div></li>
          <li class="flex items-center gap-3 text-sm"><span class="material-symbols-outlined text-gold" style="font-size:20px">event</span><div><div class="text-white/50 text-xs">Rentree</div><div class="text-white font-semibold">Octobre <?php echo date('Y'); ?></div></div></li>
        </ul>
        <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="mt-6 w-full bg-gold hover:bg-yellow-400 text-gray-900 py-2.5 rounded-xl font-bold text-sm transition-colors text-center block">Dossier de candidature</a>
      </div>
    </div>
  </div>
</section>

<!-- ONGLETS CONTENU -->
<section id="programme-details" class="max-w-7xl mx-auto px-6 py-16">

  <!-- Tab nav -->
  <div class="flex flex-wrap gap-2 mb-10 bg-white border border-slate-100 rounded-xl p-1.5 shadow-sm w-fit">
    <button class="tab-btn active px-5 py-2 rounded-lg text-sm font-semibold transition-all" onclick="showTab('programme')">Présentation & Programme</button>
    <button class="tab-btn px-5 py-2 rounded-lg text-sm font-semibold text-slate-500 hover:text-primary transition-all" onclick="showTab('debouches')">Debouches</button>
    <button class="tab-btn px-5 py-2 rounded-lg text-sm font-semibold text-slate-500 hover:text-primary transition-all" onclick="showTab('admission')">Admission</button>
  </div>

  <!-- Tab : Programme -->
  <div id="tab-programme" class="tab-content active">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2 space-y-6">
        
        <!-- Contenu principal -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 prose max-w-none text-slate-600 leading-relaxed">
            <h2 class="font-display font-bold text-2xl text-gray-900 mb-4">Description de la formation</h2>
            <?php the_content(); ?>
        </div>

      </div>

      <!-- Sidebar compétences -->
      <div class="space-y-5">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
          <h4 class="font-display font-bold text-gray-900 mb-4">Competences acquises</h4>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center gap-2 text-slate-600"><span class="material-symbols-outlined text-green-500" style="font-size:16px">check_circle</span>Developpement logiciel</li>
            <li class="flex items-center gap-2 text-slate-600"><span class="material-symbols-outlined text-green-500" style="font-size:16px">check_circle</span>Conception et administration BDD</li>
            <li class="flex items-center gap-2 text-slate-600"><span class="material-symbols-outlined text-green-500" style="font-size:16px">check_circle</span>Architecture reseaux TCP/IP</li>
            <li class="flex items-center gap-2 text-slate-600"><span class="material-symbols-outlined text-green-500" style="font-size:16px">check_circle</span>Gestion de projets informatiques</li>
          </ul>
        </div>
        
        <div class="bg-primary rounded-2xl p-6 text-white">
          <h4 class="font-display font-bold text-base mb-3">Prochaine rentre</h4>
          <div class="text-3xl font-black text-gold mb-1">Octobre <?php echo date('Y'); ?></div>
          <p class="text-white/60 text-sm mb-4">Cloture des dossiers : 30 Aout</p>
          <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="block w-full text-center bg-gold hover:bg-yellow-400 text-gray-900 py-2.5 rounded-xl font-bold text-sm transition-colors">Candidater maintenant</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab : Debouches -->
  <div id="tab-debouches" class="tab-content">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
        <div class="w-14 h-14 bg-primary-light rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="material-symbols-outlined text-primary">developer_mode</span></div>
        <h3 class="font-display font-bold text-gray-900 mb-2">Ingénieur / Développeur</h3>
        <p class="text-slate-500 text-sm">Conception et developpement d\'applications web, mobile et cloud.</p>
      </div>
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
        <div class="w-14 h-14 bg-primary-light rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="material-symbols-outlined text-primary">hub</span></div>
        <h3 class="font-display font-bold text-gray-900 mb-2">Administrateur / DevOps</h3>
        <p class="text-slate-500 text-sm">Gestion des infrastructures systemes et pipelines d\'automatisation.</p>
      </div>
      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">
        <div class="w-14 h-14 bg-primary-light rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="material-symbols-outlined text-primary">shield</span></div>
        <h3 class="font-display font-bold text-gray-900 mb-2">Consultant Tech / Cybersécurité</h3>
        <p class="text-slate-500 text-sm">Audit et mise en conformité sécurité des systèmes critiques.</p>
      </div>
    </div>
  </div>

  <!-- Tab : Admission -->
  <div id="tab-admission" class="tab-content">
    <div class="max-w-2xl bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
      <h3 class="font-display font-bold text-xl text-gray-900 mb-6">Conditions d\'admission</h3>
      <ul class="space-y-4">
        <li class="flex items-start gap-3 text-sm text-slate-600"><span class="material-symbols-outlined text-primary" style="font-size:20px">check_circle</span><div>Baccalaureat scientifique ou technique, ou diplôme équivalent.</div></li>
        <li class="flex items-start gap-3 text-sm text-slate-600"><span class="material-symbols-outlined text-primary" style="font-size:20px">check_circle</span><div>Entretien de motivation individuel devant un jury académique.</div></li>
        <li class="flex items-start gap-3 text-sm text-slate-600"><span class="material-symbols-outlined text-primary" style="font-size:20px">check_circle</span><div>Étude de dossier scolaire (bulletins scolaires et notes du Bac).</div></li>
      </ul>
      <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="mt-7 inline-flex items-center gap-2 bg-primary hover:bg-primary-mid text-white px-7 py-3 rounded-xl font-bold text-sm transition-colors">
        <span class="material-symbols-outlined" style="font-size:18px">description</span>
        Deposer ma candidature
      </a>
    </div>
  </div>

</section>

<?php endwhile; endif; ?>

<script>
function showTab(name) {
  document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  event.target.classList.add('active');
}
</script>

<?php get_footer(); ?>
