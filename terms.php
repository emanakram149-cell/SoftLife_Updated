<?php
session_start();
$pageTitle = 'Terms of Service – SoftLife';
include __DIR__ . '/includes/head.php';
?>

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

<div id="termsPage" class="page active" role="main">
  <nav class="home-nav" aria-label="Main navigation">
    <button class="home-nav-logo" onclick="location.href='index.php'">
      <span>🌱</span> SoftLife
    </button>
    <div class="home-nav-links">
      <button class="home-nav-link" onclick="location.href='index.php'">Home</button>
      <button class="home-nav-link" onclick="location.href='about.php'">About Us</button>
      <button class="home-nav-link" onclick="location.href='contact.php'">Contact</button>
    </div>
    <?php if (!empty($_SESSION['sl_token'])): ?>
    <button class="home-nav-cta" onclick="location.href='dashboard.php'">Go to Dashboard →</button>
    <?php else: ?>
    <button class="home-nav-cta" onclick="location.href='signup.php'">Get Started Free →</button>
    <?php endif; ?>
  </nav>

  <section style="background:linear-gradient(135deg,#f9a8d4,#ec4899);padding:70px 24px 50px;text-align:center;">
    <h1 style="font-family:'DM Serif Display',serif;font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:12px;">📋 Terms of Service</h1>
    <p style="color:rgba(255,255,255,.9);font-size:1rem;">Last updated: January 1, 2025</p>
  </section>

  <section style="max-width:780px;margin:0 auto;padding:60px 24px;line-height:1.8;color:var(--text);">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:16px;padding:28px;margin-bottom:32px;">
      <p style="margin:0;font-size:.95rem;color:var(--muted);">By using SoftLife, you agree to these Terms of Service. We've written them in plain language because we respect your time.</p>
    </div>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">1. Acceptance of Terms</h2>
    <p>By creating an account or using SoftLife, you agree to be bound by these terms. If you do not agree, please do not use the service.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">2. Your Account</h2>
    <p>You are responsible for keeping your account credentials safe. You must be at least 13 years old to use SoftLife. One person, one account — you may not share your account.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">3. Acceptable Use</h2>
    <p>You agree not to use SoftLife for any unlawful purpose, attempt to hack or disrupt the service, or upload harmful or offensive content.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">4. Your Content</h2>
    <p>Your journal entries, mood logs, habits, and goals belong to you. We will never share your private content with third parties.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">5. Service Availability</h2>
    <p>SoftLife is provided "as is." We reserve the right to modify or discontinue features with reasonable notice.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">6. Account Termination</h2>
    <p>You may delete your account anytime by contacting us. Upon termination, your data will be deleted within 30 days.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">7. Disclaimer</h2>
    <p>SoftLife is a personal growth tool, not a medical or mental health service. If you are experiencing a crisis, please contact a qualified professional or emergency services.</p>

    <h2 style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-top:40px;">8. Contact</h2>
    <p>Questions? <a onclick="location.href='contact.php'" style="color:var(--primary);cursor:pointer;text-decoration:underline;">Contact us here</a>.</p>

    <div style="margin-top:48px;text-align:center;">
      <button onclick="location.href='index.php'" style="padding:12px 28px;background:linear-gradient(135deg,#f472b6,#ec4899);color:#fff;border:none;border-radius:12px;font-size:.95rem;font-weight:600;cursor:pointer;">← Back to Home</button>
    </div>
  </section>

  <footer class="home-footer" role="contentinfo">
    <div class="home-footer-brand">
      <div style="display:flex;align-items:center;gap:8px;font-family:'DM Serif Display',serif;font-size:1.2rem;color:var(--text);"><span>🌱</span> SoftLife</div>
      <p>Your personal growth companion. Track, reflect, and grow — gently, every day.</p>
    </div>
    <div class="home-footer-links">
      <h5>Company</h5>
      <ul>
        <li><a onclick="location.href='about.php'">About Us</a></li>
        <li><a onclick="location.href='privacy.php'">Privacy Policy</a></li>
        <li><a onclick="location.href='terms.php'" style="color:var(--primary);">Terms of Service</a></li>
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

<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
</body>
</html>
