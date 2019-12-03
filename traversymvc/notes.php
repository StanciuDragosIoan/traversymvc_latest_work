<?php

/*

    creating the core framework

    # video 13: creating the folder structure:
        created 2 directories 'app' and 'public'
        
        public will be the client interface + client assets (CSS/client side JS)

        app will be the application, the mvc structure, libraries, config, helper methods..


        inside public
            created an index.php 
            created a css folder with syle.css
            created a js folder with main.js file

        inside app
            created a libraries directory (the hearth of the app)

            inside libraries created:
                Core.php (this will look at the URL and return the view)

                Created a Database.php (will be a pdo class)
                    the model will use this file

                created a Controller.php (will be the core controller and will load models and
                views every controller we create will extend this class)

            created a 'models' directory, a 'views' and a 'controllers' one

            created a 'helpers' folder (e.g. we'll have a redirect helper, a session helper)

            created a 'config' directory (this will hold the DB params)

            created a bootstrap.php (will require all the files that we need: libraries,
            config, helpers, etc...)

            created a .htaccess file
                inside of it added:
                    Options -Indexes (this makes it so that we can't view the 'app' directory
                    anymore)

                    if we were to add Options +Indexes (it would let us view the app directory)

      
                    
    # video 14: direct everything through index.php
            
        in the 'public' folder we want to redirect everything through index.php

        in order to do that we'll use mod_rewrite in a .htaccess file

        created an .htaccess file inside the 'public' directory
            inside of it added:

                <IfModule mod_rewrite.c>
                    Options -Multiviews
                    RewriteEngine On
                    RewriteBase /traversymvc/public
                    RewriteCond %{REQUEST_FILENAME}% !-d
                    RewriteCond %{REQUEST_FILENAME}% !-f
                    RewriteRule ^(.+)$ index.php?url=$1 [QSA, L]
                </IfModule>

        code in .htaccess explained:

    <IfModule mod_rewrite.c>   //checks for the mod_rewrite module (checks if it's enabled)
        Options -Multiviews    // disables Multiviews (avoids confusion between /test and /test.php)
        RewriteEngine On       //turns on the rewrite engine
        RewriteBase /traversymvc/public     //rewrite base is the root URL
        RewriteCond %{REQUEST_FILENAME}% !-d   //checks if the requested file is not found in public, then continue to line 76 which routes everything through index.php 
        RewriteCond %{REQUEST_FILENAME}% !-f    //same as above
        RewriteRule ^(.+)$ index.php?url=$1 [QSA, L] //redirect through index.php if the file 
        requested does not exist, if it exists, load it ($1 = placeholder for url)
    </IfModule>

    the $1 var for the url will allow us to do /posts instead of ?url=posts
    !note that if a file requested exists, it will be loaded public/test.php (if we create the
    test.php file)

    required bootstrap.php in the index.php inside the public folder
    in index.php we'll also initialize the Core class




     # video 15: bootstrap file and core class

        will add 1 more .htaccess file to force a redirect in the public directory

        created a .htaccess in the root
            inside of it added:

            <IfModule mod_rewrite.c>
                RewriteEngine on   //checks if rewrite engine is on
                RewriteRule ^$ public/ [L] //checks if rewrite engine is enabled
                RewriteRule (.*) public/$1 [L]   //make sure root redirects to public
            </IfModule>


        there are multiple files to be included in the bootstrap file (not created yet) + the libraries 

        created Core class and started working on it
            added private properties (currentController, currentMethod and params [])
            created the getUrl() function (will feth the URL elements and put them in the params array)

        initialized Core class in index.php (in public) which calls the getUrl method;

        this fetches the URL param from URL 
            so if we do:
                http://localhost/traversymvc/index.php?url=test
            it fetches 'test'
            
            however the .htaccess inside of public directory (line 7) amkes it so that the URL param is fetched if we do only: 
                http://localhost/traversymvc/test too
                    this fetches 'test'

                
        
    # video 16: Loading controller from the URL
            continued to work on the getUrl() method from the Core class
                now it loads the controller corresponding to 1st param of URL
*/