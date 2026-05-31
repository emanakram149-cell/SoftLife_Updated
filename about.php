<?php
session_start();
$pageTitle = 'About Us – SoftLife';
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
<div id="aboutPage" class="page active" role="main" aria-label="About SoftLife">

  <!-- ABOUT NAV -->
  <nav class="home-nav" aria-label="Main navigation">
    <button class="home-nav-logo" onclick="location.href='index.php'" aria-label="Go to home">
      <span aria-hidden="true">🌱</span> SoftLife
    </button>
    <div class="home-nav-links">
      <button class="home-nav-link" onclick="location.href='index.php'">Home</button>
      <button class="home-nav-link" onclick="showPage('homePage');setTimeout(()=>scrollToHomeSection('features'),200)">Features</button>
      <button class="home-nav-link" onclick="location.href='about.php'" style="color:var(--primary);">About Us</button>
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

  <!-- ABOUT HERO -->
  <div class="about-hero">
    <div class="home-section-tag">Our Story</div>
    <h1>We Believe in <em>Gentle</em> Growth</h1>
    <p>SoftLife was born from a simple belief: self-improvement doesn't have to be harsh, rigid, or overwhelming. It can be soft, intentional, and deeply personal.</p>
  </div>

  <!-- MISSION -->
  <section class="about-mission" role="region" aria-label="Our mission">
    <div class="about-mission-visual">
      <div class="mission-tile">
        <div class="mission-tile-icon" aria-hidden="true">🌱</div>
        <div class="mission-tile-text">
          <h4>Gentle by Design</h4>
          <p>No streaks lost because of one missed day. We design for humans, not robots.</p>
        </div>
      </div>
      <div class="mission-tile">
        <div class="mission-tile-icon" aria-hidden="true">🔒</div>
        <div class="mission-tile-text">
          <h4>Privacy First</h4>
          <p>Your data lives in your browser. We never sell, share, or exploit your personal information.</p>
        </div>
      </div>
      <div class="mission-tile">
        <div class="mission-tile-icon" aria-hidden="true">💜</div>
        <div class="mission-tile-text">
          <h4>Built with Care</h4>
          <p>Every feature is thoughtfully designed to support your wellbeing — nothing more, nothing less.</p>
        </div>
      </div>
      <div class="mission-tile">
        <div class="mission-tile-icon" aria-hidden="true">✨</div>
        <div class="mission-tile-text">
          <h4>Free Forever</h4>
          <p>Core features are free — always. Growth tools should be accessible to everyone.</p>
        </div>
      </div>
    </div>
    <div class="about-mission-text">
      <div class="home-section-tag">Our Mission</div>
      <h2>Empowering Everyday<br>Intentional Living</h2>
      <p>We started SoftLife because we noticed that most productivity apps are designed for hustle culture — loud, aggressive, and often guilt-inducing when you fall short.</p>
      <p>We wanted something different. A space where you can show up as you are, track what matters to you, and grow at your own pace without judgment.</p>
      <p>Whether you're building your first morning routine, recovering from burnout, or simply trying to be a bit more mindful — SoftLife is here to gently support you every step of the way.</p>
    </div>
  </section>

  <!-- VALUES -->
  <section class="about-values" role="region" aria-label="Our values">
    <div class="home-section-tag">What We Stand For</div>
    <div class="home-section-title">Our Core Values</div>
    <div class="home-section-sub">Every decision we make at SoftLife is guided by these principles.</div>

    <div class="values-grid stagger">
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">🤍</span>
        <div class="value-title">Compassion Over Pressure</div>
        <div class="value-desc">We celebrate every small win. Missing a day is human — our app is designed to welcome you back, not punish you.</div>
      </div>
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">🔍</span>
        <div class="value-title">Radical Transparency</div>
        <div class="value-desc">No hidden fees, no dark patterns, no selling your data. What you see is what you get — always.</div>
      </div>
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">♿</span>
        <div class="value-title">Accessibility for All</div>
        <div class="value-desc">We build for everyone — screen readers, high contrast, text scaling, and keyboard navigation are core features, not afterthoughts.</div>
      </div>
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">🌍</span>
        <div class="value-title">Community First</div>
        <div class="value-desc">SoftLife is shaped by its community. User feedback directly influences every feature we build and every choice we make.</div>
      </div>
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">🎨</span>
        <div class="value-title">Beauty with Purpose</div>
        <div class="value-desc">Design isn't decoration — it's the foundation of a calm, focused experience. We obsess over every pixel because you deserve it.</div>
      </div>
      <div class="value-card">
        <span class="value-emoji" aria-hidden="true">📈</span>
        <div class="value-title">Sustainable Growth</div>
        <div class="value-desc">Real change happens slowly. We design features that encourage long-term habits, not quick-fix shortcuts.</div>
      </div>
    </div>
  </section>

  <!-- TEAM -->
  <section class="about-team" role="region" aria-label="Our team">
    <div class="home-section-tag">The People Behind SoftLife</div>
    <div class="home-section-title">Meet Our Team</div>
    <div class="home-section-sub">A small, passionate team dedicated to building something genuinely good for you.</div>

    <div class="team-grid stagger">
      <div class="team-card">
        <div class="team-avatar" aria-hidden="true">Z</div>
        <div class="team-name">Zara Ahmed</div>
        <div class="team-role">Founder & CEO</div>
        <div class="team-bio">Former wellness coach turned builder. Zara started SoftLife after struggling to find an app that didn't feel like a second job.</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" aria-hidden="true">K</div>
        <div class="team-name">Kamil Raza</div>
        <div class="team-role">Head of Design</div>
        <div class="team-bio">UX researcher with a love for calm, accessible interfaces. Every soft gradient is Kamil's handiwork.</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" aria-hidden="true">P</div>
        <div class="team-name">Priya Sharma</div>
        <div class="team-role">Lead Engineer</div>
        <div class="team-bio">Builds everything that powers SoftLife with a focus on privacy-first, lightning-fast code that just works.</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" aria-hidden="true">T</div>
        <div class="team-name">Tariq Hassan</div>
        <div class="team-role">Community & Support</div>
        <div class="team-bio">The human behind every reply. Tariq makes sure every SoftLife member feels seen, heard, and supported.</div>
      </div>
    </div>
  </section>

  <!-- TIMELINE -->
  <section class="about-timeline" role="region" aria-label="Our journey">
    <div style="text-align:center;">
      <div class="home-section-tag">Our Journey</div>
      <div class="home-section-title">How SoftLife Grew</div>
    </div>

    <div class="timeline-wrap">
      <div class="timeline-item">
        <div class="tl-left"><div class="tl-dot">1</div><div class="tl-line"></div></div>
        <div class="tl-right">
          <div class="tl-year">2022 · The Idea</div>
          <div class="tl-title">Born from a Burnout</div>
          <div class="tl-desc">Zara, after recovering from burnout, sketched the first version of SoftLife in a notebook — a simple habit tracker that felt kind, not demanding.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="tl-left"><div class="tl-dot">2</div><div class="tl-line"></div></div>
        <div class="tl-right">
          <div class="tl-year">2023 · First Release</div>
          <div class="tl-title">Beta Launched to 200 Users</div>
          <div class="tl-desc">Our closed beta attracted 200 passionate early adopters. Their feedback shaped nearly every feature you see today in the app.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="tl-left"><div class="tl-dot">3</div><div class="tl-line"></div></div>
        <div class="tl-right">
          <div class="tl-year">2024 · Growth</div>
          <div class="tl-title">Reaching 12,000 Members</div>
          <div class="tl-desc">Word-of-mouth growth carried SoftLife to 12,000 active members across 40+ countries, with mood journaling becoming our most-loved feature.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="tl-left"><div class="tl-dot">4</div><div class="tl-line"></div></div>
        <div class="tl-right">
          <div class="tl-year">2025 · Today</div>
          <div class="tl-title">Bigger, Softer, Better</div>
          <div class="tl-desc">Analytics, milestones, activities tracking, full accessibility support, and dark mode — and we're just getting started.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="about-faq" role="region" aria-label="Frequently asked questions">
    <div style="text-align:center;">
      <div class="home-section-tag">Got Questions?</div>
      <div class="home-section-title">Frequently Asked Questions</div>
    </div>

    <div class="faq-list">
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          Is SoftLife really free? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">Yes, completely free! All core features — habit tracking, mood logging, goal setting, journaling, and analytics — are available at no cost. We believe personal growth tools should be accessible to everyone.</div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          Is my data private and secure? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">Absolutely. All your data is stored locally in your browser using localStorage. Nothing is sent to external servers unless you explicitly choose to sync. We never sell or share your personal information.</div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          Can I use SoftLife on mobile? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">Yes! SoftLife is fully responsive and works beautifully on phones and tablets. Open it in your mobile browser and add it to your home screen for an app-like experience.</div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          What makes SoftLife different from other apps? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">SoftLife is designed around compassion, not pressure. There's no aggressive streak punishment, no push notifications demanding you perform, no gamification that makes missing a day feel catastrophic. It's a calm, beautiful space to grow at your own pace.</div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          How do I choose a theme? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">When you sign up, you choose between Soft Green (Male theme), Soft Pink (Female theme), or the default Soft Purple neutral theme. Your entire dashboard adapts to your chosen palette. You can always start fresh with a new account to switch themes.</div>
      </div>
      <div class="faq-item">
        <button class="faq-q" onclick="toggleFaq(this)" aria-expanded="false">
          How can I contact the SoftLife team? <span aria-hidden="true">+</span>
        </button>
        <div class="faq-a">Use the newsletter form below to reach out, or send us an email at hello@softlife.app. Our team typically responds within 24 hours and we genuinely love hearing from our community.</div>
      </div>
    </div>
  </section>



  <!-- FOOTER (reused) -->
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
        <li><a onclick="showPage('homePage');setTimeout(()=>scrollToHomeSection('features'),200)">Features</a></li>
        <li><a onclick="showPage('homePage');setTimeout(()=>scrollToHomeSection('how'),200)">How It Works</a></li>
        <li><a onclick="location.href='signup.php'">Sign Up Free</a></li>
        <li><a onclick="location.href='login.php'">Sign In</a></li>
      </ul>
    </div>
    <div class="home-footer-links">
      <h5>Company</h5>
      <ul>
        <li><a onclick="location.href='about.php'">About Us</a></li>
        <li><a onclick="location.href='privacy.php'">Privacy Policy</a></li>
        <li><a onclick="location.href='terms.php'">Terms of Service</a></li>
      </ul>
    </div>
  </footer>
  <div class="home-footer-bottom">
    <span>© 2025 SoftLife. Made with 💜 for your wellbeing.</span>
    <span>Free forever · No ads · No data sold</span>
  </div>
</div>

<!-- =====================================================
     ============ LOGIN PAGE ============
===================================================== -->

<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var a = document.getElementById('aboutPage');
  if(a) { a.classList.add('active'); a.style.display=''; }
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

</body>
</html>
