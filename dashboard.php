<?php
// ── SESSION PROTECTION: block unauthorized access ──
require_once __DIR__ . '/includes/session_guard.php';
requireLogin('login.php');

$pageTitle = 'Dashboard – SoftLife';
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
<div id="dashPage" class="page active" role="main" aria-label="Dashboard">

  <!-- SIDEBAR -->
  <nav id="sidebar" role="navigation" aria-label="Main navigation">
    <div class="sidebar-header">
      <span class="sidebar-logo" aria-hidden="true">🌱</span>
      <span class="sidebar-brand">SoftLife</span>
      <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Collapse sidebar" id="sidebarToggleBtn">◀</button>
    </div>

    <div class="sidebar-nav">
      <div class="nav-section-label">Main</div>
      <a class="nav-item active" onclick="showSection('overview')" role="button" tabindex="0" data-section="overview" aria-label="Dashboard overview">
        <span class="nav-icon" aria-hidden="true">🏡</span>
        <span class="nav-label">Dashboard</span>
      </a>
      <a class="nav-item" onclick="showSection('habits')" role="button" tabindex="0" data-section="habits" aria-label="Habits tracker">
        <span class="nav-icon" aria-hidden="true">✅</span>
        <span class="nav-label">Habits</span>
      </a>
      <a class="nav-item" onclick="showSection('mood')" role="button" tabindex="0" data-section="mood" aria-label="Mood log">
        <span class="nav-icon" aria-hidden="true">😊</span>
        <span class="nav-label">Mood Log</span>
      </a>
      <a class="nav-item" onclick="showSection('activities')" role="button" tabindex="0" data-section="activities" aria-label="Activities">
        <span class="nav-icon" aria-hidden="true">🏃</span>
        <span class="nav-label">Activities</span>
      </a>

      <div class="nav-section-label">Growth</div>
      <a class="nav-item" onclick="showSection('goals')" role="button" tabindex="0" data-section="goals" aria-label="Goals">
        <span class="nav-icon" aria-hidden="true">🎯</span>
        <span class="nav-label">Goals</span>
      </a>
      <a class="nav-item" onclick="showSection('journal')" role="button" tabindex="0" data-section="journal" aria-label="Journal">
        <span class="nav-icon" aria-hidden="true">📓</span>
        <span class="nav-label">Journal</span>
      </a>
      <a class="nav-item" onclick="showSection('milestones')" role="button" tabindex="0" data-section="milestones" aria-label="Milestones & streaks">
        <span class="nav-icon" aria-hidden="true">🏅</span>
        <span class="nav-label">Milestones</span>
      </a>
      <a class="nav-item" onclick="showSection('analytics')" role="button" tabindex="0" data-section="analytics" aria-label="Analytics">
        <span class="nav-icon" aria-hidden="true">📊</span>
        <span class="nav-label">Analytics</span>
      </a>

      <div class="nav-section-label">Account</div>
      <a class="nav-item" onclick="showSection('profile')" role="button" tabindex="0" data-section="profile" aria-label="Profile">
        <span class="nav-icon" aria-hidden="true">👤</span>
        <span class="nav-label">Profile</span>
      </a>
      <a class="nav-item" onclick="location.href='index.php'" role="button" tabindex="0" aria-label="Go to Home page">
        <span class="nav-icon" aria-hidden="true">🏠</span>
        <span class="nav-label">Home Page</span>
      </a>
      <a class="nav-item" onclick="location.href='about.php'" role="button" tabindex="0" aria-label="About Us">
        <span class="nav-icon" aria-hidden="true">ℹ️</span>
        <span class="nav-label">About Us</span>
      </a>
      <a class="nav-item nav-feedback-btn" onclick="openFeedbackModal()" role="button" tabindex="0" aria-label="Send Feedback">
        <span class="nav-icon" aria-hidden="true">
          <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="3" width="16" height="11" rx="3" stroke="currentColor" stroke-width="1.6"/>
            <circle cx="7"  cy="8.5" r="1.2" fill="currentColor"/>
            <circle cx="10" cy="8.5" r="1.2" fill="currentColor"/>
            <circle cx="13" cy="8.5" r="1.2" fill="currentColor"/>
            <path d="M6 14l-3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
          </svg>
        </span>
        <span class="nav-label">Feedback</span>
      </a>
      <a class="nav-item" onclick="handleLogout()" role="button" tabindex="0" aria-label="Log out">
        <span class="nav-icon" aria-hidden="true">🚪</span>
        <span class="nav-label">Log Out</span>
      </a>
    </div>

    <div class="sidebar-user">
      <div class="user-avatar" id="sidebarAvatar" aria-hidden="true">U</div>
      <div class="user-info">
        <div class="user-name" id="sidebarUsername">User</div>
        <div class="user-role">SoftLife Member</div>
      </div>
    </div>
  </nav>

  <!-- SIDEBAR OVERLAY (mobile) -->
  <div id="sidebarOverlay" onclick="closeMobileSidebar()"
       style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:399;"
       aria-hidden="true"></div>

  <!-- TOPBAR -->
  <header id="topbar" role="banner">
    <button class="hamburger-btn" onclick="openMobileSidebar()" aria-label="Open navigation menu" aria-expanded="false" id="hamburgerBtn">☰</button>
    <h1 class="topbar-title" id="topbarTitle">Dashboard</h1>

    <!-- Fix #8: Mobile search icon — hidden on desktop, shown on ≤640px -->
    <button id="mobileSearchBtn"
            style="display:none;background:none;border:none;cursor:pointer;font-size:1.15rem;padding:6px;color:var(--text);flex-shrink:0;"
            onclick="toggleMobileSearch()"
            aria-label="Open search" title="Search">🔍</button>

    <!-- ── SEARCH BAR ── -->
    <div class="topbar-search-wrap" id="topbarSearchWrap">
      <span class="tsw-icon">🔍</span>
      <input id="topbarSearchInput" class="tsw-input" type="text"
             placeholder="Search habits, goals, journal…"
             oninput="runTopbarSearch(this.value)"
             onkeydown="if(event.key==='Escape'){this.value='';runTopbarSearch('');}"
             aria-label="Search" autocomplete="off">
      <button class="tsw-clear" id="tswClear" onclick="document.getElementById('topbarSearchInput').value='';runTopbarSearch('');" aria-label="Clear search">✕</button>
    </div>
    <div id="topbarSearchResults" class="tsw-results" role="listbox" aria-label="Search results"></div>

    <div class="topbar-actions">
      <button class="topbar-btn" onclick="location.href='index.php'" aria-label="Go to Home page" title="Home Page">🏠</button>
      <button class="topbar-btn" onclick="location.href='about.php'" aria-label="About Us" title="About Us">ℹ️</button>
      <button class="topbar-btn dark-toggle" onclick="toggleDark()" aria-label="Toggle dark mode" title="Dark Mode">🌙</button>
      <button class="topbar-btn" onclick="showSection('profile')" aria-label="Profile" title="Profile">👤</button>
    </div>
  </header>

  <!-- ── MAIN CONTENT AREA ── -->
  <div class="dash-main" id="dashMain">

    <!-- ─── OVERVIEW ─── -->
    <section class="dash-section active" id="overview" aria-label="Dashboard overview">
      <div class="section-header">
        <h2 id="overviewGreeting">Welcome! 🌱</h2>
        <p id="overviewDate" id="overviewDate"></p>
        <script>
        (function(){
          var now = new Date();
          var h = now.getHours();
          var greet = h < 12 ? 'Good morning' : h < 17 ? 'Good afternoon' : 'Good evening';
          var emoji = h < 12 ? '🌅' : h < 17 ? '🌤️' : '🌙';
          var name = localStorage.getItem('sl_username') || 'Friend';
          document.getElementById('overviewGreeting').textContent = greet + ', ' + name + '! ' + emoji;
          document.getElementById('overviewDate').textContent = now.toLocaleDateString('en-US', {weekday:'long', year:'numeric', month:'long', day:'numeric'});
        })();
        </script>
      </div>

      <!-- STATS -->
      <div class="stats-grid" aria-label="Today's stats">
        <div class="stat-card" role="article" aria-label="Habits today">
          <div class="stat-icon" aria-hidden="true">✅</div>
          <div class="stat-val" id="statHabits">0/0</div>
          <div class="stat-label">Habits Today</div>
          <div class="stat-trend trend-up" id="statHabitsTrend">Start tracking!</div>
        </div>
        <div class="stat-card" role="article" aria-label="Current mood">
          <div class="stat-icon" aria-hidden="true">😊</div>
          <div class="stat-val" id="statMood">—</div>
          <div class="stat-label">Today's Mood</div>
          <div class="stat-trend" id="statMoodTrend" style="color:var(--muted)">Log your mood</div>
        </div>
        <div class="stat-card" role="article" aria-label="Active goals">
          <div class="stat-icon" aria-hidden="true">🎯</div>
          <div class="stat-val" id="statGoals">0</div>
          <div class="stat-label">Active Goals</div>
          <div class="stat-trend trend-up" id="statGoalsTrend">Keep going!</div>
        </div>
        <div class="stat-card" role="article" aria-label="Day streak">
          <div class="stat-icon" aria-hidden="true">🔥</div>
          <div class="stat-val" id="statStreak">1</div>
          <div class="stat-label">Day Streak</div>
          <div class="stat-trend trend-up">You're on fire!</div>
        </div>
      </div>

      <!-- MAIN GRID -->
      <div class="content-grid">
        <!-- Today's Habits Quick View -->
        <div class="card">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;">Today's Habits</h3>
            <button class="add-btn" onclick="showSection('habits')" style="font-size:.76rem;padding:6px 12px;">View All</button>
          </div>
          <div id="overviewHabits"></div>
        </div>

        <!-- Quick Mood -->
        <div class="card">
          <div style="margin-bottom:14px;">
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;">How are you feeling?</h3>
            <p style="font-size:.8rem;color:var(--text2);margin-top:4px;">Log today's mood</p>
          </div>
          <div class="mood-grid" id="overviewMoodBtns">
            <button class="mood-btn" onclick="logMood('😄','Amazing')" aria-label="Amazing mood"><span class="mood-emoji">😄</span><span class="mood-label">Amazing</span></button>
            <button class="mood-btn" onclick="logMood('🙂','Happy')" aria-label="Happy mood"><span class="mood-emoji">🙂</span><span class="mood-label">Happy</span></button>
            <button class="mood-btn" onclick="logMood('😐','Neutral')" aria-label="Neutral mood"><span class="mood-emoji">😐</span><span class="mood-label">Neutral</span></button>
            <button class="mood-btn" onclick="logMood('😕','Sad')" aria-label="Sad mood"><span class="mood-emoji">😕</span><span class="mood-label">Sad</span></button>
            <button class="mood-btn" onclick="logMood('😞','Rough')" aria-label="Rough mood"><span class="mood-emoji">😞</span><span class="mood-label">Rough</span></button>
          </div>
          <div id="moodFeedback" style="margin-top:12px;font-size:.85rem;color:var(--text2);text-align:center;"></div>
        </div>
      </div>

      <!-- GOALS + STREAK -->
      <div class="content-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:14px;">Active Goals</h3>
          <div id="overviewGoals"></div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:6px;">Weekly Streak 🔥</h3>
          <p style="font-size:.78rem;color:var(--muted);margin-bottom:14px;">Your activity this week</p>
          <div class="streak-bar" id="overviewStreak" aria-label="Weekly streak">
            <div class="streak-day active" title="Mon"></div>
            <div class="streak-day active" title="Tue"></div>
            <div class="streak-day active" title="Wed"></div>
            <div class="streak-day today" title="Thu – Today"></div>
            <div class="streak-day" title="Fri"></div>
            <div class="streak-day" title="Sat"></div>
            <div class="streak-day" title="Sun"></div>
          </div>
          <div style="display:flex;justify-content:space-between;margin-top:6px;font-size:.7rem;color:var(--muted);">
            <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
          </div>
          <div style="margin-top:16px;padding:12px;background:var(--bg);border-radius:var(--radius-sm);">
            <div style="font-size:.8rem;font-weight:700;color:var(--text2);margin-bottom:6px;">This Week's Progress</div>
            <div class="progress-wrap">
              <div class="progress-label"><span>Overall</span><span id="weeklyPercent">57%</span></div>
              <div class="progress-bar"><div class="progress-fill" id="weeklyFill" style="width:57%"></div></div>
            </div>
          </div>
        </div>
      </div>

      <!-- MAP -->
      <div class="map-dash-card" role="complementary" aria-label="Location map">
        <div class="map-dash-header"><span aria-hidden="true">📍</span> Your Location & Community</div>
        <iframe class="map-dash-frame"
          title="SoftLife community map"
          src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15372183.46!2d69.3!3d30.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spk!4v1700000000000"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </section>

    <!-- ─── HABITS ─── -->
    <section class="dash-section" id="habits" aria-label="Habits tracker">
      <div class="section-header">
        <h2>Habits Tracker ✅</h2>
        <p>Build your daily routines, one check at a time</p>
      </div>
      <div class="quick-add" role="form" aria-label="Add new habit">
        <div class="input-wrap" style="flex:1;min-width:200px;">
          <span class="ico" aria-hidden="true">✅</span>
          <input type="text" id="newHabitInput" class="form-input" placeholder="New habit (e.g. Morning run)" maxlength="100" aria-label="New habit name">
        </div>
        <button class="add-btn" onclick="addHabit()" aria-label="Add habit">+ Add Habit</button>
      </div>
      <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;" id="habitDateLabel">Today's Habits</h3>
          <span class="chip" id="habitCompletedChip">0/0 done</span>
        </div>
        <div id="habitList" role="list" aria-label="Habit list" aria-live="polite"></div>
      </div>
    </section>

    <!-- ─── MOOD ─── -->
    <section class="dash-section" id="mood" aria-label="Mood log">
      <div class="section-header">
        <h2>Mood Log 😊</h2>
        <p>Track your emotional wellbeing over time</p>
      </div>
      <div class="content-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:16px;">Log Today's Mood</h3>
          <div class="mood-grid" id="moodSectionBtns">
            <button class="mood-btn" onclick="logMood('😄','Amazing')" aria-label="Amazing"><span class="mood-emoji">😄</span><span class="mood-label">Amazing</span></button>
            <button class="mood-btn" onclick="logMood('🙂','Happy')" aria-label="Happy"><span class="mood-emoji">🙂</span><span class="mood-label">Happy</span></button>
            <button class="mood-btn" onclick="logMood('😐','Neutral')" aria-label="Neutral"><span class="mood-emoji">😐</span><span class="mood-label">Neutral</span></button>
            <button class="mood-btn" onclick="logMood('😕','Sad')" aria-label="Sad"><span class="mood-emoji">😕</span><span class="mood-label">Sad</span></button>
            <button class="mood-btn" onclick="logMood('😞','Rough')" aria-label="Rough"><span class="mood-emoji">😞</span><span class="mood-label">Rough</span></button>
          </div>
          <div style="margin-top:16px;">
            <label for="moodNote" style="font-size:.78rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.6px;">Add a note (optional)</label>
            <textarea id="moodNote" class="form-textarea" placeholder="How are you feeling today? What's on your mind?" maxlength="250" aria-label="Mood note"></textarea>
          </div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:14px;">Mood History</h3>
          <div id="moodHistory" aria-label="Mood history" aria-live="polite"></div>
        </div>
      </div>
    </section>

    <!-- ─── ACTIVITIES ─── -->
    <section class="dash-section" id="activities" aria-label="Activities">
      <div class="section-header">
        <h2>Activities 🏃</h2>
        <p>Log your exercise and physical activities</p>
      </div>
      <div class="quick-add" role="form" aria-label="Add activity">
        <div class="input-wrap" style="flex:1;min-width:160px;">
          <span class="ico" aria-hidden="true">🏃</span>
          <input type="text" id="newActivityName" class="form-input" placeholder="Activity name" maxlength="100" aria-label="Activity name">
        </div>
        <div class="input-wrap" style="width:100px;">
          <span class="ico" aria-hidden="true">⏱</span>
          <input type="number" id="newActivityDur" class="form-input" placeholder="Mins" min="1" max="999" aria-label="Duration in minutes">
        </div>
        <select id="newActivityType" class="form-select" style="width:140px;" aria-label="Activity type">
          <option value="🏃 Running">🏃 Running</option>
          <option value="🚴 Cycling">🚴 Cycling</option>
          <option value="🏊 Swimming">🏊 Swimming</option>
          <option value="🧘 Yoga">🧘 Yoga</option>
          <option value="💪 Gym">💪 Gym</option>
          <option value="🚶 Walking">🚶 Walking</option>
          <option value="⚽ Sport">⚽ Sport</option>
          <option value="🏋️ Other">🏋️ Other</option>
        </select>
        <button class="add-btn" onclick="addActivity()" aria-label="Add activity">+ Add</button>
      </div>
      <div class="card">
        <div id="activityList" aria-label="Activity list" aria-live="polite"></div>
      </div>
    </section>

    <!-- ─── GOALS ─── -->
    <section class="dash-section" id="goals" aria-label="Goals">
      <div class="section-header">
        <h2>Goals 🎯</h2>
        <p>Set intentions and track your progress</p>
      </div>
      <div class="quick-add" role="form" aria-label="Add goal">
        <div class="input-wrap" style="flex:1;min-width:200px;">
          <span class="ico" aria-hidden="true">🎯</span>
          <input type="text" id="newGoalInput" class="form-input" placeholder="My new goal…" maxlength="100" aria-label="Goal title">
        </div>
        <input type="date" id="newGoalDate" class="form-input" style="width:160px;" aria-label="Goal target date">
        <select id="newGoalCat" class="form-select" style="width:130px;" aria-label="Goal category">
          <option value="Health">💚 Health</option>
          <option value="Career">💼 Career</option>
          <option value="Finance">💰 Finance</option>
          <option value="Learning">📚 Learning</option>
          <option value="Social">🤝 Social</option>
          <option value="Personal">🌱 Personal</option>
        </select>
        <button class="add-btn" onclick="addGoal()" aria-label="Add goal">+ Add Goal</button>
      </div>
      <div id="goalList" aria-label="Goals list" aria-live="polite"></div>
    </section>

    <!-- ─── JOURNAL ─── -->
    <section class="dash-section" id="journal" aria-label="Journal">
      <div class="section-header">
        <h2>Journal 📓</h2>
        <p>Capture your thoughts, reflections and memories</p>
      </div>
      <div class="content-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:16px;">New Entry ✍️</h3>
          <div class="form-group">
            <label for="journalTitle">Title</label>
            <div class="input-wrap">
              <span class="ico" aria-hidden="true">📝</span>
              <input type="text" id="journalTitle" class="form-input" placeholder="Entry title…" maxlength="100" aria-label="Journal title">
            </div>
          </div>
          <div class="form-group">
            <label for="journalContent">Your Thoughts <span style="color:var(--muted);font-weight:400">(max 1000 chars)</span></label>
            <textarea id="journalContent" class="form-textarea" rows="5" placeholder="Write freely…" maxlength="1000" aria-label="Journal content" style="min-height:140px;"></textarea>
            <div style="text-align:right;font-size:.72rem;color:var(--muted);margin-top:4px;" id="journalCounter">0/1000</div>
          </div>
          <button class="add-btn" onclick="addJournalEntry()" aria-label="Save journal entry" style="width:100%;">Save Entry 💾</button>
        </div>
        <div class="card" style="max-height:500px;overflow-y:auto;">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:14px;">Past Entries</h3>
          <div id="journalList" aria-label="Journal entries" aria-live="polite"></div>
        </div>
      </div>
    </section>

    <!-- ─── MILESTONES ─── -->
    <section class="dash-section" id="milestones" aria-label="Milestones and streaks">
      <div class="section-header">
        <h2>Milestones & Streaks 🏅</h2>
        <p>Celebrate your wins and keep the momentum</p>
      </div>
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">🔥</div>
          <div class="stat-val" id="ms_streak">1</div>
          <div class="stat-label">Day Streak</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">✅</div>
          <div class="stat-val" id="ms_habits">0</div>
          <div class="stat-label">Total Habits Done</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🎯</div>
          <div class="stat-val" id="ms_goals">0</div>
          <div class="stat-label">Goals Completed</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">📓</div>
          <div class="stat-val" id="ms_entries">0</div>
          <div class="stat-label">Journal Entries</div>
        </div>
      </div>

      <div class="content-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:14px;">30-Day Streak Calendar</h3>
          <div id="streakCalendar" style="display:grid;grid-template-columns:repeat(7,1fr);gap:5px;" aria-label="Streak calendar"></div>
          <div style="display:flex;gap:12px;margin-top:12px;font-size:.75rem;color:var(--muted);align-items:center;">
            <span style="display:flex;align-items:center;gap:4px;"><span style="width:12px;height:12px;border-radius:3px;background:var(--primary);display:inline-block;"></span>Active</span>
            <span style="display:flex;align-items:center;gap:4px;"><span style="width:12px;height:12px;border-radius:3px;background:var(--border);display:inline-block;"></span>Missed</span>
          </div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:14px;">Badges Earned 🏆</h3>
          <div id="badgeList" style="display:flex;flex-wrap:wrap;gap:10px;" aria-label="Earned badges"></div>
        </div>
      </div>
    </section>

    <!-- ─── ANALYTICS ─── -->
    <section class="dash-section" id="analytics" aria-label="Analytics">
      <div class="section-header">
        <h2>Analytics 📊</h2>
        <p>Visualize your progress over the past 7 days</p>
      </div>
      <div class="analytics-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1rem;margin-bottom:14px;">Habit Completion Rate</h3>
          <div class="chart-wrap"><canvas id="habitChart" aria-label="Habit completion chart"></canvas></div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1rem;margin-bottom:14px;">Mood Trend</h3>
          <div class="chart-wrap"><canvas id="moodChart" aria-label="Mood trend chart"></canvas></div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1rem;margin-bottom:14px;">Activity Minutes</h3>
          <div class="chart-wrap"><canvas id="activityChart" aria-label="Activity chart"></canvas></div>
        </div>
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1rem;margin-bottom:14px;">Weekly Summary</h3>
          <div id="analyticsSummary"></div>
        </div>
      </div>
    </section>

    <!-- ─── PROFILE ─── -->
    <section class="dash-section" id="profile" aria-label="Profile">
      <div class="section-header">
        <h2>My Profile 👤</h2>
        <p>Manage your personal information and preferences</p>
      </div>
      <div class="profile-header-card" role="article" aria-label="Profile header">
        <div class="profile-avatar-lg" id="profileAvatar" aria-hidden="true">U</div>
        <div>
          <div class="profile-name-lg" id="profileName">User</div>
          <div class="profile-joined" id="profileEmail">user@email.com</div>
          <div style="margin-top:8px;">
            <span class="chip" style="background:rgba(255,255,255,.25);color:#fff;" id="profileThemeChip">Default Theme</span>
          </div>
        </div>
      </div>

      <div class="content-grid">
        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:18px;">Edit Profile</h3>
          <div class="form-group">
            <label for="editUsername">Display Name</label>
            <div class="input-wrap">
              <span class="ico" aria-hidden="true">👤</span>
              <input type="text" id="editUsername" class="form-input" maxlength="15" aria-label="Display name" oninput="validateUsername(this)">
            </div>
          </div>
          <div class="form-group">
            <label for="editBio">Bio <span style="color:var(--muted);font-weight:400">(max 200 chars)</span></label>
            <textarea id="editBio" class="form-textarea" placeholder="Tell us about yourself…" maxlength="200" aria-label="Bio"></textarea>
          </div>
          <div class="form-group">
            <label>Theme Preference</label>
            <div class="gender-picker" style="margin-bottom:0;">
              <button type="button" class="g-btn" id="profileMaleBtn" onclick="setGender('male');saveProfile()" aria-pressed="false">♂️ Male / Green</button>
              <button type="button" class="g-btn" id="profileFemaleBtn" onclick="setGender('female');saveProfile()" aria-pressed="false">♀️ Female / Pink</button>
            </div>
          </div>
          <button class="btn-primary" onclick="saveProfile()" aria-label="Save profile changes">Save Changes ✓</button>
        </div>

        <div class="card">
          <h3 style="font-family:'DM Serif Display',serif;font-size:1.1rem;margin-bottom:18px;">App Settings</h3>
          <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="display:flex;align-items:center;justify-content:space-between;">
              <div><div style="font-weight:600;font-size:.9rem;">Dark Mode</div><div style="font-size:.76rem;color:var(--muted);">Easier on the eyes</div></div>
              <button class="topbar-btn" onclick="toggleDark()" aria-label="Toggle dark mode">🌙</button>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
              <div><div style="font-weight:600;font-size:.9rem;">High Contrast</div><div style="font-size:.76rem;color:var(--muted);">Accessibility boost</div></div>
              <button class="topbar-btn" onclick="toggleContrast()" aria-label="Toggle high contrast">🌗</button>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
              <div><div style="font-weight:600;font-size:.9rem;">Text-to-Speech</div><div style="font-size:.76rem;color:var(--muted);">Read page aloud</div></div>
              <button class="topbar-btn" onclick="toggleTTS()" aria-label="Toggle TTS">🔊</button>
            </div>
            <div style="border-top:1px solid var(--border);padding-top:16px;">
              <button class="btn-danger" onclick="clearAllData()" aria-label="Clear all data" style="width:100%;">🗑️ Clear All Data</button>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div><!-- end dash-main -->
