<?php
session_start();
// Already logged in → go to dashboard (remove this block if you want to allow new signups while logged in)
// if (!empty($_SESSION['sl_token']) && !empty($_SESSION['sl_user_id'])) {
//     header('Location: dashboard.php');
//     exit;
// }
$pageTitle = 'Create Account – SoftLife';

$countries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Chad','Chile','China','Colombia','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Ecuador','Egypt','El Salvador','Estonia','Ethiopia','Fiji','Finland','France','Georgia','Germany','Ghana','Greece','Guatemala','Guinea','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Lithuania','Luxembourg','Malaysia','Maldives','Mali','Malta','Mexico','Moldova','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','Norway','Oman','Pakistan','Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Senegal','Serbia','Sierra Leone','Singapore','Slovakia','Slovenia','Somalia','South Africa','South Korea','Spain','Sri Lanka','Sudan','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];

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

<!-- =====================================================
     SIGNUP PAGE
===================================================== -->
<div id="signupPage" class="page active" role="main">
  <div class="signup-wrap">
    <div class="signup-visual" aria-hidden="true">
      <div>
        <span style="font-size:2.4rem;display:block;margin-bottom:12px;">🚀</span>
        <div style="font-family:'DM Serif Display',serif;font-size:1.9rem;line-height:1.2;margin-bottom:12px;">Start Your<br>Soft Life</div>
        <p style="font-size:.88rem;opacity:.85;line-height:1.6;">Join thousands living intentionally. Track what matters. Celebrate every win.</p>
      </div>
      <div>
        <div style="font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.7px;opacity:.7;margin-bottom:10px;">Choose Your Theme</div>
        <div style="font-size:.85rem;opacity:.8;line-height:1.7;">
          💚 Male → Soft Green<br>
          🌸 Female → Soft Pink<br>
          Your theme personalizes your entire experience.
        </div>
      </div>
      <div>
        <iframe
          title="Signup page map"
          src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15372183.46!2d69.3!3d30.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spk!4v1700000000000"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          style="width:100%;height:130px;border:none;border-radius:10px;display:block;"
          aria-label="Map">
        </iframe>
      </div>
    </div>

    <div class="signup-form-panel" id="main-content">
      <h2>Create Account ✨</h2>
      <p class="sub">Join SoftLife and grow every day</p>

      <div id="signupAlert" class="alert-box" role="alert" aria-live="assertive"></div>

      <!-- GENDER PICKER -->
      <div class="gender-picker" role="group" aria-label="Choose your theme">
        <button type="button" class="g-btn" id="maleBtn" onclick="setGender('male')"
                aria-pressed="false" aria-label="Select male / green theme">
          ♂️ Male
        </button>
        <button type="button" class="g-btn" id="femaleBtn" onclick="setGender('female')"
                aria-pressed="false" aria-label="Select female / pink theme">
          ♀️ Female
        </button>
      </div>

      <form id="signupForm" novalidate aria-label="Create account form" onsubmit="handleSignup(event)">
        <input type="hidden" id="genderInput" name="gender" value="">

        <!-- FULL NAME -->
        <div class="form-group">
          <label for="signupFullname">Full Name <span style="color:var(--muted);font-weight:400">(starts with a letter)</span></label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">🪪</span>
            <input type="text" id="signupFullname" class="form-input" placeholder="Kashif Ahmad"
                   required maxlength="100" autocomplete="name" aria-required="true"
                   aria-describedby="fullnameHint"
                   oninput="validateFullname(this)">
          </div>
          <div class="field-hint" id="fullnameHint">Must start with a letter. Example: Kashif123, Hassam</div>
        </div>

        <!-- USERNAME -->
        <div class="form-group">
          <label for="signupUsername">Username <span style="color:var(--muted);font-weight:400">(4–15 chars, start with letter)</span></label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">👤</span>
            <input type="text" id="signupUsername" class="form-input" placeholder="Kashif123"
                   required minlength="4" maxlength="15" autocomplete="off"
                   aria-required="true" aria-describedby="usernameHint"
                   oninput="validateUsername(this)">
          </div>
          <div class="field-hint" id="usernameHint">Must start with a letter. Allowed: Kashif123, Hassam — Not Allowed: 123Kashif, Hassam@786</div>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
          <label for="signupEmail">Email Address</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">✉️</span>
            <input type="email" id="signupEmail" class="form-input" placeholder="you@email.com"
                   required autocomplete="off" maxlength="150" aria-required="true"
                   oninput="validateEmail(this)">
          </div>
          <div class="field-hint" id="signupEmailHint"></div>
        </div>

        <!-- PASSWORD ROW -->
        <div class="form-row-2">
          <div class="form-group">
            <label for="signupPassword">Password</label>
            <div class="input-wrap">
              <span class="ico" aria-hidden="true">🔒</span>
              <input type="password" id="signupPassword" class="form-input" placeholder="Min. 8 chars"
                     required minlength="8" maxlength="20" aria-required="true"
                     aria-describedby="signupPwHint"
                     oninput="validatePassword(this,'signupPwHint');checkPwStrength(this.value)">
              <button type="button" class="eye-btn" onclick="togglePw('signupPassword',this)" aria-label="Show password">👁</button>
            </div>
            <div class="pw-strength" id="pwStrength" style="display:none;">
              <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwStrengthFill"></div></div>
              <span class="pw-strength-label" id="pwStrengthLabel"></span>
            </div>
            <div class="field-hint" id="signupPwHint">8–20 characters, letters + numbers required</div>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <div class="input-wrap">
              <span class="ico" aria-hidden="true">🔒</span>
              <input type="password" id="confirmPassword" class="form-input" placeholder="Repeat password"
                     required maxlength="20" aria-required="true"
                     oninput="validateConfirmPw(this)">
              <button type="button" class="eye-btn" onclick="togglePw('confirmPassword',this)" aria-label="Show confirm password">👁</button>
            </div>
            <div class="field-hint" id="confirmPwHint"></div>
          </div>
        </div>

        <!-- GENDER DROPDOWN (accessibility fallback) -->
        <div class="form-group">
          <label for="genderDropdown">Gender</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">⚧</span>
            <select id="genderDropdown" class="form-input" aria-required="true"
                    onchange="setGenderFromDropdown(this.value)">
              <option value="">-- Select Gender --</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="default">Prefer not to say</option>
            </select>
          </div>
          <div class="field-hint" id="genderHint"></div>
        </div>

        <!-- COUNTRY DROPDOWN -->
        <div class="form-group">
          <label for="signupCountry">Country</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">🌍</span>
            <select id="signupCountry" class="form-input" aria-required="true">
              <option value="">-- Select Country --</option>
              <?php foreach ($countries as $c): ?>
              <option value="<?= htmlspecialchars($c) ?>"<?= ($c === 'Pakistan') ? ' selected' : '' ?>><?= htmlspecialchars($c) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field-hint" id="countryHint"></div>
        </div>

        <!-- DATE OF BIRTH -->
        <div class="form-group">
          <label for="signupDob">Date of Birth</label>
          <div class="input-wrap">
            <span class="ico" aria-hidden="true">🎂</span>
            <input type="date" id="signupDob" class="form-input" aria-label="Date of birth">
          </div>
        </div>

        <!-- CAPTCHA -->
        <div class="form-group">
          <label id="signupCaptchaLabel">🔐 Verify You're Human</label>
          <div class="rc-signup-wrap" role="group" aria-labelledby="signupCaptchaLabel">
            <div class="rc-signup-row" id="rcSignupRow">
              <label class="rc-signup-label" for="rcSignupCheck">
                <input type="checkbox" id="rcSignupCheck" class="rc-signup-hidden"
                       onchange="rcSignupVerify(this)" aria-label="I am not a robot">
                <span class="rc-signup-box" id="rcSignupBox"></span>
                <span class="rc-signup-text">I'm not a robot</span>
              </label>
              <div class="rc-signup-logo">
                <svg width="34" height="34" viewBox="0 0 64 64" fill="none">
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
            <div class="rc-verifying-row" id="rcSignupVerifying" style="display:none;">
              <div class="rc-spinner-ring"></div>
              <span>Verifying…</span>
            </div>
            <div class="rc-success-row" id="rcSignupSuccess" style="display:none;">
              <svg width="22" height="22" viewBox="0 0 22 22">
                <circle cx="11" cy="11" r="11" fill="#4ade80"/>
                <path d="M6 11l4 4 6-6" stroke="white" stroke-width="2.2"
                      stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>✅ Verified — You are not a robot!</span>
            </div>
          </div>
          <div class="field-hint" id="signupCaptchaHint" style="color:#ef4444;display:none;">
            ⚠️ Please verify that you're not a robot.
          </div>
        </div>

        <!-- TERMS -->
        <div class="terms-row">
          <input type="checkbox" id="termsCheck" class="terms-checkbox" required aria-required="true">
          <label for="termsCheck" class="terms-label">
            I agree to the <a href="#" onclick="return false;">Terms of Service</a> and
            <a href="#" onclick="return false;">Privacy Policy</a>
          </label>
        </div>

        <button type="submit" class="btn-primary" id="signupBtn" aria-label="Create account">
          <span id="signupBtnText">Create My Account</span> 🚀
        </button>
      </form>

      <div class="auth-switch" style="margin-top:16px;">
        Already have an account?
        <a href="login.php">Sign In →</a>
      </div>
      <div class="auth-switch" style="margin-top:10px;">
        <a href="index.php" style="color:var(--muted);font-weight:500;">← Back to Home</a>
        &nbsp;·&nbsp;
        <a href="about.php" style="color:var(--muted);font-weight:500;">About Us</a>
      </div>
    </div>
  </div>
