/* Lamacupa main.js v2.0.0 — vanilla JS */
(function () {
  'use strict';

  /* ── Sticky header ──────────────────────────────────────────────── */
  function initStickyHeader() {
    var header = document.getElementById('site-header');
    if (!header) return;
    function onScroll() {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ── Mobile menu ────────────────────────────────────────────────── */
  function initMobileMenu() {
    var btn = document.querySelector('.hamburger');
    var nav = document.querySelector('.mobile-nav');
    if (!btn || !nav) return;
    function close() {
      btn.classList.remove('active');
      nav.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
    btn.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      btn.classList.toggle('active', open);
      btn.setAttribute('aria-expanded', String(open));
      document.body.style.overflow = open ? 'hidden' : '';
    });
    nav.addEventListener('click', function (e) { if (e.target === nav) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
    nav.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', close); });
  }

  /* ── Fade-in on scroll ──────────────────────────────────────────── */
  function initFadeIn() {
    if (!window.IntersectionObserver) return;
    var els = document.querySelectorAll('.fade-in-up');
    if (!els.length) return;
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    els.forEach(function (el) { obs.observe(el); });
  }

  /* ── Scroll to top ──────────────────────────────────────────────── */
  function initScrollTop() {
    var btn = document.getElementById('scroll-top');
    if (!btn) return;
    window.addEventListener('scroll', function () {
      btn.classList.toggle('visible', window.scrollY > 350);
    }, { passive: true });
    btn.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }

  /* ── Product gallery thumbnail swap ────────────────────────────── */
  function initProductGallery() {
    var main = document.querySelector('.gallery-main-img');
    var thumbs = document.querySelectorAll('.gallery-thumb');
    if (!main || !thumbs.length) return;
    thumbs.forEach(function (t) {
      t.addEventListener('click', function () {
        main.src = t.dataset.full || t.src;
        thumbs.forEach(function (x) { x.classList.remove('active'); });
        t.classList.add('active');
      });
    });
  }

  /* ── Product tabs ───────────────────────────────────────────────── */
  function initProductTabs() {
    var btns = document.querySelectorAll('.tab-btn');
    var panels = document.querySelectorAll('.tab-panel');
    if (!btns.length) return;
    btns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        btns.forEach(function (b) { b.classList.remove('active'); });
        panels.forEach(function (p) { p.classList.remove('active'); });
        btn.classList.add('active');
        var target = document.getElementById(btn.dataset.tab);
        if (target) target.classList.add('active');
      });
    });
  }

  /* ── Checkout: privato / azienda toggle ─────────────────────────── */
  function initCustomerType() {
    var radios = document.querySelectorAll('input[name="lamacupa_customer_type"]');
    var privatoFields = document.getElementById('billing-privato-fields');
    var aziendaFields = document.getElementById('billing-azienda-fields');
    if (!radios.length) return;
    function toggle() {
      var val = document.querySelector('input[name="lamacupa_customer_type"]:checked');
      if (!val) return;
      var isAzienda = val.value === 'azienda';
      if (privatoFields) privatoFields.classList.toggle('active', !isAzienda);
      if (aziendaFields) aziendaFields.classList.toggle('active', isAzienda);
    }
    radios.forEach(function (r) { r.addEventListener('change', toggle); });
    toggle();
  }

  /* ── Cart quantity update ───────────────────────────────────────── */
  function initCartQty() {
    document.querySelectorAll('.qty-increase').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var input = btn.closest('.qty-input').querySelector('input');
        if (input) input.value = parseInt(input.value || 1) + 1;
      });
    });
    document.querySelectorAll('.qty-decrease').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var input = btn.closest('.qty-input').querySelector('input');
        if (input) input.value = Math.max(1, parseInt(input.value || 1) - 1);
      });
    });
  }

  /* ── Init ───────────────────────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {
    initStickyHeader();
    initMobileMenu();
    initFadeIn();
    initScrollTop();
    initProductGallery();
    initProductTabs();
    initCustomerType();
    initCartQty();
  });
}());
