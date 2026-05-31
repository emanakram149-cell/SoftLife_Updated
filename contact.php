<?php
session_start();
require_once __DIR__ . '/includes/helpers.php';
$pageTitle = 'Contact Us – SoftLife';
$csrfToken = generateCsrfToken();
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

<div id="contactPage" class="page active" role="main" aria-label="Contact SoftLife">

  <!-- NAV -->
  <nav class="home-nav" aria-label="Main navigation">
    <button class="home-nav-logo" onclick="location.href='index.php'" aria-label="Go to home">
      <span aria-hidden="true">🌱</span> SoftLife
    </button>
    <div class="home-nav-links">
      <button class="home-nav-link" onclick="location.href='index.php'">Home</button>
      <button class="home-nav-link" onclick="location.href='about.php'">About Us</button>
      <button class="home-nav-link" style="color:var(--primary);">Contact</button>
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
  <section style="background:linear-gradient(135deg,#f9a8d4 0%,#f472b6 50%,#ec4899 100%);padding:80px 24px 60px;text-align:center;">
    <h1 style="font-family:'DM Serif Display',serif;font-size:clamp(2rem,5vw,3rem);color:#fff;margin-bottom:16px;">
      💌 Get in Touch
    </h1>
    <p style="color:rgba(255,255,255,.9);font-size:1.1rem;max-width:500px;margin:0 auto;">
      We'd love to hear from you. Whether it's a question, feedback, or just a hello — we're here.
    </p>
  </section>

  <!-- CONTACT CONTENT -->
  <section style="max-width:980px;margin:0 auto;padding:60px 24px;display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;">

    <!-- CONTACT INFO (LEFT) -->
    <div style="display:flex;flex-direction:column;gap:16px;">
      <div>
        <h2 style="font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--text);margin:0 0 6px;">Let's connect</h2>
        <p style="color:var(--muted);font-size:.9rem;margin:0 0 20px;">We're a small team that genuinely cares. Reach out anytime.</p>
      </div>

      <!-- Email -->
      <div style="display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px 20px;">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#f9a8d4,#ec4899);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">📧</div>
        <div>
          <p style="font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px;">Email</p>
          <p style="font-size:.95rem;font-weight:600;color:var(--text);margin:0;">support@softlife.app</p>
          <p style="font-size:.8rem;color:var(--muted);margin:2px 0 0;">Reply within 24–48 hours</p>
        </div>
      </div>

      <!-- Phone -->
      <div style="display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px 20px;">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#a78bfa,#7c3aed);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">📞</div>
        <div>
          <p style="font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px;">Phone</p>
          <p style="font-size:.95rem;font-weight:600;color:var(--text);margin:0;">+92 300 0000000</p>
          <p style="font-size:.8rem;color:var(--muted);margin:2px 0 0;">Mon–Fri, 9am – 6pm PKT</p>
        </div>
      </div>

      <!-- Location -->
      <div style="display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px 20px;">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#6ee7b7,#059669);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">📍</div>
        <div>
          <p style="font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px;">Location</p>
          <p style="font-size:.95rem;font-weight:600;color:var(--text);margin:0;">Lahore, Punjab, Pakistan</p>
          <p style="font-size:.8rem;color:var(--muted);margin:2px 0 0;">Remote-first team 🌍</p>
        </div>
      </div>

      <!-- Support Hours -->
      <div style="display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px 20px;">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#fde68a,#f59e0b);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">🕐</div>
        <div>
          <p style="font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px;">Support Hours</p>
          <p style="font-size:.95rem;font-weight:600;color:var(--text);margin:0;">Mon – Fri, 9am – 6pm</p>
          <p style="font-size:.8rem;color:var(--muted);margin:2px 0 0;">We try on weekends too 💜</p>
        </div>
      </div>

      <!-- Feedback Widget -->
      <div style="display:flex;align-items:center;gap:14px;background:var(--card);border:1px solid var(--border);border-radius:14px;padding:16px 20px;">
        <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#93c5fd,#3b82f6);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.2rem;">💬</div>
        <div>
          <p style="font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin:0 0 2px;">Feedback Widget</p>
          <p style="font-size:.95rem;font-weight:600;color:var(--text);margin:0;">Use 🤖 on any page</p>
          <p style="font-size:.8rem;color:var(--muted);margin:2px 0 0;">Instant feedback, straight to us</p>
        </div>
      </div>

      <!-- Bottom note -->
      <div style="background:linear-gradient(135deg,rgba(244,114,182,.1),rgba(236,72,153,.05));border:1px solid rgba(244,114,182,.3);border-radius:14px;padding:18px 20px;">
        <p style="color:var(--text);font-size:.9rem;margin:0;line-height:1.6;">
          💜 <strong>We read every message.</strong> Your feedback shapes what we build next.
        </p>
      </div>
    </div>

    <!-- CONTACT FORM (RIGHT) -->
    <div style="background:var(--card);border:1px solid var(--border);border-radius:20px;padding:32px;">
      <h2 style="font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--text);margin-bottom:6px;">Send us a message</h2>
      <p style="color:var(--muted);margin-bottom:24px;font-size:.9rem;">We usually respond within 24–48 hours.</p>

      <div style="display:flex;flex-direction:column;gap:14px;">
        <div>
          <label style="font-size:.8rem;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">Your Name</label>
          <input type="text" id="contactName" placeholder="e.g. Sarah" style="width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:.9rem;background:var(--bg);color:var(--text);outline:none;box-sizing:border-box;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
        </div>
        <div>
          <label style="font-size:.8rem;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">Email Address</label>
          <input type="email" id="contactEmail" placeholder="you@example.com" style="width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:.9rem;background:var(--bg);color:var(--text);outline:none;box-sizing:border-box;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
        </div>
        <div>
          <label style="font-size:.8rem;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">Subject</label>
          <select id="contactSubject" style="width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:.9rem;background:var(--bg);color:var(--text);outline:none;box-sizing:border-box;">
            <option value="">Select a topic…</option>
            <option value="general">General Inquiry</option>
            <option value="support">Technical Support</option>
            <option value="feedback">Feedback / Suggestions</option>
            <option value="privacy">Privacy / Data</option>
            <option value="bug">Report a Bug</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div>
          <label style="font-size:.8rem;font-weight:600;color:var(--text);display:block;margin-bottom:6px;">Message</label>
          <textarea id="contactMessage" rows="5" maxlength="250" placeholder="Tell us what's on your mind…" style="width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:.9rem;background:var(--bg);color:var(--text);outline:none;box-sizing:border-box;resize:vertical;font-family:inherit;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'" oninput="document.getElementById('msgCounter').textContent=this.value.length+'/250';document.getElementById('msgCounter').style.color=this.value.length>=240?'#ef4444':'var(--muted)';"></textarea>
          <div style="text-align:right;margin-top:4px;"><span id="msgCounter" style="font-size:.78rem;color:var(--muted);">0/250</span></div>
        </div>

        <div id="contactResult" style="display:none;padding:12px 14px;border-radius:10px;font-size:.88rem;font-weight:500;"></div>

        <button onclick="submitContactForm()" style="padding:13px 28px;background:linear-gradient(135deg,#f472b6,#ec4899);color:#fff;border:none;border-radius:12px;font-size:.95rem;font-weight:600;cursor:pointer;letter-spacing:.01em;">
          Send Message 💌
        </button>
      </div>
    </div>

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
        <li><a onclick="location.href='index.php'">Features</a></li>
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
    <div class="home-footer-links">
      <h5>Connect</h5>
      <ul>
        <li><a onclick="location.href='contact.php'" style="color:var(--primary);">Contact Us</a></li>
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
<script>
function submitContactForm() {
  var name = document.getElementById('contactName').value.trim();
  var email = document.getElementById('contactEmail').value.trim();
  var subject = document.getElementById('contactSubject').value;
  var message = document.getElementById('contactMessage').value.trim();
  var result = document.getElementById('contactResult');

  if (!name) { showContactResult('❌ Please enter your name.', false); return; }
  if (!email || !/^[^@]+@[^@]+\.[^@]+$/.test(email)) { showContactResult('❌ Please enter a valid email.', false); return; }
  if (!subject) { showContactResult('❌ Please select a subject.', false); return; }
  if (message.length < 10) { showContactResult('❌ Please write at least 10 characters.', false); return; }
  if (message.length > 250) { showContactResult('❌ Message must be 250 characters or less.', false); return; }

  var btn = document.querySelector('button[onclick="submitContactForm()"]');
  if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }

  fetch('api/contact.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({name: name, email: email, subject: subject, message: message, csrf_token: '<?= htmlspecialchars($csrfToken) ?>'})
  })
  .then(function(r){ return r.json(); })
  .then(function(data){
    if (data.success) {
      showContactResult('✅ Message sent! We\'ll get back to you within 24–48 hours. Thank you 💜', true);
      document.getElementById('contactName').value = '';
      document.getElementById('contactEmail').value = '';
      document.getElementById('contactSubject').value = '';
      document.getElementById('contactMessage').value = '';
      document.getElementById('msgCounter').textContent = '0/250';
      document.getElementById('msgCounter').style.color = 'var(--muted)';
    } else {
      showContactResult('❌ ' + (data.error || 'Something went wrong. Please try again.'), false);
    }
    if (btn) { btn.disabled = false; btn.textContent = 'Send Message 💌'; }
  })
  .catch(function(){
    showContactResult('❌ Network error. Please try again.', false);
    if (btn) { btn.disabled = false; btn.textContent = 'Send Message 💌'; }
  });
}

function showContactResult(msg, success) {
  var r = document.getElementById('contactResult');
  r.textContent = msg;
  r.style.display = 'block';
  r.style.background = success ? 'rgba(34,197,94,.1)' : 'rgba(239,68,68,.1)';
  r.style.color = success ? '#16a34a' : '#dc2626';
  r.style.border = success ? '1px solid rgba(34,197,94,.3)' : '1px solid rgba(239,68,68,.3)';
}
</script>
</body>
</html>
