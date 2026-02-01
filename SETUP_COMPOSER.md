# 📦 SETUP AMOEBA FRAMEWORK UNTUK COMPOSER

## ✅ LANGKAH-LANGKAH YANG SUDAH DILAKUKAN:

### 1️⃣ Setup composer.json
- ✓ File `composer.json` dibuat dengan konfigurasi yang benar
- ✓ PSR-4 autoloading sudah dikonfigurasi
- ✓ Dependencies (PHPMailer, Rakit Validation) sudah ditambahkan

### 2️⃣ Buat installer script
- ✓ `install.php` - Script yang berjalan setelah create-project
- ✓ Membuat folder otomatis
- ✓ Generate APP_KEY
- ✓ Membuat .env dari .env.example

### 3️⃣ Stub files untuk project baru
- ✓ `config/app.php` stub
- ✓ `config/database.php` stub
- ✓ `.env.example` stub
- ✓ `index.php` stub
- ✓ `.htaccess` stub

### 4️⃣ Dokumentasi
- ✓ `README.md` lengkap
- ✓ `LICENSE` file (MIT)

---

## 🚀 LANGKAH SELANJUTNYA:

### Step 1: Push ke GitHub

```bash
cd /mnt/data/Local/Projects/amoeba-framework

# Inisialisasi git (jika belum)
git init

# Add semua file
git add .

# Commit
git commit -m "Initial commit: Amoeba Framework ready for Composer"

# Add remote repository (ganti URL dengan repository Anda)
git remote add origin https://github.com/yourusername/amoeba-framework.git

# Push ke main branch
git branch -M main
git push -u origin main
```

### Step 2: Register ke Packagist

1. Buka https://packagist.org
2. Login dengan GitHub account (atau buat account baru)
3. Klik "Submit Package"
4. Paste URL repository GitHub Anda:
   ```
   https://github.com/yourusername/amoeba-framework.git
   ```
5. Klik "Check"
6. Jika OK, klik "Submit"

### Step 3: Setup Auto-Update (Opsional)

Di GitHub:
1. Buka repository Settings
2. Klik "Webhooks" 
3. Packagist akan provide webhook URL
4. Add webhook agar Packagist update otomatis

### Step 4: Testing di Local

Setelah publish, test di local folder lain:

```bash
# Create project baru
composer create-project yourusername/amoeba-framework test-project

# Or dengan branch specific:
composer create-project yourusername/amoeba-framework:dev-main test-project
```

---

## 📋 CHECKLIST SEBELUM PUBLISH:

- [ ] Edit `composer.json`:
  - [ ] Ubah `yourusername` dengan username GitHub Anda
  - [ ] Sesuaikan description
  - [ ] Edit authors dengan info Anda

- [ ] Edit `.env.example`:
  - [ ] Set default values yang sesuai

- [ ] Edit `install.php`:
  - [ ] Sesuaikan pesan greeting jika perlu

- [ ] Siapkan GitHub repository:
  - [ ] Create repository baru di GitHub
  - [ ] Repository name: `amoeba-framework`
  - [ ] Set ke Public

- [ ] Setup Packagist account:
  - [ ] Login/Create account di packagist.org
  - [ ] Connect dengan GitHub account

---

## 🎯 STRUKTUR FOLDER SEKARANG:

```
amoeba-framework/
├── components/
├── config/
├── core/
├── helpers/
├── middleware/
├── models/
├── resources/
│   └── stubs/
│       ├── config_app.stub
│       ├── config_database.stub
│       ├── env_example.stub
│       ├── htaccess.stub
│       └── index.stub
├── views/
├── writepath/
├── .gitignore          ✓ Updated
├── .htaccess
├── composer.json       ✓ Created
├── install.php         ✓ Created
├── LICENSE             ✓ Created
├── README.md           ✓ Created
└── index.php
```

---

## 💡 CARA MENGGUNAKAN SETELAH PUBLISH:

User baru bisa create project dengan command:

```bash
composer create-project yourusername/amoeba-framework my-awesome-app
cd my-awesome-app
php -S localhost:8000
```

Dan otomatis:
✓ Dependency terinstall
✓ Directory structure dibuat
✓ Config files dibuat
✓ APP_KEY generated
✓ .env file dibuat
✓ Siap digunakan!

---

## ❓ JIKA MENGGUNAKAN LARAVEL INSTALLER (OPTIONAL):

Anda bisa membuat installer command seperti Laravel juga, tapi untuk awal ini setup di atas sudah cukup bagus.

Pastikan ganti "yourusername" dengan username GitHub Anda sebelum publish!