</div>

<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
<script>
window.showPage = function(p) {
  var map = {homePage:'index.php', aboutPage:'about.php', loginPage:'login.php', signupPage:'signup.php', dashPage:'dashboard.php'};
  if (map[p]) location.href = map[p];
};

// ── Sync gender dropdown with theme buttons ──
function setGenderFromDropdown(val) {
  if (val) setGender(val);
  document.getElementById('genderInput').value = val;
}
// Override setGender to also sync dropdown
const _origSetGender = window.setGender;
window.setGender = function(g) {
  if(_origSetGender) _origSetGender(g);
  document.getElementById('genderInput').value = g;
  var dd = document.getElementById('genderDropdown');
  if(dd) dd.value = g;
};

// ── Full Name validation ──
function validateFullname(input) {
  const v = input.value.trim();
  const hint = document.getElementById('fullnameHint');
  if (v.length < 2) {
    setFieldState(input, false, v.length > 0);
    if(hint){ hint.textContent='Full name must be at least 2 characters.'; hint.className='field-hint error'; }
    return false;
  }
  if (!/^[A-Za-z]/.test(v)) {
    setFieldState(input, false, true);
    if(hint){ hint.textContent='❌ Name must start with a letter (not numbers or symbols). Allowed: Kashif123, Hassam'; hint.className='field-hint error'; }
    return false;
  }
  if (/[^A-Za-z0-9 ]/.test(v)) {
    setFieldState(input, false, true);
    if(hint){ hint.textContent='❌ Special characters not allowed. Allowed: Kashif123 — Not Allowed: Hassam@786'; hint.className='field-hint error'; }
    return false;
  }
  setFieldState(input, true, true);
  if(hint){ hint.textContent='✓ Looks good!'; hint.className='field-hint success'; }
  return true;
}

