<?php
session_start();
// Home/About pages are public — logged-in users can visit freely
$pageTitle = 'SoftLife – Your Personal Growth Journey';
include __DIR__ . '/includes/head.php';
?>
<a href="#main-content" class="skip-link">⌨️ Skip to main content</a>
</head>
<body id="bodyEl">

<!-- SCREEN READER SKIP LINK -->
<a href="#main-content" class="skip-link">⌨️ Skip to main content</a>

<!-- =====================================================
     CLOCK BAR
===================================================== -->
<div id="clockBar" role="banner" aria-label="Clock and navigation bar">
  <div class="cb-left">
    <span style="font-size:1rem;">🌱</span>
    <strong style="font-family:'DM Serif Display',serif;font-size:.92rem;">SoftLife</strong>
    <time id="liveClock" aria-live="polite" aria-label="Current time"></time>
    <span id="liveDate" style="opacity:.8;"></span>
  </div>
  <div class="cb-right">
    <div class="cb-search-wrap" role="search">
      <span class="cb-search-icon">🔍</span>
      <input type="text" id="cbSearchInput" placeholder="Search pages, features…"
             aria-label="Quick search" autocomplete="off"
             oninput="runCbSearch(this.value)"
             onkeydown="if(event.key==='Enter'){runCbSearch(this.value)}"
             onfocus="document.querySelector('.cb-search-wrap').classList.add('focused')"
             onblur="document.querySelector('.cb-search-wrap').classList.remove('focused')">
    </div>
  </div>
</div>

<!-- =====================================================
     COOKIE CONSENT
===================================================== -->
<div id="cookieBanner" role="dialog" aria-label="Cookie consent" aria-live="polite">
  <div class="cookie-text">
    <h4>🍪 We use cookies</h4>
    <p>SoftLife uses cookies to save your theme, accessibility settings, and session preferences. No data is sold to advertisers.</p>
  </div>
  <div class="cookie-btns">
    <button class="btn-cookie-accept" onclick="acceptCookies()" aria-label="Accept all cookies">Accept All</button>
    <button class="btn-cookie-manage" onclick="manageCookies()" aria-label="Manage cookie preferences">Manage</button>
  </div>
</div>

<!-- =====================================================
     SEARCH OVERLAY
===================================================== -->
<div id="searchOverlay" role="dialog" aria-modal="true" aria-label="Global search" onclick="handleSearchOverlayClick(event)">
  <div class="search-box" role="search">
    <div class="search-inner">
      <span aria-hidden="true" style="font-size:1.1rem;">🔍</span>
      <input type="text" id="searchInput" placeholder="Search pages, habits, features…"
             aria-label="Search SoftLife" oninput="filterSearch(this.value)" autocomplete="off">
      <button class="search-close" onclick="closeSearch()" aria-label="Close search">✕</button>
    </div>
    <div id="searchResults" class="search-results" role="listbox" aria-label="Search results"></div>
  </div>
</div>

<!-- =====================================================
     SCROLL BUTTONS
===================================================== -->
<button id="scrollToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Scroll to top" title="Page Up">↑</button>
<button id="scrollToBottom" onclick="window.scrollTo({top:document.body.scrollHeight,behavior:'smooth'})" aria-label="Scroll to bottom" title="Page Down">↓</button>

<!-- =====================================================
     ACCESSIBILITY TOOLBAR
===================================================== -->
<div id="a11yBar" role="toolbar" aria-label="Accessibility tools">
  <button class="a11y-btn" onclick="toggleTTS()" id="ttsBtn" aria-label="Toggle screen reader / text-to-speech" title="Read page aloud" aria-pressed="false">🔊</button>
  <button class="a11y-btn" onclick="toggleContrast()" id="contrastBtn" aria-label="Toggle high contrast" title="High Contrast" aria-pressed="false">🌗</button>
  <button class="a11y-btn" onclick="toggleDark()" id="darkBtn" aria-label="Toggle dark mode" title="Dark Mode">🌙</button>
  <button class="a11y-btn" onclick="increaseText()" aria-label="Increase text size" title="Larger Text">A+</button>
  <button class="a11y-btn" onclick="decreaseText()" aria-label="Decrease text size" title="Smaller Text">A−</button>
  <button class="a11y-btn" onclick="toggleA11yPanel()" aria-label="Accessibility help" title="Help">♿</button>
