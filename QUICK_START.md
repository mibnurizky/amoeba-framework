# 🚀 Quick Start Commands

Commands yang perlu Anda jalankan step-by-step untuk publish framework ke Composer.

## Phase 1: Local Preparation ✅ (DONE)

Sudah siap:
```
✅ composer.json - Configured
✅ create-project.php - Setup script
✅ .gitignore - Exclude config files
✅ LICENSE - MIT license
✅ README.md - Full documentation
✅ COMPOSER_SETUP.md - Step-by-step guide
```

## Phase 2: GitHub Setup (NEXT)

### Step 1: Prepare Local Repository

```bash
cd /mnt/data/Local/Projects/amoeba-framework

# Check git status
git status

# Add all changes
git add .

# Commit
git commit -m "Setup for Composer package"
```

### Step 2: Create GitHub Repository

1. Go to [github.com/new](https://github.com/new)
2. Repository name: `amoeba-framework`
3. Make it **PUBLIC**
4. Click "Create repository"
5. Copy your repository URL (format: `https://github.com/YOUR_USERNAME/amoeba-framework.git`)

### Step 3: Push to GitHub

```bash
# Replace YOUR_USERNAME with actual username
git remote add origin https://github.com/YOUR_USERNAME/amoeba-framework.git
git branch -M main
git push -u origin main

# Verify on GitHub
# Open: https://github.com/YOUR_USERNAME/amoeba-framework
```

## Phase 3: Packagist Submission (THEN)

### Step 1: Go to Packagist

```
https://packagist.org/
```

### Step 2: Sign Up (if needed)

- Click "Sign up"
- Use GitHub OAuth (easier)

### Step 3: Submit Package

1. Click "Submit Package"
2. Enter GitHub URL: `https://github.com/YOUR_USERNAME/amoeba-framework`
3. Click "Check"
4. Click "Submit"

### Step 4: Verify

Visit: `https://packagist.org/packages/amoeba/framework`

## Phase 4: Testing (OPTIONAL but RECOMMENDED)

Test installation before making it public:

```bash
# Create test directory
mkdir -p /tmp/amoeba-test
cd /tmp/amoeba-test

# Test installation (may take a minute)
composer create-project amoeba/framework test-app

# Check if setup works
cd test-app
php create-project.php

# Verify files
ls -la config/
ls -la
```

## Phase 5: Release Version (FINAL)

After testing successfully:

```bash
cd /mnt/data/Local/Projects/amoeba-framework

# Create version tag
git tag v1.0.0

# Push tag
git push origin v1.0.0

# Verify
git tag -l
```

**Packagist auto-updates! 🎉**

---

## 📋 Checklist

Before each phase:

### Before Push to GitHub
- [ ] `git status` shows clean state
- [ ] No sensitive data in commits
- [ ] README.md has correct info

### Before Packagist Submit
- [ ] GitHub repository is PUBLIC
- [ ] All code pushed to GitHub
- [ ] LICENSE file exists

### Before Creating Release Tag
- [ ] Testing on clean install successful
- [ ] All config files auto-generated correctly
- [ ] Documentation updated

---

## 🔗 Installation Command (After Release)

Once published:

```bash
# Users can install with:
composer create-project amoeba/framework my-project

# Just like Laravel!
composer create-project laravel/laravel my-project
```

---

## 📞 Need Help?

- **Composer Issues**: [getcomposer.org/doc](https://getcomposer.org/doc/)
- **Packagist Help**: [packagist.org/about](https://packagist.org/about)
- **GitHub Help**: [docs.github.com](https://docs.github.com)

---

## 💡 Pro Tips

1. **Test locally before submission**
   ```bash
   composer create-project --dev amoeba/framework test
   ```

2. **Use GitHub Releases**
   - Create releases for each version
   - Add changelog in release notes

3. **Setup Webhook for auto-updates**
   - Make Packagist auto-update on each push
   - See COMPOSER_SETUP.md for details

4. **Keep dependencies updated**
   - Run `composer update` regularly
   - Update dependencies in composer.json as needed

---

**You got this! 🚀**
