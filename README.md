# 🌱 SoftLife — Personal Growth Tracker

A PHP + MySQL personal growth tracker with habit tracking, mood logging, goals, journal, and analytics.

---

## 📋 What Was Added / Fixed

| # | Requirement | Status |
|---|-------------|--------|
| 1 | Reserved usernames (admin, administrator, root) blocked | ✅ Done |
| 2 | Names/usernames must start with a letter — no leading numbers/special chars | ✅ Done |
| 3 | Country and Gender are dropdowns (not free text) | ✅ Done |
| 4 | Email must be valid and unique — duplicate check | ✅ Done |
| 5 | PHP session_start() on login, session_destroy() on logout, unauthorized access blocked | ✅ Done |
| 6 | 5 separate pages (not SPA): index.php, about.php, login.php, signup.php, dashboard.php | ✅ Done |
| 7 | Full Name field added to signup | ✅ Done |
| 8 | Railway deployment config (Dockerfile + railway.toml) | ✅ Done |

---

## 🖥️ Pages

| Page | File | Access |
|------|------|--------|
| Home | `index.php` | Public |
| About | `about.php` | Public |
| Login | `login.php` | Public (redirects to dashboard if logged in) |
| Signup | `signup.php` | Public (redirects to dashboard if logged in) |
| Dashboard | `dashboard.php` | **Login required** (redirects to login if not authenticated) |

---

## 🔐 Validation Rules

### Username
- Must be **4–15 characters**
- Must **start with a letter** (A-Z)
- Only letters, numbers, underscore allowed
- **Reserved usernames blocked**: admin, administrator, root, superuser, moderator, mod, system
- ✅ Allowed: `Kashif123`, `Hassam`, `soft_user`
- ❌ Not Allowed: `123Kashif`, `Hassam@786`, `admin`

### Full Name
- Must **start with a letter**
- Letters, numbers, spaces allowed
- No special characters (@, #, !, etc.)
- ✅ Allowed: `Kashif Ahmad`, `Ali123`
- ❌ Not Allowed: `123Ali`, `Hassan@786`

### Email
- Must be a valid email format
- Must be unique (no duplicate accounts)

### Gender & Country
- Both are **dropdown lists** — no manual typing
- Prevents spelling mistakes and invalid values

### Session Security
- `session_start()` called on login/signup
- `session_destroy()` called on logout
- Dashboard protected — unauthorized users redirected to login
- Token also validated against database (expiry check)

---

## 🚀 Running on XAMPP (Local)

1. Copy the `SoftLife_Updated` folder into `C:\xampp\htdocs\`
2. Start **Apache** and **MySQL** in XAMPP Control Panel
3. Import `softlife_db.sql` in **phpMyAdmin** (or it auto-creates on first visit)
4. Open: `http://localhost/SoftLife_Updated/`

---

## ☁️ Deploy to Railway.app

### Step 1: Push to GitHub
```bash
git init
git add .
git commit -m "SoftLife initial commit"
git remote add origin https://github.com/YOUR_USERNAME/softlife.git
git push -u origin main
```

### Step 2: Create Railway Project
1. Go to [railway.app](https://railway.app) → **New Project**
2. Choose **Deploy from GitHub repo** → select your repo
3. Railway auto-detects the `Dockerfile` and builds

### Step 3: Add MySQL Database
1. In your Railway project → click **+ New** → **Database** → **MySQL**
2. Railway auto-sets these environment variables in your PHP app:
   - `MYSQLHOST`, `MYSQLPORT`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE`
   - Your `config/db.php` reads these automatically ✅

### Step 4: Set Environment Variables
In Railway → your PHP service → **Variables**, add:
```
FRONTEND_URL=https://your-app.railway.app
```

### Step 5: Deploy
Railway builds and deploys automatically. Your site will be live at:
`https://your-project-name.railway.app`

---

## 📁 Project Structure

```
SoftLife_Updated/
├── index.php          ← Home page (public)
├── about.php          ← About Us page (public)
├── login.php          ← Login page (public)
├── signup.php         ← Signup page (public, with all validations)
├── dashboard.php      ← Dashboard (LOGIN REQUIRED)
├── app.js             ← All frontend JS
├── style.css          ← All CSS styles
├── softlife_db.sql    ← Database schema
├── Dockerfile         ← Docker config for Railway
├── railway.toml       ← Railway deployment settings
├── .htaccess          ← Apache security config
├── api/
│   ├── login.php      ← Login API (session_start)
│   ├── logout.php     ← Logout API (session_destroy)
│   ├── signup.php     ← Signup API (all validations)
│   ├── load.php       ← Load user data
│   ├── habits.php     ← Habits CRUD
│   ├── moods.php      ← Mood logging
│   ├── activities.php ← Activities CRUD
│   ├── goals.php      ← Goals CRUD
│   ├── journal.php    ← Journal CRUD
│   └── feedback.php   ← Feedback
├── config/
│   └── db.php         ← DB connection + auto table creation
└── includes/
    ├── helpers.php    ← API helpers (ok, fail, requireAuth)
    ├── session_guard.php ← requireLogin() + redirectIfLoggedIn()
    └── head.php       ← Shared HTML <head>
```
# SoftLife - Personal Growth Tracker