</div><!-- end dashPage -->

<!-- =====================================================
     MODAL (generic)
===================================================== -->
<div id="modalOverlay" class="modal-overlay" role="dialog" aria-modal="true" aria-label="Dialog" onclick="handleModalOverlayClick(event)">
  <div class="modal" id="modalContent">
    <h3 id="modalTitle">Confirm</h3>
    <p id="modalBody" style="color:var(--text2);font-size:.9rem;line-height:1.6;"></p>
    <div class="modal-actions">
      <button class="btn-sec" onclick="closeModal()" aria-label="Cancel">Cancel</button>
      <button class="btn-danger" id="modalConfirmBtn" aria-label="Confirm">Confirm</button>
    </div>
  </div>
</div>


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


<script>window.__SOFTLIFE_MULTIPAGE__ = true;</script>
<script src="app.js"></script>
</body>
</html>

<script>
// Override logout to go to login.php after session destroy
window.handleLogout = function() {
  showModal('Log Out?', 'Are you sure you want to sign out of SoftLife?', async () => {
    await apiCall('/logout.php','POST');
    localStorage.removeItem('sl_token');
    location.href = 'login.php';
  });
};

document.addEventListener('DOMContentLoaded', function(){
  var dp = document.getElementById('dashPage');
  if(dp) { dp.classList.add('active'); dp.style.display=''; }
});
</script>
</body>
</html>