</div>

<div id="a11yPanel" role="dialog" aria-label="Accessibility information">
  <h4>♿ Accessibility Help</h4>
  <ul>
    <li>⌨️ <b>Tab</b> — navigate elements</li>
    <li>↵ <b>Enter / Space</b> — activate</li>
    <li>🔍 <b>Ctrl+K</b> — global search</li>
    <li>🔊 <b>TTS</b> — page read-aloud</li>
    <li>⬆⬇ <b>Page Up/Down</b> buttons</li>
    <li>🌙 <b>Dark mode</b> toggle</li>
    <li>🌗 <b>High contrast</b> toggle</li>
    <li>📢 Live alerts for screen readers</li>
  </ul>
  <button class="close-panel" onclick="toggleA11yPanel()">Close</button>
</div>

<!-- =====================================================
     ============ HOME PAGE ============
===================================================== -->
<div id="homePage" class="page active" role="main" aria-label="SoftLife Home">

  <!-- HOME NAV -->
  <nav class="home-nav" aria-label="Main navigation">
    <button class="home-nav-logo" onclick="location.href='index.php'" aria-label="SoftLife home">
      <span aria-hidden="true">🌱</span> SoftLife
    </button>
    <div class="home-nav-links" id="homeNavLinks">
      <button class="home-nav-link" onclick="scrollToHomeSection('features')">Features</button>
      <button class="home-nav-link" onclick="scrollToHomeSection('how')">How It Works</button>
      <button class="home-nav-link" onclick="scrollToHomeSection('testimonials')">Stories</button>
      <button class="home-nav-link" onclick="location.href='about.php'">About Us</button>
      <button class="home-nav-link" onclick="location.href='contact.php'">Contact</button>
    </div>
    <?php if (!empty($_SESSION['sl_token'])): ?>
    <button class="home-nav-cta" onclick="location.href='dashboard.php'">Go to Dashboard →</button>
    <?php else: ?>
    <button class="home-nav-cta" onclick="location.href='signup.php'">Get Started Free →</button>
    <?php endif; ?>
    <button class="home-hamburger" id="homeHamburger" aria-label="Toggle menu" style="display:none;" onclick="toggleMobileNav()">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- HERO -->
  <section class="home-hero" aria-label="Hero section">
    <div class="home-hero-bg" aria-hidden="true">
      <div class="home-hero-blob"></div>
      <div class="home-hero-blob"></div>
    </div>
    <div class="home-hero-content">
      <div class="home-hero-badge" aria-label="New feature">✨ Your personal growth companion</div>
      <h1>Live Your <em>Soft Life</em><br>Every Single Day</h1>
      <p>Track habits, log moods, set meaningful goals, and journal your journey — all in one beautifully designed space built for your wellbeing.</p>
      <div class="home-hero-actions">
        <button class="hero-btn-primary" onclick="location.href='signup.php'" aria-label="Start your soft life journey">
          Start Free Today 🌱
        </button>
        <button class="hero-btn-ghost" onclick="location.href='login.php'" aria-label="Sign in">
          Already a member? →
        </button>
      </div>
    </div>

    <!-- ANIMATED HERO ILLUSTRATION -->
    <div class="hero-visual" aria-hidden="true">
      <div class="hv-phone">
        <div class="hv-phone-inner">
          <div class="hv-phone-header">
            <span class="hv-dot"></span>
            <span style="font-size:.65rem;font-weight:700;color:var(--primary);font-family:'DM Serif Display',serif;">SoftLife</span>
            <span style="font-size:.7rem;">🌱</span>
          </div>
          <div class="hv-greeting">Good morning, Sara! 🌅</div>
          <div class="hv-section-label">Today's Habits</div>
          <div class="hv-habit hv-habit-done hv-anim-1">
            <span class="hv-check">✓</span>
            <span>Morning meditation</span>
            <span class="hv-streak">🔥5</span>
          </div>
          <div class="hv-habit hv-habit-done hv-anim-2">
            <span class="hv-check">✓</span>
            <span>Drink 2L water</span>
            <span class="hv-streak">🔥3</span>
          </div>
          <div class="hv-habit hv-anim-3">
            <span class="hv-check-empty"></span>
            <span>Evening journal</span>
            <span class="hv-streak" style="opacity:.4">🔥1</span>
          </div>
          <div class="hv-section-label" style="margin-top:10px;">Today's Mood</div>
          <div class="hv-mood-row">
            <span class="hv-mood-btn hv-mood-sel">😄</span>
            <span class="hv-mood-btn">🙂</span>
            <span class="hv-mood-btn">😐</span>
            <span class="hv-mood-btn">😕</span>
            <span class="hv-mood-btn">😞</span>
          </div>
          <div class="hv-section-label" style="margin-top:10px;">Weekly Progress</div>
          <div class="hv-progress-bar"><div class="hv-progress-fill"></div></div>
          <div style="font-size:.55rem;color:var(--primary);font-weight:700;margin-top:3px;">67% complete 🎯</div>
        </div>
      </div>
      <div class="hv-badge hv-badge-1">
        <span>🔥</span>
        <div>
          <div style="font-weight:700;font-size:.72rem;color:var(--text);">5-Day Streak!</div>
          <div style="font-size:.62rem;color:var(--muted);">Keep it up</div>
        </div>
      </div>
      <div class="hv-badge hv-badge-2">
        <span>😄</span>
        <div>
          <div style="font-weight:700;font-size:.72rem;color:var(--text);">Mood: Amazing</div>
          <div style="font-size:.62rem;color:var(--muted);">Logged today</div>
        </div>
      </div>
      <div class="hv-badge hv-badge-3">
        <span>🎯</span>
        <div>
          <div style="font-weight:700;font-size:.72rem;color:var(--text);">Goal reached!</div>
          <div style="font-size:.62rem;color:var(--muted);">Read 10 books</div>
        </div>
      </div>
      <div class="hv-orb hv-orb-1"></div>
      <div class="hv-orb hv-orb-2"></div>
      <div class="hv-orb hv-orb-3"></div>
    </div>
  </section>

  <!-- STATS STRIP -->
  <div class="home-stats-strip" role="region" aria-label="SoftLife community stats">
    <div class="hstrip-item">
      <div class="hstrip-num">12K+</div>
      <div class="hstrip-label">Active Members</div>
    </div>
    <div class="hstrip-item">
      <div class="hstrip-num">98K+</div>
      <div class="hstrip-label">Habits Tracked</div>
    </div>
    <div class="hstrip-item">
      <div class="hstrip-num">4.9★</div>
      <div class="hstrip-label">User Rating</div>
    </div>
    <div class="hstrip-item">
      <div class="hstrip-num">100%</div>
      <div class="hstrip-label">Free to Use</div>
    </div>
  </div>

  <!-- FEATURES -->
  <section class="home-features" id="features" role="region" aria-label="Features">
    <div class="home-section-tag">Everything You Need</div>
    <div class="home-section-title">Your Growth, All In One Place</div>
    <div class="home-section-sub">SoftLife brings together all the tools you need to build a gentle, intentional life — without the overwhelm.</div>

    <div class="features-grid stagger">
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">✅</div>
        <div class="feat-card-title">Habit Tracker</div>
        <div class="feat-card-desc">Build powerful daily routines with streak tracking, completion stats, and gentle reminders that keep you going.</div>
      </div>
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">😊</div>
        <div class="feat-card-title">Mood Journal</div>
        <div class="feat-card-desc">Log your emotional wellbeing daily and see patterns emerge over time with beautiful mood history charts.</div>
      </div>
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">🎯</div>
        <div class="feat-card-title">Goal Setting</div>
        <div class="feat-card-desc">Define what matters most, set milestones, and watch your progress unfold with clear visual indicators.</div>
      </div>
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">📓</div>
        <div class="feat-card-title">Personal Journal</div>
        <div class="feat-card-desc">Capture your thoughts, reflect on your day, and build a private story of your growth over time.</div>
      </div>
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">📊</div>
        <div class="feat-card-title">Progress Analytics</div>
        <div class="feat-card-desc">Understand your patterns with insightful weekly charts covering habits, mood trends, and activity logs.</div>
      </div>
      <div class="feature-card">
        <div class="feat-card-icon" aria-hidden="true">🎨</div>
        <div class="feat-card-title">Personalized Themes</div>
        <div class="feat-card-desc">Choose your aesthetic — soft green, soft pink, or neutral — to make SoftLife truly feel like yours.</div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="home-how" id="how" role="region" aria-label="How it works">
    <div class="home-section-tag">Simple by Design</div>
    <div class="home-section-title">Up & Running in Minutes</div>
    <div class="home-section-sub">No complicated setup. Just sign up, personalize, and start growing from day one.</div>

    <div class="steps-grid stagger">
      <div class="step-card">
        <div class="step-num">1</div>
        <div class="step-title">Create Your Account</div>
        <div class="step-desc">Sign up free in under 60 seconds. No credit card needed — ever.</div>
      </div>
      <div class="step-card">
        <div class="step-num">2</div>
        <div class="step-title">Pick Your Theme</div>
        <div class="step-desc">Choose your personal color theme and make SoftLife feel like home.</div>
      </div>
      <div class="step-card">
        <div class="step-num">3</div>
        <div class="step-title">Add Your Habits</div>
        <div class="step-desc">Set up daily habits you want to build and start checking them off today.</div>
      </div>
      <div class="step-card">
        <div class="step-num">4</div>
        <div class="step-title">Track & Grow</div>
        <div class="step-desc">Watch your streaks grow, moods improve, and goals get closer every single day.</div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="home-testimonials" id="testimonials" role="region" aria-label="User testimonials">
    <div class="home-section-tag">Real Stories</div>
    <div class="home-section-title">People Who Love SoftLife</div>
    <div class="home-section-sub">Join thousands of people who have transformed their daily routines and mindset.</div>

    <div class="testi-grid stagger">
      <div class="testi-card">
        <div class="testi-stars">★★★★★</div>
        <div class="testi-text">"SoftLife completely changed how I approach my mornings. The habit tracker keeps me accountable without feeling like a chore."</div>
        <div class="testi-author">
          <div class="testi-avatar" aria-hidden="true">S</div>
          <div>
            <div class="testi-name">Sara K.</div>
            <div class="testi-role">Student · Using for 6 months</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars">★★★★★</div>
        <div class="testi-text">"I love how the mood journal helps me spot patterns in my mental health. I feel so much more self-aware now."</div>
        <div class="testi-author">
          <div class="testi-avatar" aria-hidden="true">A</div>
          <div>
            <div class="testi-name">Ali R.</div>
            <div class="testi-role">Professional · Using for 3 months</div>
          </div>
        </div>
      </div>
      <div class="testi-card">
        <div class="testi-stars">★★★★★</div>
        <div class="testi-text">"The clean design and the gentle approach make this feel so different from other apps. It actually feels like self-care."</div>
        <div class="testi-author">
          <div class="testi-avatar" aria-hidden="true">M</div>
          <div>
            <div class="testi-name">Maria T.</div>
            <div class="testi-role">Entrepreneur · Using for 1 year</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="home-cta-banner" role="region" aria-label="Call to action">
    <h2>Ready to Start Your Soft Life?</h2>
    <p>Join over 12,000 people building intentional, joyful daily routines.</p>
    <button class="cta-banner-btn" onclick="location.href='signup.php'">Create Free Account 🌱</button>
  </section>

  <!-- FOOTER -->
  <footer class="home-footer" role="contentinfo">
    <div class="home-footer-brand">
      <div style="display:flex;align-items:center;gap:8px;font-family:'DM Serif Display',serif;font-size:1.2rem;color:var(--text);">
        <span>🌱</span> SoftLife
      </div>
      <p>Your personal growth companion. Track, reflect, and grow — gently, every day.</p>
    </div>
    <div class="home-footer-links">
      <h5>Product</h5>
      <ul>
        <li><a onclick="scrollToHomeSection('features')">Features</a></li>
        <li><a onclick="scrollToHomeSection('how')">How It Works</a></li>
        <li><a onclick="location.href='signup.php'">Sign Up Free</a></li>
        <li><a onclick="location.href='login.php'">Sign In</a></li>
      </ul>
    </div>
    <div class="home-footer-links">
      <h5>Company</h5>
      <ul>
        <li><a onclick="location.href='about.php'">About Us</a></li>
        <li><a onclick="scrollToHomeSection('testimonials')">Stories</a></li>
        <li><a onclick="location.href='privacy.php'">Privacy Policy</a></li>
        <li><a onclick="location.href='terms.php'">Terms of Service</a></li>
      </ul>
    </div>
    <div class="home-footer-links">
      <h5>Connect</h5>
      <ul>
        <li><a onclick="location.href='contact.php'">Contact Us</a></li>
        <li><a onclick="location.href='about.php'">Our Team</a></li>
      </ul>
    </div>
  </footer>
  <div class="home-footer-bottom">
    <span>© 2025 SoftLife. Made with 💜 for your wellbeing.</span>
    <span>Free forever · No ads · No data sold</span>
  </div>
