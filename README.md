Distilled SCH technical test
============================
installation
------------
* clone the repository
* composer install

environment
-----------
* replace the api key in the .env.example file with a real key

serve
-----
* serve the website with  **composer serve**
 
 commands
 --------
 From the home directory, 
 * **composer fix** to fix the code style to PSR2
 * **composer test** to run the tests (note-this was developed on a windows machine, so you may 
 have to adjust the path in composer.json under the scripts key)
 * **composer fixtests** to fix the tests code style to PSR2
 * **composer serve** to serve the website
