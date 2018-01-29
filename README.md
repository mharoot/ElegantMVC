# ElegantMVC
Transitioning from super controller to instance of controllers and views

### .htaccess
```
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.+)$ index.php/$1 [L]
```

### Database
```
+----------------+
| Tables_in_test |
+----------------+
| categories     |
| customers      |
| employees      |
| orderdetails   |
| orders         |
| products       |
| shippers       |
| suppliers      |
+----------------+
```

