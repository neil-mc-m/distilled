Distilled SCH technical test
============================
installation
------------
* clone or download the repository
* navigate to the distilled directory
* run **composer install** from the command line

environment
-----------
* replace the api key in the .env.example file with a real key and rename it to .env

serve
-----
* serve the website with **php -S localhost:8000** from within the public directory

commands
--------
From the distilled directory,
* **composer fix** to fix the code style to PSR2
* **composer test** to run the tests (note-this was developed on a windows machine, so you may
have to adjust the path in composer.json under the scripts key)
* **composer fixtests** to fix the tests code style to PSR2

libraries/frameworks used
-------------------------
* silex
* twig
* guzzle
* dotenv
* jquery
* phpunit
