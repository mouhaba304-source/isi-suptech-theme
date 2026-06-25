<!-- ===================== FOOTER ===================== -->
<footer class="bg-slate-900 text-white">
  <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-12 pb-12 border-b border-white/10">

      <!-- Brand col -->
      <div class="md:col-span-2">
        <div class="flex items-center gap-3 mb-5">
          <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/logo.jpg' ); ?>" alt="ISI SUPTECH Logo" class="h-11 w-auto object-contain bg-white rounded-lg p-1 shadow-sm">
          <span class="font-display font-extrabold text-xl tracking-tight">ISI SUPTECH</span>
        </div>
        <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-xs">
          L'institution de reference pour les metiers du numerique et de la gestion technologique au Senegal depuis 1994.
        </p>
        <div class="flex gap-3">
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary-mid flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-[17px]">public</span>
          </a>
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary-mid flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-[17px]">groups</span>
          </a>
          <a href="#" class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary-mid flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-[17px]">share</span>
          </a>
        </div>
      </div>

      <!-- Formations -->
      <div>
        <h5 class="font-bold text-white text-xs uppercase tracking-widest mb-5">Formations</h5>
        <ul class="space-y-3">
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'programme' ) ); ?>" class="text-slate-400 text-sm hover:text-white transition-colors">Tous les programmes</a></li>
          <li><a href="#" class="text-slate-400 text-sm hover:text-white transition-colors">Pole Informatique</a></li>
          <li><a href="#" class="text-slate-400 text-sm hover:text-white transition-colors">Pole Gestion</a></li>
          <li><a href="#" class="text-slate-400 text-sm hover:text-white transition-colors">Formations Pro</a></li>
        </ul>
      </div>

      <!-- Liens -->
      <div>
        <h5 class="font-bold text-white text-xs uppercase tracking-widest mb-5">Liens Utiles</h5>
        <ul class="space-y-3">
          <li><a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" class="text-slate-400 text-sm hover:text-white transition-colors">Admissions</a></li>
          <li><a href="#" class="text-slate-400 text-sm hover:text-white transition-colors">Espace Etudiant</a></li>
          <li><a href="#" class="text-slate-400 text-sm hover:text-white transition-colors">Reseau Alumni</a></li>
          <li><a href="<?php echo esc_url( home_url( '/a-propos/' ) ); ?>" class="text-slate-400 text-sm hover:text-white transition-colors">A Propos</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div>
        <h5 class="font-bold text-white text-xs uppercase tracking-widest mb-5">Newsletter</h5>
        <p class="text-slate-400 text-sm mb-4">Restez informe de nos actualites.</p>
        <div class="flex gap-2">
          <input type="email" placeholder="Votre email"
                 class="bg-white/10 border border-white/10 rounded-lg px-3 py-2.5 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-primary-mid flex-1">
          <button class="bg-primary hover:bg-primary-mid px-3 rounded-lg transition-colors">
            <span class="material-symbols-outlined text-[18px]">send</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Bottom bar -->
    <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-slate-500 text-xs">&copy; <?php echo date('Y'); ?> ISI SUPTECH. Excellence Institutionnelle & Precision Technique.</p>
      <div class="flex gap-6">
        <a href="#" class="text-slate-500 hover:text-slate-300 text-xs transition-colors">Mentions Legales</a>
        <a href="#" class="text-slate-500 hover:text-slate-300 text-xs transition-colors">Confidentialite</a>
        <a href="#" class="text-slate-500 hover:text-slate-300 text-xs transition-colors">CGU</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

<script>
/**
 * Global FAQ Toggle handler
 */
function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const icon = btn.querySelector('.faq-icon');
  if (answer && icon) {
    answer.classList.toggle('open');
    icon.classList.toggle('rotate');
  }
}

/**
 * Global Client-Side Formations Filtering
 */
document.addEventListener('DOMContentLoaded', function() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.grid > a.card-lift');
  
  if (filterBtns.length > 0 && cards.length > 0) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        
        filterBtns.forEach(b => {
          b.classList.remove('active');
          b.className = 'filter-btn px-5 py-2 rounded-full border border-slate-200 text-slate-600 text-sm font-semibold bg-white hover:border-primary hover:text-primary transition-all';
        });
        
        btn.classList.add('active');
        const filterVal = btn.textContent.trim().toLowerCase();
        
        if (filterVal === 'tous') {
          btn.className = 'filter-btn active px-5 py-2 rounded-full border border-primary text-sm font-semibold bg-primary text-white transition-all';
        } else {
          btn.className = 'filter-btn active px-5 py-2 rounded-full border border-primary text-sm font-semibold bg-primary text-white transition-all';
        }
        
        cards.forEach(card => {
          const text = card.textContent.toLowerCase();
          
          let match = false;
          if (filterVal === 'tous') {
            match = true;
          } else if (filterVal === 'informatique') {
            match = text.includes('informatique') || text.includes('développement') || text.includes('logiciel') || text.includes('it');
          } else if (filterVal === 'reseaux' || filterVal === 'réseaux') {
            match = text.includes('reseau') || text.includes('réseau') || text.includes('telecom') || text.includes('télécom') || text.includes('cloud') || text.includes('systèmes');
          } else if (filterVal === 'management') {
            match = text.includes('management') || text.includes('gestion') || text.includes('marketing') || text.includes('administration');
          } else if (filterVal === 'master') {
            match = text.includes('master') || text.includes('bac+5');
          } else if (filterVal === 'bts') {
            match = text.includes('bts') || text.includes('bac+2');
          }
          
          if (match) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }
});
</script>
</body>
</html>