</div>

<!-- =====================================================
     ============ ABOUT US PAGE ============
===================================================== -->

<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var h = document.getElementById('homePage');
  if(h) { h.classList.add('active'); h.style.display=''; }
  setTimeout(function(){ initScrollReveal(); animateCounters(); }, 100);
});
</script>
<!-- ══════════════════════════════════════════
     FAB CLUSTER – bottom-left
     ══════════════════════════════════════════ -->
<div id="fabCluster" aria-label="Quick actions">
  <!-- Chatbot toggle — AI SVG icon -->
  <button id="chatbotFab" onclick="toggleChatbot()" aria-label="Open AI chatbot" title="SoftLife AI Assistant">
    <svg width="26" height="26" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- brain outline -->
      <ellipse cx="16" cy="15" rx="8" ry="7" fill="rgba(255,255,255,0.15)" stroke="white" stroke-width="1.5"/>
      <!-- neural nodes -->
      <circle cx="11.5" cy="13.5" r="1.8" fill="white"/>
      <circle cx="16"   cy="12"   r="1.8" fill="white"/>
      <circle cx="20.5" cy="13.5" r="1.8" fill="white"/>
      <circle cx="13.5" cy="17"   r="1.4" fill="rgba(255,255,255,0.8)"/>
      <circle cx="18.5" cy="17"   r="1.4" fill="rgba(255,255,255,0.8)"/>
      <!-- synapse lines -->
      <line x1="11.5" y1="13.5" x2="16"   y2="12"   stroke="rgba(255,255,255,0.5)" stroke-width="1.1"/>
      <line x1="16"   y1="12"   x2="20.5" y2="13.5" stroke="rgba(255,255,255,0.5)" stroke-width="1.1"/>
      <line x1="11.5" y1="13.5" x2="13.5" y2="17"   stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
      <line x1="20.5" y1="13.5" x2="18.5" y2="17"   stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
      <!-- antenna -->
      <line x1="16" y1="8" x2="16" y2="5.5" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
      <circle cx="16" cy="5" r="1.2" fill="white"/>
      <!-- chat bubbles tail -->
      <circle cx="11" cy="24" r="1.5" fill="white" opacity="0.85"/>
      <circle cx="8"  cy="27" r="2"   fill="white" opacity="0.55"/>
      <circle cx="5"  cy="30" r="1.1" fill="white" opacity="0.3"/>
    </svg>
  </button>
