# Liz

Intends to be a useful way to turn structure of small projects to an MVC architecture with a front Controller. Simple and small objective

## Install

### Install Composer

> Execute: `curl -s https://getcomposer.org/installer | php`

> Execute: `php composer.phar install`
    
### Setup htaccess

create file ".htaccess" in the root project with this content

    <IfModule mod_rewrite.c>
    	RewriteEngine On
    	RewriteCond %{REQUEST_FILENAME} -s [OR]
    	RewriteCond %{REQUEST_FILENAME} -l [OR]
    	RewriteCond %{REQUEST_FILENAME} !-d
    	RewriteCond %{REQUEST_FILENAME} !-f
    	RewriteRule ^.*$ - [NC,L]
    	RewriteRule !\.(js|ico|gif|jpg|png|css|htm|html|txt|mp3)$ index.php [NC,L]
    </IfModule>

### Requirements

    1. PHP 5.3+
    2. Enable mod_rewrite (apache)

## Structure

    liz
    ├── index.php
    ├── lib
    │   └── Liz
    │       └── Core
    │           ├── Bootstrapper.php
    │           ├── Configurator.php
    │           ├── Controller.php
    │           ├── Model.php
    │           └── View.php
    ├── public
    └── src
        └── App
            ├── Bootstrap.php
            ├── Configs
            │   └── Application.ini
            ├── Controllers
            │   └── Index.php
            ├── Layouts
            │   └── Layout.phtml
            ├── Models
            │   └── Model.php
            └── Views
                └── Index
                    └── Index.phtml
> `./lib/Liz/Core`

Contain the structure that pick up the pieces of MVC. Leave this folder in peace :)

> `./public`

Put your JS, CSS, Fonts, Images and multimedia files here

> `./src/App`

Your Application will be developed in this folder.

1. `Bootstrap.php` - Don't edit this file unless you know what you are doing!
2. `Configs` folder - put your configurations in this folder
3. `Controllers` folder - the controller file name and the classes should be the same name using CamelCase style
4. `Layouts` folder - contains the html code that should be used for structures that repeat
5. `Models` folder - the model file name and the classes should be the same name using CamelCase style
6. `Views` folder - the folder inside have the name of the called controller and the file (into the folder) have the name of Action (Controller's method). The file content is HTML

## Controllers

Create the controllers in the folder `./src/App/Controllers`. Follow example:

```php
    <?php
    
    namespace App\Controllers;
    
    use Liz\Core\Controller;    
    
    class Example extends Controller
    {    
        public function index()
        { 
        	# code
        }
    }
```
    
> `ps:` This Controller automatically show the View located at `./src/App/Views/Example/Index.phtml`

## Models
Create the models in the folder `./src/App/Models`. Follow example:

```php
    <?php
    
    namespace App\Models;
    
    use Liz\Core\Model;
    
    class ModelTest extends Model
    {
    	public function someFunction()
    	{
    		# code
    	}
    }
```

To call this model in some Controller follow the steps:

1. Declare `use App\Models\ModelTest` in your Controller
2. Just instantiate the model in function `$model = new ModelTest()`

## Views

You can put your HTML combined with small pieces of php (passed by Controller, or not :)

## Credits

I was inspired by the code of [Ricardo Coelho](https://github.com/ramcoelho) and your project [grs](https://github.com/ramcoelho/grs). Thank you bro!

##  Doubts, suggestions?

Open an Issue [here](https://github.com/gigante/liz/issues/new)

## License

The MIT License (MIT)

Copyright (c) 2014 [Hiarison Gigante](http://gigante.pro)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.