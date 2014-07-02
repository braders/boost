Boost
=====

> Note: This was created by me (Bradley Taylor) for a college project, and is no longer activly maintained. I recomend using an established framework like Symfony or Laravel for new projects. 

Quick Start:
------------

* clone repo
* change site_root constant in index.php
* open your page in the browser!

Adding Pages:
------------

Any custom pages and resources are held in the site folder. Files needed for the framework itself are stored in the system folder. Pages utilize the MVC architecture and stored in site/pages/{name_of_page}. All pages are mapped to routes using the routing file: sites/routes.php. 

An example homepage, with demonstation controller, model and view is included in this repo. 

Using Models:
-------------

Models should hold the buisness logic for the application. This includes connecting to databases and external resources. When loading the view an array of data can be passed, which will be made avaliable as a global variables. 

The database can be accessed using a built in database class. Database credentials should be accessed in system/core/database.php. The database class can then be accessed in a chainable manner like so:
```
$this->db->query("SELECT * FROM products")->resultset();
```