// ── Override validateUsername to add reserved + start-with-letter checks ──
const RESERVED = ['admin','administrator','root','superuser','moderator','mod','system'];
window.validateUsername = function(input) {
  const v = input.value.trim();
  const hint = document.getElementById('usernameHint');
  if (v.length < 4) {
    setFieldState(input, false, v.length > 0);
    if(hint){ hint.textContent='Username must be 4–15 characters.'; hint.className='field-hint'+(v.length>0?' error':''); }
    return false;
  }
  if (RESERVED.includes(v.toLowerCase())) {
    setFieldState(input, false, true);
    if(hint){ hint.textContent='❌ "'+v+'" is a reserved username and cannot be used.'; hint.className='field-hint error'; }
    return false;
  }
  if (!/^[A-Za-z]/.test(v)) {
    setFieldState(input, false, true);
    if(hint){ hint.textContent='❌ Username must start with a letter. Allowed: Kashif123 — Not Allowed: 123Kashif'; hint.className='field-hint error'; }
    return false;
  }
  if (!/^[A-Za-z][A-Za-z0-9_]{3,14}$/.test(v)) {
    setFieldState(input, false, true);
    if(hint){ hint.textContent='❌ Only letters, numbers, underscore allowed. No special chars like @. Not Allowed: Hassam@786'; hint.className='field-hint error'; }
    return false;
  }
  setFieldState(input, true, true);
  if(hint){ hint.textContent='✓ Username available!'; hint.className='field-hint success'; }
  return true;
};

