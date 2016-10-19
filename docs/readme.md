# To DO

-	form delle pagine con WYSIWYG scaricato con npm e gulp




**php artisan app:name Cms**


**authentication**

Want to get started fast? Just run 

php artisan make:auth 
and 
php artisan migrate

These two commands will take care of scaffolding your entire authentication system!


At its core, Laravel's authentication facilities are made up of "guards" and "providers

Guards define how users are authenticated for each request. 
For example, Laravel ships with a session guard which maintains state using session storage and cookies.


Providers define how users are retrieved from your persistent storage. Laravel ships with support for retrieving users using Eloquent and the database query builder. However, you are free to define additional providers as needed for your application.


**Admin**

Tutti i controller in admin estendono il controller AdminController che ha nel costruttore il middleware auth per autenticazione !!!





**package.json file**


installo node.js (che ha già una versione di npm)

aggiorno la versione di npm con 

sudo npm install npm -g

a questo punto installo le dipendenze lette dal package.json con 

npm install

questo crea la cartella node_modules con tutti i moduli e le dipendenze installati

Next, you'll need to pull in Gulp as a global NPM package:

sudo npm install --global gulp-cli


Once the dependencies have been installed using npm install, you can compile your SASS files to plain CSS using Gulp. 
The gulp command will process the instructions in your gulpfile.js file. Typically, your compiled CSS will be placed in the public/css directory:

luigi@lenovo /var/www/html/celiachiamo $ gulp
[16:43:59] Using gulpfile /var/www/html/celiachiamo/gulpfile.js
[16:43:59] Starting 'all'...
[16:43:59] Starting 'sass'...
[16:44:01] Finished 'sass' after 1.34 s
[16:44:01] Starting 'webpack'...
[16:44:04] 
[16:44:04] Finished 'webpack' after 3.72 s
[16:44:04] Finished 'all' after 5.06 s
[16:44:04] Starting 'default'...
┌───────────────┬───────────────────────────────┬────────────────────────────────┬────────────────────┐
│ Task          │ Summary                       │ Source Files                   │ Destination        │
├───────────────┼───────────────────────────────┼────────────────────────────────┼────────────────────┤
│ mix.sass()    │ 1. Compiling Sass             │ resources/assets/sass/app.scss │ public/css/app.css │
│               │ 2. Autoprefixing CSS          │                                │                    │
│               │ 3. Concatenating Files        │                                │                    │
│               │ 4. Writing Source Maps        │                                │                    │
│               │ 5. Saving to Destination      │                                │                    │
├───────────────┼───────────────────────────────┼────────────────────────────────┼────────────────────┤
│ mix.webpack() │ 1. Transforming ES2015 to ES5 │ resources/assets/js/app.js     │ public/js/app.js   │
│               │ 2. Writing Source Maps        │                                │                    │
│               │ 3. Saving to Destination      │                                │                    │
└───────────────┴───────────────────────────────┴────────────────────────────────┴────────────────────┘
[16:44:04] Finished 'default' after 6.33 ms

ATTENZIONE

http://localhost:8000/fonts/bootstrap/glyphicons-halflings-regular.woff2 Failed to load resource: the server responded with a status of 404 (Not Found)

non vedo le icone di bootstrap perché mancano dei font che vengono cercati in fonts/bootstrap

Quindi aggiungo con elixir il comando per copiare i font nella directory

.copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts');

rilancio gulp

gulp
[16:55:42] Using gulpfile /var/www/html/celiachiamo/gulpfile.js
[16:55:42] Starting 'all'...
[16:55:42] Starting 'sass'...
[16:55:43] Finished 'sass' after 1.22 s
[16:55:43] Starting 'webpack'...
[16:55:46] 
[16:55:47] Finished 'webpack' after 3.88 s
[16:55:47] Starting 'copy'...
[16:55:47] Finished 'copy' after 47 ms
[16:55:47] Finished 'all' after 5.15 s
[16:55:47] Starting 'default'...
┌───────────────┬───────────────────────────────┬───────────────────────────────────────────────┬────────────────────┐
│ Task          │ Summary                       │ Source Files                                  │ Destination        │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.sass()    │ 1. Compiling Sass             │ resources/assets/sass/app.scss                │ public/css/app.css │
│               │ 2. Autoprefixing CSS          │                                               │                    │
│               │ 3. Concatenating Files        │                                               │                    │
│               │ 4. Writing Source Maps        │                                               │                    │
│               │ 5. Saving to Destination      │                                               │                    │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.webpack() │ 1. Transforming ES2015 to ES5 │ resources/assets/js/app.js                    │ public/js/app.js   │
│               │ 2. Writing Source Maps        │                                               │                    │
│               │ 3. Saving to Destination      │                                               │                    │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.copy()    │ 1. Saving to Destination      │ node_modules/bootstrap-sass/assets/fonts/**/* │ public/fonts       │
└───────────────┴───────────────────────────────┴───────────────────────────────────────────────┴────────────────────┘
[16:55:47] Finished 'default' after 5.76 ms


