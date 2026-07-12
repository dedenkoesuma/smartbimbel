/* =========================================================
   SHARED SCRIPT — Bimbel Smart (versi Laravel)
   Header & footer sudah di-include langsung oleh Blade
   (@include('partials.header') / @include('partials.footer')),
   jadi file ini tidak perlu fetch apa-apa lagi — tinggal jalan.

   Isi:
   1. Toggle menu mobile (burger)
   2. Tandai link navbar yang aktif (dari body[data-page])
   3. Animasi scroll-reveal
   4. Handle submit form newsletter di footer (dummy, belum ada backend)
========================================================= */

function initMobileNav() {
  const burgerBtn = document.getElementById('burgerBtn');
  const closeBtn = document.getElementById('closeBtn');
  const mobileNav = document.getElementById('mobileNav');
  if (!burgerBtn || !closeBtn || !mobileNav) return;
  burgerBtn.addEventListener('click', () => mobileNav.classList.add('open'));
  closeBtn.addEventListener('click', () => mobileNav.classList.remove('open'));
  document.querySelectorAll('.mnav-link').forEach(link => {
    link.addEventListener('click', () => mobileNav.classList.remove('open'));
  });
}

function setActiveNavLink() {
  const page = document.body.dataset.page;
  if (!page) return;
  document.querySelectorAll('[data-nav]').forEach(link => {
    if (link.dataset.nav === page) link.classList.add('active');
  });
}

function initReveal() {
  const revealEls = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  revealEls.forEach(el => io.observe(el));
}

function initNewsletterForm() {
  const newsletterForm = document.getElementById('newsletterForm');
  if (!newsletterForm) return;
  newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();
    newsletterForm.querySelector('input').value = '';
    newsletterForm.querySelector('input').placeholder = 'Berhasil subscribe!';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initMobileNav();
  setActiveNavLink();
  initReveal();
  initNewsletterForm();
});