// ── Override handleSignup ──
window.handleSignup = async function(e) {
  e.preventDefault();
  const fullname   = document.getElementById('signupFullname').value.trim();
  const username   = document.getElementById('signupUsername').value.trim();
  const email      = document.getElementById('signupEmail').value.trim();
  const pw         = document.getElementById('signupPassword').value;
  const confirmPw  = document.getElementById('confirmPassword').value;
  const terms      = document.getElementById('termsCheck').checked;
  const gender     = document.getElementById('genderInput').value;
  const country    = document.getElementById('signupCountry').value;

  if (!validateFullname(document.getElementById('signupFullname'))) {
    showAuthAlert('signupAlert','❌ Full name must start with a letter. No special characters allowed.','error'); return;
  }
  if (!window.validateUsername(document.getElementById('signupUsername'))) {
    showAuthAlert('signupAlert','❌ Please fix the username errors above.','error'); return;
  }
  if (!validateEmail(document.getElementById('signupEmail'))) {
    showAuthAlert('signupAlert','❌ Please enter a valid email address.','error'); return;
  }
  if (!gender) {
    showAuthAlert('signupAlert','❌ Please choose a gender/theme.','error'); return;
  }
  if (!country) {
    showAuthAlert('signupAlert','❌ Please select your country from the dropdown.','error'); return;
  }
  if (!validatePassword(document.getElementById('signupPassword'),'signupPwHint')) {
    showAuthAlert('signupAlert','❌ Password must be 8–20 characters with letters and numbers.','error'); return;
  }
  if (!validateConfirmPw(document.getElementById('confirmPassword'))) {
    showAuthAlert('signupAlert','❌ Passwords do not match.','error'); return;
  }
  if (!terms) {
    showAuthAlert('signupAlert','❌ Please accept the Terms of Service.','error'); return;
  }
  if (!window.rcSignupVerified) {
    var h = document.getElementById('signupCaptchaHint');
    if(h) h.style.display='block';
    showAuthAlert('signupAlert','❌ Please verify that you are not a robot.','error'); return;
  }

  const btn = document.getElementById('signupBtn');
  const txt = document.getElementById('signupBtnText');
  btn.disabled = true; txt.textContent = 'Creating account…';

  const data = await apiCall('/signup.php','POST',{fullname, username, email, password: pw, gender, country});
  if (data.success) {
    localStorage.setItem('sl_token', data.token);
    localStorage.setItem('sl_username', data.user.username || 'Friend');
    showAuthAlert('signupAlert','✅ Account created! Redirecting to your dashboard…','success');
    setTimeout(() => { location.href = 'dashboard.php'; }, 1200);
  } else {
    showAuthAlert('signupAlert','❌ ' + (data.error || 'Signup failed.'),'error');
    btn.disabled = false; txt.textContent = 'Create My Account';
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