**users management - CRUD**


Per il form non utilizzo il package esterno laravelcollective/html, ma rimango con form html ed utilizzo old()


> What everyone seems to be missing is that if you are not using the laravelcollective/html package you can easily do this by taking advantage of the fact that old() takes a default parameter.  value="{{ old('my-input', $default-my-input) }}"

> so:
value="{{ old('my-input',  isset($post->title) ? $post->title : null) }}" 




**compiling assets**

The gulpfile.js file in your project's root directory contains all of your Elixir tasks. 
Elixir tasks can be chained together to define exactly how your assets should be compiled.

CSS
- The sass method allows you to compile Sass into CSS.
- If you would just like to combine some plain CSS stylesheets into a single file, you may use the  styles method

JS
- The webpack method may be used to compile and bundle ECMAScript 2015 into plain JavaScript.
- If you have multiple JavaScript files that you would like to combine into a single file, you may use the scripts method, which provides automatic source maps, concatenation, and minification.


If you intend to concatenate multiple pre-minified vendor libraries, such as jQuery, instead consider using mix.combine(). This will combine the files, while omitting the source map and minification steps. As a result, compile times will drastically improve.


__
Voglio aggiungere jQuery: il file package.json contiene già di default jquery come dipendenza, quindi è già stato scaricato (con npm install)

=================================================================================================================================================================================
=================================================================================================================================================================================

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js')
       .combine(['public/js/app.js','node_modules/jquery/dist/jquery.min.js'],'public/js/app.js')
       .copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts') ;
});

con webpack compilo il js e lo salvo in public/js/app.js
con combine concateno public/js/app.js + node_modules/jquery/dist/jquery.min.js in public/js/app.js 

 gulp
[07:40:01] Using gulpfile ~/Code/Laravel/public/cellav/gulpfile.js
[07:40:01] Starting 'all'...
[07:40:01] Starting 'sass'...
[07:40:02] Finished 'sass' after 1.45 s
[07:40:02] Starting 'webpack'...
[07:40:05] 
[07:40:05] Finished 'webpack' after 3.12 s
[07:40:05] Starting 'combine'...
[07:40:05] Finished 'combine' after 50 ms
[07:40:05] Starting 'copy'...
[07:40:05] Finished 'copy' after 154 ms
[07:40:05] Finished 'all' after 4.78 s
[07:40:05] Starting 'default'...
┌───────────────┬───────────────────────────────┬───────────────────────────────────────────────┬────────────────────┐
│ Task          │ Summary                       │ Source Files                                  │ Destination        │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.sass()    │ 1. Compiling Sass             │ resources/assets/sass/app.scss                │ public/css/app.css │
│               │ 2. Autoprefixing CSS          │                                               │                    │
│               │ 3. Concatenating Files        │                                               │                    │
│               │ 4. Writing Source Maps        │                                               │                    │
│               │ 5. Saving to Destination      │                                               │                    │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.webpack() │ 1. Transforming ES2015 to ES5 │ resources/assets/js/app.js                    │ public/js/app.js   │
│               │ 2. Writing Source Maps        │                                               │                    │
│               │ 3. Saving to Destination      │                                               │                    │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.combine() │ 1. Concatenating Files        │ public/js/app.js                              │ public/js/app.js   │
│               │ 2. Saving to Destination      │ node_modules/jquery/dist/jquery.min.js        │                    │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────┼────────────────────┤
│ mix.copy()    │ 1. Saving to Destination      │ node_modules/bootstrap-sass/assets/fonts/**/* │ public/fonts       │
└───────────────┴───────────────────────────────┴───────────────────────────────────────────────┴────────────────────┘


*SI !!! NON FUNZIONA !!!!*


==================================================================================================================================================================================================================================================================================================================================================================

*To install jQuery, do:*

npm install jquery --save

And then, in your bootstrap.js:

var $ = require("jquery");

==================================================================================================================================================================================================================================================================================================================================================================
