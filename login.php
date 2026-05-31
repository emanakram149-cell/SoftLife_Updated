<?php
session_start();
// Already logged in → go to dashboard
if (!empty($_SESSION['sl_token']) && !empty($_SESSION['sl_user_id'])) {
    header('Location: dashboard.php');
    exit;
}
$pageTitle = 'Sign In – SoftLife';
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
<div id="loginPage" class="page active" role="main">
  <div class="auth-wrap">
    <div class="auth-visual" aria-hidden="true">
      <div class="auth-visual-brand">
        <span class="logo">🌱</span>
        <h1>Your Soft Life<br><em>Journey Awaits</em></h1>
        <p>Track habits, uplift your mood, reach your goals — all in one gentle, beautiful space.</p>
      </div>
      <div class="auth-visual-features">
        <div class="feat-item"><span class="feat-icon">✅</span> Daily Habit Tracker</div>
        <div class="feat-item"><span class="feat-icon">😊</span> Mood & Wellbeing Log</div>
        <div class="feat-item"><span class="feat-icon">🎯</span> Goal Setting & Milestones</div>
        <div class="feat-item"><span class="feat-icon">📓</span> Personal Journal</div>
        <div class="feat-item"><span class="feat-icon">📊</span> Progress Analytics</div>
      </div>
      <div class="auth-visual-map">
        <iframe
          title="SoftLife community world map"
          src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15372183.46!2d69.3!3d30.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spk!4v1700000000000"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          aria-label="Global wellness community map">
        </iframe>
      </div>
    </div>

    <div class="auth-form-panel" id="main-content">
      <h2>Welcome back 👋</h2>
      <p class="sub">Sign in to continue your soft life journey</p>

      <div id="loginAlert" class="alert-box" role="alert" aria-live="assertive"></div>

      <form id="loginForm" novalidate aria-label="Sign in form" onsubmit="handleLogin(event)">
        <div class="form-group">
          <label for="loginEmail">Email Address</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">✉️</span>
            <input type="email" id="loginEmail" class="form-input" placeholder="you@email.com"
                   required autocomplete="email" aria-required="true"
                   maxlength="150" oninput="validateEmail(this)">
          </div>
          <div class="field-hint" id="loginEmailHint"></div>
        </div>

        <div class="form-group">
          <label for="loginPassword">Password</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">🔒</span>
            <input type="password" id="loginPassword" class="form-input" placeholder="Your password"
                   required autocomplete="current-password" aria-required="true"
                   minlength="8" maxlength="20" oninput="validatePassword(this,'loginPwHint')">
            <button type="button" class="eye-btn" onclick="togglePw('loginPassword',this)" aria-label="Show password">👁</button>
          </div>
          <div class="field-hint" id="loginPwHint"></div>
        </div>




        <button type="submit" class="btn-primary" id="loginBtn" aria-label="Sign in">
          <span id="loginBtnText">Sign In</span> <span aria-hidden="true">→</span>
        </button>
      </form>

      <div class="divider">or</div>
      <div class="auth-switch">
        Don't have an account? <a onclick="location.href='signup.php'" role="button" tabindex="0"
          onkeydown="if(event.key==='Enter')showPage('signupPage')">Create one →</a>
      </div>
      <div class="auth-switch" style="margin-top:10px;">
        <a onclick="location.href='index.php'" role="button" tabindex="0" style="color:var(--muted);font-weight:500;">← Back to Home</a>
        &nbsp;·&nbsp;
        <a onclick="location.href='about.php'" role="button" tabindex="0" style="color:var(--muted);font-weight:500;">About Us</a>
      </div>
    </div>
  </div>
</div>

<!-- =====================================================
     ============ SIGNUP PAGE ============
===================================================== -->

<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var lp = document.getElementById('loginPage');
  if(lp) { lp.classList.add('active'); lp.style.display=''; }
});

const _origHandleLogin = window.handleLogin;
window.handleLogin = async function(e) {
  e.preventDefault();
  const email = document.getElementById('loginEmail').value.trim();
  const pw = document.getElementById('loginPassword').value;
  const btn = document.getElementById('loginBtn');
  const txt = document.getElementById('loginBtnText');

  if (!validateEmail(document.getElementById('loginEmail'))) {
    showAuthAlert('loginAlert','❌ Please enter a valid email address.','error'); return;
  }
  if (!pw || pw.length < 8) {
    showAuthAlert('loginAlert','❌ Password must be at least 8 characters.','error'); return;
  }
  btn.disabled = true; txt.textContent = 'Signing in…';
  const data = await apiCall('/login.php','POST',{email, password: pw});
  if (data.success) {
    localStorage.setItem('sl_token', data.token);
    localStorage.setItem('sl_username', data.user.username || 'Friend');
    showAuthAlert('loginAlert','✅ Welcome back! Redirecting…','success');
    setTimeout(() => { location.href = 'dashboard.php'; }, 900);
  } else {
    showAuthAlert('loginAlert','❌ ' + (data.error || 'Login failed.'),'error');
    btn.disabled = false; txt.textContent = 'Sign In';
  }
};
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
