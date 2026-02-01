# Amoeba Framework

A lightweight, flexible PHP framework for building web applications. 

## Features

- **Lightweight & Fast** - Minimal overhead, maximum performance
- **Flexible Routing** - Simple and intuitive URL routing system
- **Component-Based** - Organize your code with reusable components
- **Built-in Validation** - Powerful form validation with Rakit
- **Email Support** - Send emails with PHPMailer
- **CSRF Protection** - Built-in CSRF token handling
- **Multi-language Support** - Built-in internationalization
- **Cache System** - Query and file-based caching
- **Database Abstraction** - Support for multiple database connections

## Requirements

- PHP 7.4 or higher
- MySQL/MariaDB (or any PDO-supported database)
- Apache with mod_rewrite enabled (or equivalent on other servers)

## Installation

### Method 1: Using Composer (Recommended)

```bash
composer create-project amoeba/framework my-project
cd my-project
```

This will automatically:
- Install all dependencies
- Create necessary directories (config, components, models, views, etc.)
- Generate default configuration files
- Set up .htaccess for URL rewriting

### Method 2: Manual Setup

1. Clone the repository:
```bash
git clone https://github.com/yourusername/amoeba-framework.git my-project
cd my-project
composer install
```

2. Run setup script:
```bash
php create-project.php
```

## Configuration

### Database Configuration (`config/database.php`)

Edit `config/database.php` with your database credentials:

```php
<?php
$connection = array(
    'default' => array(
        'driver'        => 'mysql',
        'host'          => 'localhost',
        'port'          => '3306',
        'dbname'        => 'your_database',
        'username'      => 'your_username',
        'password'      => 'your_password'
    )
);
?>
```

### Application Configuration (`config/app.php`)

Edit `config/app.php` to customize your application settings.

⚠️ **Important**: Configuration files are NOT tracked in version control (see `.gitignore`). They contain sensitive database credentials and secret keys.

## Quick Start

1. **Configure database** - Edit `config/database.php`
2. **Configure application** - Edit `config/app.php`
3. **Create a component** - Add file to `components/` folder
4. **Create a view** - Add PHP template to `views/` folder
5. **Run development server**:
   ```bash
   php -S localhost:8000
   ```
6. **Visit** `http://localhost:8000` in your browser

## Directory Structure

```
my-project/
├── index.php                 # Entry point
├── core/                     # Framework core files
│   ├── app.php              # Main application class
│   ├── autoload.php         # PSR-4 autoloader
│   ├── cache.php            # Caching system
│   ├── database.php         # Database connection
│   ├── model.php            # Base model class
│   └── ...
├── config/                   # Configuration files (NOT in version control)
│   ├── app.php              # Application settings
│   └── database.php         # Database configuration
├── components/              # Reusable components
├── models/                  # Data models
├── views/                   # View templates
├── helpers/                 # Helper functions
├── middleware/              # Custom middleware
├── public/                  # Static assets (CSS, JS, images)
├── writepath/              # Writable directory for cache/logs
│   ├── cache/
│   └── logs/
├── .htaccess               # Apache rewrite rules
├── composer.json           # Composer configuration
└── create-project.php      # Setup script
```

## Usage

### Creating a Simple Component

Create a component file at `components/welcome.php`:

```php
<?php
class Welcome {
    public function index() {
        $data = [
            'title' => 'Welcome to Amoeba Framework',
            'message' => 'Hello, World!'
        ];
        return view('welcome', $data);
    }
}
?>
```

Create a view at `views/welcome.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $message ?></h1>
</body>
</html>
```

Access via: `http://localhost:8000/welcome`

### Working with Database

Models inherit from the base Model class:

```php
<?php
namespace Amoeba\Models;

use Amoeba\Model;

class User extends Model {
    protected $table = 'users';

    public function getUsers() {
        return $this->db->get('users')->fetchAll();
    }
}
?>
```

### Using Helpers

Helpers are auto-loaded:

```php
<?php
// CSRF Protection
csrf_token();
verify_csrf_token($_POST['csrf_token']);

// General helpers
get_config('app_name');
is_https();
dd($variable); // Debug dump

// View helpers
echo view('template', $data);
?>
```

## Publishing to Packagist

To make this framework available via Composer package manager:

### Step 1: Create GitHub Repository

```bash
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/yourusername/amoeba-framework.git
git push -u origin main
```

### Step 2: Submit to Packagist

1. Go to [packagist.org](https://packagist.org)
2. Click "Submit Package"
3. Enter your GitHub repository URL
4. Click "Check" then "Submit"

### Step 3: Setup Auto-Updates (Optional but Recommended)

1. Go to GitHub repository Settings → Webhooks
2. Add webhook using URL provided by Packagist
3. Now updates happen automatically on each push

### Step 4: Create Release Tags

```bash
git tag v1.0.0
git push origin v1.0.0
```

Then anyone can install your framework:

```bash
composer create-project amoeba/framework my-new-project
```

## Setup Script

Run the setup script to initialize a new project:

```bash
php create-project.php
```

This script:
- Creates required directories
- Generates default configuration files
- Sets up .htaccess for URL rewriting
- Creates index.php entry point

## Security Considerations

⚠️ **Important**:

1. **Never commit config files** - They're in `.gitignore` by default and contain:
   - Database credentials
   - CSRF keys
   - Encryption keys

2. **Generate unique keys**:
   ```bash
   # Generate CSRF key (32 characters)
   php -r "echo bin2hex(random_bytes(16));"

   # Generate encryption IV (16 characters)
   php -r "echo bin2hex(random_bytes(8));"

   # Generate encryption key (7 characters)
   php -r "echo substr(bin2hex(random_bytes(4)), 0, 7);"
   ```

3. **Disable debug in production**:
   ```php
   // config/app.php
   'debug' => false,
   'display_errors' => false,
   'log_errors' => true,
   ```

4. **Set proper file permissions**:
   ```bash
   chmod 755 writepath/
   chmod 755 writepath/cache/
   ```

## Troubleshooting

### 404 Error on All Pages

Make sure:
- `.htaccess` exists in project root
- Apache `mod_rewrite` is enabled
- Or use `index.php?page=component-name` format

### Database Connection Error

Check `config/database.php`:
- Host, port, username, password are correct
- Database exists
- User has proper privileges

### Configuration Files Missing

Run the setup script:
```bash
php create-project.php
```

## Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For issues, questions, or suggestions:
- Create an issue on GitHub
- Email: support@yoursite.com

---

**Happy coding with Amoeba Framework!** 🦠

- ✓ Simple routing system
- ✓ MVC architecture
- ✓ Helper functions
- ✓ CSRF protection
- ✓ Email support (PHPMailer)
- ✓ Input validation
- ✓ Session management
- ✓ Caching system

## Creating a New Model

```php
<?php
namespace Amoeba\Models;

use Amoeba\Model;

class Post extends Model {
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'author_id'];
}
```

## Creating a Component

Create file in `components/` directory:

```php
<?php
// components/welcome.php

echo "Welcome to Amoeba Framework!";
```

Then include it:
```php
component('welcome');
```

## Configuration

Edit configuration files in `config/` directory to customize:
- Application settings (`app.php`)
- Database connection (`database.php`)

## Contributing

If you'd like to contribute to Amoeba Framework, please follow PSR-12 coding standards.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For issues and questions, please open an issue on GitHub.
