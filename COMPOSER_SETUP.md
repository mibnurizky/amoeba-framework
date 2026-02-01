# Panduan Lengkap: Upload Amoeba Framework ke Composer

Dokumentasi lengkap untuk membuat Amoeba Framework bisa diinstall via Composer seperti Laravel.

## 📋 Daftar Isi

1. [Setup Lokal](#setup-lokal)
2. [Publish ke GitHub](#publish-ke-github)
3. [Submit ke Packagist](#submit-ke-packagist)
4. [Testing](#testing)
5. [Troubleshooting](#troubleshooting)

---

## 🎯 Setup Lokal

### Status Saat Ini ✅

File-file sudah siap:

- ✅ **composer.json** - Configured sebagai `amoeba/framework`
- ✅ **create-project.php** - Script setup otomatis
- ✅ **.gitignore** - Exclude config files dengan credentials
- ✅ **LICENSE** - MIT license
- ✅ **README.md** - Dokumentasi lengkap

### Cek Struktur Folder

```bash
ls -la /mnt/data/Local/Projects/amoeba-framework/
```

Pastikan ada:
- `config/` - Folder konfigurasi
- `core/` - Framework core
- `components/` - Components
- `helpers/` - Helpers
- `models/` - Models
- `views/` - Views
- `middleware/` - Middleware
- `composer.json` ✅
- `create-project.php` ✅
- `.gitignore` ✅
- `LICENSE` ✅

---

## 🚀 Publish ke GitHub

### Step 1: Prepare Repository

Pastikan workspace sudah clean:

```bash
cd /mnt/data/Local/Projects/amoeba-framework

# Check status
git status

# Add all files (except yang di .gitignore)
git add .

# Commit
git commit -m "Prepare for Composer package"
```

### Step 2: Create GitHub Repository

1. Go to [github.com](https://github.com) - Login/Register
2. Click **"New"** untuk create repository baru
3. **Repository name**: `amoeba-framework`
4. **Description**: `A lightweight PHP framework for building web applications`
5. **Visibility**: Public
6. **Initialize**: Uncheck (jangan init, kita push existing repo)
7. Click **"Create repository"**

### Step 3: Push to GitHub

```bash
# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/amoeba-framework.git

# Rename branch ke main (jika masih master)
git branch -M main

# Push ke GitHub
git push -u origin main
```

### Step 4: Verify on GitHub

- Visit: `https://github.com/YOUR_USERNAME/amoeba-framework`
- Pastikan semua files ter-upload
- Pastikan `.gitignore` working (config/ ada di .gitignore, jadi jangan ter-upload)

---

## 📦 Submit ke Packagist

### Step 1: Create Packagist Account

1. Go to [packagist.org](https://packagist.org)
2. Click **"Sign up"**
3. Create account dengan GitHub OAuth (recommended)
4. Login ke Packagist

### Step 2: Submit Package

1. Di Packagist, klik **"Submit Package"**
2. Masukkan GitHub repository URL:
   ```
   https://github.com/YOUR_USERNAME/amoeba-framework
   ```
3. Klik **"Check"** - tunggu verifikasi
4. Klik **"Submit"**

**Status**: Package sekarang ada di Packagist! 🎉

### Step 3: Setup Auto-Update Webhook (Opsional tapi Recommended)

Agar Packagist otomatis update saat push ke GitHub:

#### Cara 1: Packagist Webhook (Recommended)

1. Di Packagist, ke profile settings
2. Cari section **"Webhooks"**
3. Copy webhook URL
4. Di GitHub repository:
   - Settings → Webhooks → Add webhook
   - Paste webhook URL
   - Content type: `application/json`
   - Active: check
   - Click "Add webhook"

#### Cara 2: GitHub Action (Alternative)

Buat `.github/workflows/sync-packagist.yml`:

```yaml
name: Sync Packagist

on:
  push:
    tags:
      - '*'

jobs:
  packagist:
    runs-on: ubuntu-latest
    steps:
      - name: Call Packagist
        run: |
          curl -XPOST https://packagist.org/api/update-package?username=${{ secrets.PACKAGIST_USERNAME }}&apiToken=${{ secrets.PACKAGIST_API_TOKEN }} \
          -d '{"repository":{"url":"https://github.com/${{ github.repository }}"}}'
```

---

## ✅ Testing

### Test 1: Verify on Packagist

```bash
# Visit Packagist
https://packagist.org/packages/amoeba/framework

# Should show:
# - Package name: amoeba/framework
# - Latest version
# - Installation instruction
```

### Test 2: Test Installation Globally

Persiapan:
1. Buat folder temporary: `/tmp/test-amoeba`
2. Install dari Composer

```bash
# Create test directory
mkdir -p /tmp/test-amoeba
cd /tmp/test-amoeba

# Install from Packagist
composer create-project amoeba/framework test-project

# Check installation
cd test-project
ls -la

# Verify files exist:
# - config/ directory
# - components/ directory
# - create-project.php
# - index.php
```

### Test 3: Run Setup Script

```bash
cd test-project

# Run setup
php create-project.php

# Should output:
# ✓ Created config directory
# ✓ Created config/app.php
# ✓ Created config/database.php
# ✓ Created .htaccess
# etc...
```

### Test 4: Verify Auto-Generated Files

```bash
# Check config files created
ls -la config/

# Should have:
# - app.php (with default config)
# - database.php (with empty credentials)
# - .htaccess
```

---

## 🏷️ Create Version Tags

Setelah testing berhasil:

```bash
cd /mnt/data/Local/Projects/amoeba-framework

# Create semantic version tag
git tag v1.0.0

# Push tag ke GitHub
git push origin v1.0.0

# Verify tag
git tag -l
```

**Packagist akan otomatis detect tag baru dan update!**

---

## 🔄 Update Package (for Future Versions)

### Workflow untuk Update

```bash
# 1. Make changes to framework
vim core/app.php
vim README.md
# ... etc

# 2. Commit changes
git add .
git commit -m "Feature: add caching system"

# 3. Create new tag (increment version)
git tag v1.1.0

# 4. Push everything
git push origin main
git push origin v1.1.0

# 5. Packagist auto-updates! ✅
```

### Semantic Versioning

Follow semver untuk tag naming:
- `v1.0.0` - Initial release
- `v1.0.1` - Bug fix (patch)
- `v1.1.0` - New feature (minor)
- `v2.0.0` - Breaking change (major)

---

## 📝 Update Documentation

Update info berikut di file-file:

### In composer.json
```json
"name": "YOUR_USERNAME/amoeba-framework",
"homepage": "https://github.com/YOUR_USERNAME/amoeba-framework"
```

### In create-project.php
Jika perlu update welcome message, edit section ini:

```php
echo "║       Amoeba Framework - Project Setup             ║\n";
```

### In README.md
- Change GitHub URLs
- Add your contact info
- Add documentation links (jika ada)

---

## 🐛 Troubleshooting

### Issue: "Package tidak muncul di Packagist"

**Solution**:
1. Pastikan GitHub repository public
2. Pastikan composer.json valid:
   ```bash
   composer validate
   ```
3. Re-submit di Packagist

### Issue: "composer create-project gagal"

**Cek**:
```bash
# Test di local
composer create-project amoeba/framework test-project --dev

# Check untuk error details
# Biasanya di .gitignore issue atau version constraints
```

### Issue: "create-project.php tidak jalan"

**Pastikan**:
- `"scripts"` di composer.json correct:
  ```json
  "post-create-project-cmd": ["php create-project.php"]
  ```
- File `create-project.php` exists di root
- PHP dapat execute file

### Issue: Config files ter-upload ke GitHub

**Fix**:
1. Pastikan `.gitignore` ada entry:
   ```
   /config/app.php
   /config/database.php
   ```
2. Remove dari Git cache:
   ```bash
   git rm --cached config/app.php config/database.php
   git commit -m "Remove config files from tracking"
   git push
   ```

---

## 📚 Dokumentasi Berguna

- [Composer Documentation](https://getcomposer.org/doc/)
- [Packagist - Submitting Packages](https://packagist.org/about)
- [Semantic Versioning](https://semver.org/)
- [GitHub Webhooks](https://docs.github.com/en/developers/webhooks-and-events/webhooks)

---

## ✨ Final Checklist

- [ ] composer.json configured dengan nama paket
- [ ] create-project.php siap
- [ ] .gitignore exclude config files
- [ ] LICENSE file ada
- [ ] README.md lengkap
- [ ] GitHub repository created & public
- [ ] Semua files ter-push ke GitHub
- [ ] Package submit ke Packagist
- [ ] Webhook configured (optional)
- [ ] Testing successful
- [ ] v1.0.0 tag created
- [ ] Installation instruction di dokumentasi

---

## 🎉 Sekarang Siap!

Users bisa install framework Anda dengan simple command:

```bash
composer create-project amoeba/framework my-project
cd my-project
```

Framework Anda siap digunakan sama seperti Laravel! 🚀

---

**Happy packaging!** 📦
