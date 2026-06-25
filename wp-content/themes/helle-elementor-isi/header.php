<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <script>
      tailwind.config = {
        important: true,
        theme: {
          extend: {
            colors: {
              primary: '#1f4085',
              'primary-dark': '#162e5f',
              'primary-mid': '#3a589e',
              'primary-light': '#dae2ff',
              gold: '#ffba2d',
              'gold-light': '#fff3d0',
              surface: '#f7f9fb',
              'surface-low': '#f2f4f6',
              'surface-container': '#eceef0',
            },
            fontFamily: {
              display: ['"Public Sans"', 'sans-serif'],
              body: ['Inter', 'sans-serif'],
            }
          }
        }
      }
    </script>
    <style>
      * { box-sizing: border-box; }
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        vertical-align: middle;
        display: inline-block;
      }
      .star-fill { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
      .text-gradient {
        background: linear-gradient(135deg, #fff 0%, #b1c5ff 60%, #ffba2d 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }
      .nav-link { position: relative; }
      .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0;
        width: 0; height: 2px;
        background: #1f4085;
        transition: width 0.25s ease;
      }
      .nav-link:hover::after, .nav-link.active::after { width: 100%; }
      .card-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
      .card-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 24px 64px rgba(31, 64, 133, 0.12);
      }
      .img-zoom-wrap { overflow: hidden; }
      .img-zoom-wrap img { transition: transform 0.55s ease; }
      .card-lift:hover .img-zoom-wrap img { transform: scale(1.07); }
      .glass {
        background: rgba(255,255,255,0.88);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
      }
      .dot-grid {
        background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0);
        background-size: 32px 32px;
      }
      @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(6px); }
      }
      .bounce-slow { animation: bounce-slow 1.8s ease-in-out infinite; }
      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
      }
      .anim-1 { opacity:0; animation: fadeInUp 0.7s 0.15s ease forwards; }
      .anim-2 { opacity:0; animation: fadeInUp 0.7s 0.30s ease forwards; }
      .anim-3 { opacity:0; animation: fadeInUp 0.7s 0.45s ease forwards; }
      .anim-4 { opacity:0; animation: fadeInUp 0.7s 0.60s ease forwards; }
      .anim-5 { opacity:0; animation: fadeInUp 0.7s 0.80s ease forwards; }
      .progress-bar { height: 4px; border-radius: 2px; }
      .badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 11px;
        border-radius: 9999px;
        font-size: 11px; font-weight: 700;
        letter-spacing: 0.06em; text-transform: uppercase;
      }
      section { scroll-margin-top: 80px; }
      ::-webkit-scrollbar { width: 5px; }
      ::-webkit-scrollbar-track { background: #f1f1f1; }
      ::-webkit-scrollbar-thumb { background: #3a589e; border-radius: 3px; }

      /* Styles additionnels des maquettes */
      .tab-btn.active { background: #1f4085 !important; color: #fff !important; }
      .tab-content { display: none; }
      .tab-content.active { display: block; }
      
      .filter-btn { transition: all 0.2s; }
      .filter-btn.active { background: #1f4085 !important; color: #fff !important; }

      /* Timeline styles (A Propos) */
      .timeline-item::before {
        content: '';
        position: absolute;
        left: -29px;
        top: 6px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #1f4085;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px #1f4085;
      }
      
      /* Step line styles (Admissions) */
      .step-line::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
        bottom: -20px;
        width: 2px;
        background: linear-gradient(to bottom, #1f4085, #dae2ff);
      }
      
      /* FAQ styles (Contact) */
      .faq-item {
        border-bottom: 1px solid #e2e8f0;
      }
      .faq-item:last-child {
        border-bottom: none;
      }
      .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.35s ease;
      }
      .faq-answer.open {
        max-height: 300px;
        padding-bottom: 16px;
      }
      .faq-icon {
        transition: transform 0.3s ease;
      }
      .faq-icon.rotate {
        transform: rotate(180deg);
      }
      
      /* Form focus styles */
      input, select, textarea {
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
      }
      input:focus, select:focus, textarea:focus {
        border-color: #1f4085;
        box-shadow: 0 0 0 3px rgba(31, 64, 133, 0.1);
      }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-surface font-body text-gray-900 antialiased' ); ?>>

<?php wp_body_open(); ?>

<!-- ===================== HEADER ===================== -->
<header id="top" class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

    <!-- Logo -->
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group flex-shrink-0">
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/logo.jpg' ); ?>" alt="ISI SUPTECH Logo" class="h-11 w-auto object-contain rounded-lg">
      <div class="hidden sm:block">
        <div class="font-display font-extrabold text-xl text-primary tracking-tight leading-none">ISI SUPTECH</div>
        <div class="text-[10px] text-slate-400 font-semibold tracking-widest uppercase">Institut Superieur d'Informatique</div>
      </div>
    </a>

    <!-- Navigation -->
    <nav class="hidden lg:flex items-center gap-8">
      <?php
      $menu_items = array(
          'accueil'       => array( 'label' => 'Accueil', 'url' => home_url( '/' ), 'active' => is_front_page() ),
          'formations'    => array( 'label' => 'Formations', 'url' => home_url( '/formations/' ), 'active' => is_page( 'formations' ) || is_singular( 'programme' ) ),
          'admissions'    => array( 'label' => 'Admissions', 'url' => home_url( '/admissions/' ), 'active' => is_page( 'admissions' ) ),
          'vie-etudiante' => array( 'label' => 'Vie Etudiante', 'url' => home_url( '/vie-etudiante/' ), 'active' => is_page( 'vie-etudiante' ) ),
          'a-propos'      => array( 'label' => 'A Propos', 'url' => home_url( '/a-propos/' ), 'active' => is_page( 'a-propos' ) ),
          'actualites'    => array( 'label' => 'Actualités', 'url' => home_url( '/actualites/' ), 'active' => is_page( 'actualites' ) || is_singular( 'actualite' ) ),
          'contact'       => array( 'label' => 'Contact', 'url' => home_url( '/contact/' ), 'active' => is_page( 'contact' ) ),
      );
      foreach ( $menu_items as $key => $item ) :
          $active_class = $item['active'] ? 'active font-semibold text-primary' : 'font-medium text-slate-600 hover:text-primary transition-colors';
          ?>
          <a href="<?php echo esc_url( $item['url'] ); ?>" class="nav-link <?php echo esc_attr( $active_class ); ?> font-display text-sm"><?php echo esc_html( $item['label'] ); ?></a>
      <?php endforeach; ?>
    </nav>

    <!-- Actions -->
    <div class="flex items-center gap-3">
      <a href="#" class="hidden md:inline text-sm font-semibold text-slate-500 hover:text-primary transition-colors px-3">Espace Etudiant</a>
      <a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="bg-primary hover:bg-primary-mid text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md hover:shadow-lg transition-all active:scale-95">
        S'inscrire
      </a>
    </div>
  </div>
</header>
