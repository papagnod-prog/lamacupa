/**
 * Lamacupa Theme – Main JavaScript
 * Sticky header, mobile menu, smooth scroll, fade-in animations
 */

(function () {
  'use strict';

  /* ============================================================
     UTILITIES
     ============================================================ */

  /**
   * Run a callback when the DOM is ready.
   * @param {Function} fn
   */
  function domReady(fn) {
    if (document.readyState !== 'loading') {
      fn();
    } else {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }

  /**
   * Throttle a function call.
   * @param {Function} fn
   * @param {number} wait
   * @returns {Function}
   */
  function throttle(fn, wait) {
    var last = 0;
    return function () {
      var now = Date.now();
      if (now - last >= wait) {
        last = now;
        fn.apply(this, arguments);
      }
    };
  }

  /* ============================================================
     SCROLL PROGRESS BAR
     ============================================================ */

  function initScrollProgress() {
    var bar = document.createElement('div');
    bar.className = 'scroll-progress';
    bar.setAttribute('aria-hidden', 'true');
    document.body.appendChild(bar);

    function updateBar() {
      var scrollTop  = window.pageYOffset || document.documentElement.scrollTop;
      var docHeight  = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var progress   = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
      bar.style.width = progress + '%';
    }

    window.addEventListener('scroll', throttle(updateBar, 16), { passive: true });
    updateBar();
  }

  /* ============================================================
     STICKY HEADER
     ============================================================ */

  function initStickyHeader() {
    var header = document.getElementById('siteHeader');
    if (!header) return;

    var threshold = 60;

    function handleScroll() {
      if (window.pageYOffset > threshold) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', throttle(handleScroll, 16), { passive: true });
    handleScroll(); // run once on load
  }

  /* ============================================================
     HERO BG ANIMATION
     ============================================================ */

  function initHeroBgAnimation() {
    var heroBg = document.getElementById('heroBg');
    if (!heroBg) return;

    // Small delay so the transition is noticeable
    setTimeout(function () {
      heroBg.classList.add('hero__bg--animated');
    }, 100);
  }

  /* ============================================================
     MOBILE MENU TOGGLE
     ============================================================ */

  function initMobileMenu() {
    var btn     = document.getElementById('hamburgerBtn');
    var nav     = document.getElementById('mobileNav');
    var overlay = document.getElementById('mobileNavOverlay');
    var header  = document.getElementById('siteHeader');

    if (!btn || !nav || !overlay) return;

    var isOpen = false;

    function openMenu() {
      isOpen = true;
      nav.classList.add('is-open');
      overlay.classList.add('is-visible');
      btn.classList.add('is-active');
      btn.setAttribute('aria-expanded', 'true');
      btn.setAttribute('aria-label', 'Chiudi menu');
      document.body.style.overflow = 'hidden';
      // Ensure header is visible (opaque) when menu opens
      if (header) header.classList.add('scrolled');
    }

    function closeMenu() {
      isOpen = false;
      nav.classList.remove('is-open');
      overlay.classList.remove('is-visible');
      btn.classList.remove('is-active');
      btn.setAttribute('aria-expanded', 'false');
      btn.setAttribute('aria-label', 'Apri menu');
      document.body.style.overflow = '';
      // Re-evaluate header transparency
      if (header && window.pageYOffset <= 60 && !header.classList.contains('site-header--solid')) {
        header.classList.remove('scrolled');
      }
    }

    btn.addEventListener('click', function () {
      if (isOpen) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    overlay.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && isOpen) {
        closeMenu();
        btn.focus();
      }
    });

    // Close menu when a nav link is clicked
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeMenu);
    });
  }

  /* ============================================================
     SMOOTH SCROLL FOR ANCHOR LINKS
     ============================================================ */

  function initSmoothScroll() {
    var navHeight = parseInt(
      getComputedStyle(document.documentElement).getPropertyValue('--nav-height') || '72',
      10
    );

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        var targetId = anchor.getAttribute('href');

        // Skip empty hashes or non-element targets
        if (!targetId || targetId === '#') return;

        var target = document.querySelector(targetId);
        if (!target) return;

        e.preventDefault();

        var targetTop = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 16;

        window.scrollTo({
          top: targetTop,
          behavior: 'smooth',
        });

        // Update URL hash without jumping
        if (history.pushState) {
          history.pushState(null, null, targetId);
        }
      });
    });
  }

  /* ============================================================
     FADE-IN ON SCROLL (IntersectionObserver)
     ============================================================ */

  function initFadeInObserver() {
    if (!('IntersectionObserver' in window)) {
      // Fallback: show all immediately
      document.querySelectorAll('.fade-up, .fade-in').forEach(function (el) {
        el.classList.add('is-visible');
      });
      return;
    }

    var options = {
      root: null,
      rootMargin: '0px 0px -64px 0px',
      threshold: 0.1,
    };

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target); // animate once
        }
      });
    }, options);

    document.querySelectorAll('.fade-up, .fade-in').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ============================================================
     STAGGER CHILDREN OBSERVER
     Adds visible class to stagger-children wrappers so their
     children get cascading transition-delays.
     ============================================================ */

  function initStaggerObserver() {
    if (!('IntersectionObserver' in window)) {
      document.querySelectorAll('.stagger-children').forEach(function (el) {
        el.querySelectorAll('.fade-up, .fade-in').forEach(function (child) {
          child.classList.add('is-visible');
        });
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.querySelectorAll('.fade-up, .fade-in').forEach(function (child) {
              child.classList.add('is-visible');
            });
            observer.unobserve(entry.target);
          }
        });
      },
      { rootMargin: '0px 0px -40px 0px', threshold: 0.05 }
    );

    document.querySelectorAll('.stagger-children').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ============================================================
     ACTIVE NAV ITEM (highlight current page)
     ============================================================ */

  function initActiveNav() {
    var currentPath = window.location.pathname;

    document.querySelectorAll('.primary-nav a, .mobile-nav a').forEach(function (link) {
      var linkPath = link.getAttribute('href');
      if (!linkPath) return;

      try {
        var url = new URL(linkPath, window.location.origin);
        if (url.pathname === currentPath) {
          link.closest('li')
            ? link.closest('li').classList.add('current-menu-item')
            : link.classList.add('active');
        }
      } catch (e) {
        // Not a valid URL — skip
      }
    });
  }

  /* ============================================================
     WOOCOMMERCE: CART AJAX
     Refresh cart count on add-to-cart without page reload
     ============================================================ */

  function initWooCartAjax() {
    // WooCommerce already handles cart fragment refresh via wc-add-to-cart.js
    // We just listen for the custom event to trigger visual feedback

    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.add_to_cart_button');
      if (!btn) return;
      btn.classList.add('loading');

      // WooCommerce dispatches 'added_to_cart' event when done
      document.body.addEventListener(
        'added_to_cart',
        function () {
          btn.classList.remove('loading');
          btn.classList.add('added');
          setTimeout(function () {
            btn.classList.remove('added');
          }, 2000);
        },
        { once: true }
      );
    });
  }

  /* ============================================================
     SIMPLE COOKIE NOTICE
     ============================================================ */

  function initCookieNotice() {
    if (document.cookie.indexOf('lamacupa_cookie_consent=1') !== -1) return;

    var notice = document.createElement('div');
    notice.className = 'cookie-notice';
    notice.setAttribute('role', 'alert');
    notice.setAttribute('aria-live', 'polite');
    notice.innerHTML = [
      '<p style="margin:0;flex:1">',
      'Utilizziamo i cookie per migliorare la tua esperienza sul sito. ',
      'Continuando la navigazione accetti la nostra ',
      '<a href="/privacy-policy/">Privacy Policy</a> e ',
      '<a href="/cookie-policy/">Cookie Policy</a>.',
      '</p>',
      '<button class="cookie-notice__btn" id="cookieAcceptBtn">Accetta e Chiudi</button>',
    ].join('');

    document.body.appendChild(notice);

    // Show with delay
    setTimeout(function () {
      notice.classList.add('is-visible');
    }, 1800);

    document.getElementById('cookieAcceptBtn').addEventListener('click', function () {
      notice.classList.remove('is-visible');
      // Set cookie for 365 days
      var expires = new Date();
      expires.setFullYear(expires.getFullYear() + 1);
      document.cookie = 'lamacupa_cookie_consent=1; expires=' + expires.toUTCString() + '; path=/; SameSite=Lax';
      setTimeout(function () { notice.remove(); }, 400);
    });
  }

  /* ============================================================
     IMAGE LAZY LOADING FALLBACK
     (for browsers without native loading="lazy")
     ============================================================ */

  function initLazyImages() {
    if ('loading' in HTMLImageElement.prototype) {
      // Native lazy loading supported
      document.querySelectorAll('img[data-src]').forEach(function (img) {
        img.src = img.dataset.src;
      });
      return;
    }

    if (!('IntersectionObserver' in window)) return;

    var imgObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
          }
          imgObserver.unobserve(img);
        }
      });
    });

    document.querySelectorAll('img[data-src]').forEach(function (img) {
      imgObserver.observe(img);
    });
  }

  /* ============================================================
     PARALLAX-LIKE BANNER EFFECT
     Subtle vertical translation on .banner-section__overlay
     ============================================================ */

  function initParallaxBanners() {
    var banners = document.querySelectorAll('.banner-section');
    if (!banners.length) return;

    // Only on larger screens where fixed background-attachment works
    if (window.innerWidth < 768) return;

    // background-attachment: fixed is CSS-handled.
    // For iOS compatibility, fall back gracefully (no JS needed here).
  }

  /* ============================================================
     SCROLL-TO-TOP BUTTON
     ============================================================ */

  function initScrollToTop() {
    var btn = document.createElement('button');
    btn.className = 'scroll-to-top';
    btn.setAttribute('aria-label', 'Torna in cima');
    btn.innerHTML = '&#8679;';
    btn.style.cssText = [
      'position:fixed',
      'bottom:32px',
      'right:32px',
      'width:48px',
      'height:48px',
      'background-color:var(--color-olive-dark)',
      'color:white',
      'border:none',
      'border-radius:50%',
      'font-size:1.4rem',
      'cursor:pointer',
      'z-index:800',
      'opacity:0',
      'transform:translateY(16px)',
      'transition:opacity 0.3s ease,transform 0.3s ease',
      'box-shadow:0 4px 16px rgba(0,0,0,0.2)',
    ].join(';');

    document.body.appendChild(btn);

    function toggleVisibility() {
      if (window.pageYOffset > 400) {
        btn.style.opacity = '1';
        btn.style.transform = 'translateY(0)';
      } else {
        btn.style.opacity = '0';
        btn.style.transform = 'translateY(16px)';
      }
    }

    window.addEventListener('scroll', throttle(toggleVisibility, 100), { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ============================================================
     PRODUCT IMAGE PLACEHOLDER COLOR
     Assign gradient backgrounds to placeholder divs
     ============================================================ */

  function initProductPlaceholders() {
    var gradients = [
      'linear-gradient(135deg, #5C6B2E, #8B9A3A)',
      'linear-gradient(135deg, #8B6914, #C4A882)',
      'linear-gradient(135deg, #3a4a20, #5C6B2E)',
      'linear-gradient(135deg, #6B4A18, #8B6914)',
    ];

    document.querySelectorAll('.card__image-placeholder').forEach(function (el, i) {
      if (!el.style.background) {
        el.style.background = gradients[i % gradients.length];
      }
    });
  }

  /* ============================================================
     NAV DROPDOWN (if needed for multi-level menus)
     ============================================================ */

  function initNavDropdowns() {
    // Keyboard accessibility for desktop nav dropdowns (if WP generates sub-menus)
    document.querySelectorAll('.primary-nav .menu-item-has-children').forEach(function (item) {
      var toggle = item.querySelector('a');
      var submenu = item.querySelector('.sub-menu');

      if (!toggle || !submenu) return;

      // Show on hover (CSS) + keyboard focus
      toggle.addEventListener('focus', function () {
        item.classList.add('is-focused');
      });

      item.addEventListener('mouseleave', function () {
        item.classList.remove('is-focused');
      });

      item.addEventListener('focusout', function (e) {
        if (!item.contains(e.relatedTarget)) {
          item.classList.remove('is-focused');
        }
      });
    });
  }

  /* ============================================================
     INIT ALL
     ============================================================ */

  domReady(function () {
    initScrollProgress();
    initStickyHeader();
    initHeroBgAnimation();
    initMobileMenu();
    initSmoothScroll();
    initFadeInObserver();
    initStaggerObserver();
    initActiveNav();
    initLazyImages();
    initParallaxBanners();
    initScrollToTop();
    initProductPlaceholders();
    initNavDropdowns();
    initCookieNotice();

    // WooCommerce
    if (typeof wc_add_to_cart_params !== 'undefined' || document.querySelector('.woocommerce')) {
      initWooCartAjax();
    }

    // Checkout: toggle privato/azienda
    initCheckoutCustomerType();
  });

  function initCheckoutCustomerType() {
    const radios = document.querySelectorAll('input[name="lamacupa_customer_type"]');
    if (!radios.length) return;

    const privatoFields  = document.getElementById('billing-privato-fields');
    const aziendaFields  = document.getElementById('billing-azienda-fields');

    function toggleFields() {
      const val = document.querySelector('input[name="lamacupa_customer_type"]:checked').value;
      if (val === 'azienda') {
        privatoFields.classList.remove('active');
        aziendaFields.classList.add('active');
      } else {
        aziendaFields.classList.remove('active');
        privatoFields.classList.add('active');
      }
    }

    radios.forEach(r => r.addEventListener('change', toggleFields));
    toggleFields();
  }

})();
