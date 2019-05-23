<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Test Project based on Yii 2</h1>
    <br>
</p>



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.0


INSTALLATION
------------

### Clone repository

First you need to clone the repository of this project:

~~~
git clone https://github.com/pivasikkost/test-case-greenice <target folder>
~~~

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Some project files are not contained in the repository, to install them, go to the project directory and execute the command:

~~~
php composer.phar install
~~~


CONFIGURATION
-------------
### Params

For Google maps to work correctly, specify your Google maps js api key in `config/params-local.php` like in `config/params.php`

### Database

Then you need specify the actual database access for your server in the file `config/db.php` or `config/db-local.php`

### Migration

Then you need to create a database for this project and fill it with migrations. You will need to go to the project directory and execute the command:
```
php yii migrate
```

### Verifying the installation

After the done actions you need only to configure the web server and go to host url