</div>

<!-- ── Chatbot Window ── -->
<div id="chatbotWindow" role="dialog" aria-label="SoftLife Chatbot" aria-modal="true">
  <div class="cw-header">
    <span class="cw-header-icon">
      <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="6" y="6" width="16" height="16" rx="3.5" fill="rgba(255,255,255,0.2)" stroke="white" stroke-width="1.4"/>
        <rect x="10" y="10" width="8" height="8" rx="2" fill="rgba(255,255,255,0.4)"/>
        <line x1="6"  y1="10.5" x2="3"  y2="10.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="6"  y1="14"   x2="3"  y2="14"   stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="6"  y1="17.5" x2="3"  y2="17.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="22" y1="10.5" x2="25" y2="10.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="22" y1="14"   x2="25" y2="14"   stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="22" y1="17.5" x2="25" y2="17.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="10.5" y1="6" x2="10.5" y2="3" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="17.5" y1="6" x2="17.5" y2="3" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="10.5" y1="22" x2="10.5" y2="25" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
        <line x1="17.5" y1="22" x2="17.5" y2="25" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
      </svg>
    </span>
    <span>SoftLife AI Assistant</span>
    <button onclick="toggleChatbot()" aria-label="Close chatbot">✕</button>
  </div>
  <div id="cwMessages" aria-live="polite"></div>
  <div class="cw-input-row" style="background:#ffffff;">
    <input id="cwInput" type="text" placeholder="Ask me anything…"
           maxlength="200" aria-label="Chat message"
           style="background:#ffffff !important; color:#1a1a2e !important;"
           onkeydown="if(event.key==='Enter')sendChatMessage()">
    <button class="cw-send" onclick="sendChatMessage()" aria-label="Send">➤</button>
  </div>
