/**
 * IT Student Portfolio - Interactive Logic
 * Handles dynamic typing, project filtering, navbar scroll, AJAX contact, and Resume Modal.
 */

// =================================================================
// RESUME QUICK VIEW MODAL — Global functions (defined FIRST so
// inline onclick attributes can always find them)
// =================================================================
function openResumeModal() {
    var modal = document.getElementById('resumeModal');
    if (!modal) return;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeResumeModal() {
    var modal = document.getElementById('resumeModal');
    if (!modal) return;
    modal.classList.remove('active');
    document.body.style.overflow = '';
    var wrap = document.getElementById('resumeImgWrapper');
    if (wrap) wrap.classList.remove('zoomed');
    var label = document.getElementById('resumeZoomLabel');
    if (label) label.textContent = 'Zoom In';
}

function toggleResumeZoom() {
    var wrap = document.getElementById('resumeImgWrapper');
    if (!wrap) return;
    var isZoomed = wrap.classList.toggle('zoomed');
    var label = document.getElementById('resumeZoomLabel');
    if (label) label.textContent = isZoomed ? 'Fit Screen' : 'Zoom In';
}

// =================================================================
// MOCK INTERVIEW VIDEO PLAYER
// =================================================================
function playInterviewVideo() {
    var video = document.getElementById('interviewVideo');
    var overlay = document.getElementById('interviewPlayOverlay');
    if (video) {
        video.play().catch(function(err) {
            console.log('Video play error:', err);
        });
    }
    if (overlay) {
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
    }
}

// Expose on window just in case
window.openResumeModal    = openResumeModal;
window.closeResumeModal   = closeResumeModal;
window.toggleResumeZoom   = toggleResumeZoom;
window.playInterviewVideo = playInterviewVideo;

// =================================================================
// DOM READY
// =================================================================
document.addEventListener('DOMContentLoaded', function () {

    // ── Resume modal: backdrop click & Esc key ─────────────────
    var resumeModal = document.getElementById('resumeModal');
    if (resumeModal) {
        resumeModal.addEventListener('click', function (e) {
            if (e.target === resumeModal) closeResumeModal();
        });
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeResumeModal();
    });

    // Click image inside modal → zoom toggle
    var resumeImgWrap = document.getElementById('resumeImgWrapper');
    if (resumeImgWrap) {
        resumeImgWrap.addEventListener('click', toggleResumeZoom);
    }

    // ── Mock Interview Video Event Handlers ───────────────────
    var interviewVid = document.getElementById('interviewVideo');
    var interviewOverlay = document.getElementById('interviewPlayOverlay');
    if (interviewVid && interviewOverlay) {
        interviewVid.addEventListener('play', function () {
            interviewOverlay.style.opacity = '0';
            interviewOverlay.style.pointerEvents = 'none';
        });
        interviewVid.addEventListener('pause', function () {
            if (!interviewVid.seeking) {
                interviewOverlay.style.opacity = '1';
                interviewOverlay.style.pointerEvents = 'auto';
            }
        });
        interviewVid.addEventListener('ended', function () {
            interviewOverlay.style.opacity = '1';
            interviewOverlay.style.pointerEvents = 'auto';
        });
    }

    // ── 1. DYNAMIC TYPING EFFECT ──────────────────────────────
    var dynamicTextElement = document.getElementById('dynamic-text');
    if (dynamicTextElement) {
        var phrases = [
            "BSIT Student",
            "Aspiring Full-Stack Developer",
            "Database & SQL Architect",
            "Web Applications Enthusiast",
            "Systems & Network Learner"
        ];
        var phraseIndex = 0;
        var charIndex   = 0;
        var isDeleting  = false;
        var typingSpeed = 100;

        function typeLoop() {
            var currentPhrase = phrases[phraseIndex];
            if (isDeleting) {
                dynamicTextElement.textContent = currentPhrase.substring(0, charIndex - 1);
                charIndex--;
                typingSpeed = 45;
            } else {
                dynamicTextElement.textContent = currentPhrase.substring(0, charIndex + 1);
                charIndex++;
                typingSpeed = 95;
            }
            if (!isDeleting && charIndex === currentPhrase.length) {
                isDeleting  = true;
                typingSpeed = 1800;
            } else if (isDeleting && charIndex === 0) {
                isDeleting   = false;
                phraseIndex  = (phraseIndex + 1) % phrases.length;
                typingSpeed  = 350;
            }
            setTimeout(typeLoop, typingSpeed);
        }
        typeLoop();
    }

    // ── 2. NAVBAR SCROLL & ACTIVE LINK HIGHLIGHTING ───────────
    var navbar   = document.getElementById('navbar');
    var navLinks = document.querySelectorAll('.nav-link');
    var sections = document.querySelectorAll('section[id]');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        var currentSectionId = '';
        var scrollPosition   = window.scrollY + 140;

        sections.forEach(function (section) {
            var sectionTop    = section.offsetTop;
            var sectionHeight = section.offsetHeight;
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        navLinks.forEach(function (link) {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + currentSectionId) {
                link.classList.add('active');
            }
        });
    });

    // ── 3. MOBILE MENU TOGGLE ─────────────────────────────────
    var mobileToggle = document.getElementById('mobile-toggle');
    var navMenu      = document.getElementById('nav-links');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function () {
            navMenu.classList.toggle('open');
            mobileToggle.innerHTML = navMenu.classList.contains('open') ? '✕' : '☰';
        });
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                navMenu.classList.remove('open');
                mobileToggle.innerHTML = '☰';
            });
        });
    }

    // ── 4. CATEGORY FILTERS (Projects & Skills) ────────────────
    function setupFilter(containerSelector, cardSelector) {
        var container = document.querySelector(containerSelector);
        if (!container) return;
        var buttons = container.querySelectorAll('.filter-btn');
        var cards   = document.querySelectorAll(cardSelector);

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                buttons.forEach(function (btn) { btn.classList.remove('active'); });
                button.classList.add('active');
                var filterValue = button.getAttribute('data-filter');
                cards.forEach(function (card) {
                    var category = card.getAttribute('data-category');
                    if (filterValue === 'all' || category === filterValue) {
                        card.style.display = 'flex';
                        setTimeout(function () {
                            card.style.opacity   = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.opacity   = '0';
                        card.style.transform = 'translateY(15px)';
                        setTimeout(function () { card.style.display = 'none'; }, 250);
                    }
                });
            });
        });
    }

    // Initialize independently
    setupFilter('#project-filters', '#projects-container .project-card');
    setupFilter('#skill-filters', '#skills-container .skill-card');

    // ── 5. CONTACT FORM AJAX HANDLER ─────────────────────────
    var contactForm  = document.getElementById('contact-form');
    var formFeedback = document.getElementById('form-feedback');
    var submitBtn    = document.getElementById('submit-btn');

    if (contactForm && formFeedback) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (submitBtn) {
                submitBtn.disabled   = true;
                submitBtn.innerHTML  = 'TRANSMITTING DATA...';
            }
            var formData = new FormData(contactForm);
            try {
                var response = await fetch('contact_handler.php', { method: 'POST', body: formData });
                var data     = await response.json();
                formFeedback.className   = 'toast-msg show ' + (data.success ? 'success' : 'error');
                formFeedback.textContent = data.message;
                if (data.success) contactForm.reset();
            } catch (err) {
                formFeedback.className   = 'toast-msg show error';
                formFeedback.textContent = 'Connection error. Please ensure your local server is active.';
            } finally {
                if (submitBtn) {
                    submitBtn.disabled  = false;
                    submitBtn.innerHTML = 'SEND MESSAGE ⚡';
                }
                setTimeout(function () { formFeedback.classList.remove('show'); }, 6000);
            }
        });
    }

});
