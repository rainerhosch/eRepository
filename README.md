# eRepository

eRepository is a web portal for book libraries, where there are two main roles, namely admin and member.

## Installation

```bash
git clone https://github.com/rzoktan/eRepository.git
```

## .htaccess

```htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

```

## config/config.php

```php
// Dinamis base_url
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://" . $_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

```

## config/database.php

```php
$config['live']; //for production
$config['development']; //for development

```

## Table Of Content


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