</div>

<!-- ══════════════════════════════════════════
     FEEDBACK MODAL
     ══════════════════════════════════════════ -->
<div id="feedbackModal" role="dialog" aria-modal="true" aria-labelledby="fbModalTitle"
     onclick="if(event.target===this)closeFeedbackModal()">
  <div class="fb-card">
    <h3 id="fbModalTitle">💬 Share Your Feedback</h3>
    <p>Help us improve SoftLife — we read every message.</p>

    <!-- Star rating -->
    <div class="fb-stars" role="group" aria-label="Star rating">
      <span class="fb-star" data-v="1" onclick="setFbRating(1)" role="button" tabindex="0" aria-label="1 star">★</span>
      <span class="fb-star" data-v="2" onclick="setFbRating(2)" role="button" tabindex="0" aria-label="2 stars">★</span>
      <span class="fb-star" data-v="3" onclick="setFbRating(3)" role="button" tabindex="0" aria-label="3 stars">★</span>
      <span class="fb-star" data-v="4" onclick="setFbRating(4)" role="button" tabindex="0" aria-label="4 stars">★</span>
      <span class="fb-star" data-v="5" onclick="setFbRating(5)" role="button" tabindex="0" aria-label="5 stars">★</span>
    </div>

    <div class="fb-field">
      <label for="fbCategory">Category</label>
      <select id="fbCategory">
        <option value="">— Select category (optional) —</option>
        <option value="bug">🐛 Bug Report</option>
        <option value="feature">💡 Feature Request</option>
        <option value="ux">🎨 Design / UX</option>
        <option value="performance">⚡ Performance</option>
        <option value="general">💬 General</option>
      </select>
    </div>

    <div class="fb-field">
      <label for="fbName">Your Name <span style="font-weight:400;color:var(--muted)">(optional)</span></label>
      <input type="text" id="fbName" placeholder="e.g. Alex" maxlength="60" autocomplete="off">
    </div>

    <!-- Message + character counter -->
    <div class="fb-field">
      <label for="fbMessage">Your Message <span style="color:#ef4444">*</span></label>
      <textarea id="fbMessage" class="fb-textarea" maxlength="250"
                placeholder="Tell us what you love, what could be better, or report an issue…"
                oninput="onFbInput()" aria-describedby="fbCharRow" required></textarea>
      <div class="fb-char-row" id="fbCharRow">
        <span class="fb-char-hint">Limit: 0–250 characters</span>
        <span class="fb-char-count" id="fbCharCount">0 / 250</span>
      </div>
    </div>

    <div id="fbAlert" class="fb-alert" role="alert"></div>

    <!-- reCAPTCHA verify -->
    <div class="fb-recaptcha-wrap">
      <div class="fb-rc-row">
        <label class="fb-rc-label" for="fbRcCheck">
          <input type="checkbox" id="fbRcCheck" class="fb-rc-hidden"
                 onchange="fbRcVerify(this)" aria-label="I am not a robot">
          <span class="fb-rc-box"></span>
          <span class="fb-rc-text">I'm not a robot</span>
        </label>
        <div class="rc-signup-logo">
          <svg width="30" height="30" viewBox="0 0 64 64" fill="none">
            <circle cx="32" cy="32" r="30" fill="#4a90d9"/>
            <path d="M32 10C20 10 10 20 10 32C10 44 20 54 32 54C44 54 54 44 54 32"
                  stroke="white" stroke-width="4.5" stroke-linecap="round"/>
            <path d="M44 10L54 20L44 30" stroke="white" stroke-width="4.5"
                  stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span class="rc-brand-text">reCAPTCHA</span>
          <span class="rc-small-links">Privacy · Terms</span>
        </div>
      </div>
    </div>
    <div id="fbRcMsg" style="font-size:.78rem;color:#ef4444;margin-bottom:8px;display:none;">
      ⚠️ Please verify you're not a robot first.
    </div>

    <div class="fb-actions">
      <button class="fb-cancel" onclick="closeFeedbackModal()">Cancel</button>
      <button class="fb-submit" id="fbSubmitBtn" onclick="submitFeedback()">Send Feedback 🚀</button>
    </div>
  </div>
</div>


</body>
</html>
