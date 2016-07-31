# LastFmTest

# Synopsis
This project is to list the top artists by country and their top tracks feeded by Last.fm provided api. 

#Motivation
Interest in different countries music, makes us to be curious about who are among the top artists of  a country and what are their top tracks. This application is a response to this problem.

#Requierments
Apache webserver 2.2 or above. 
Apache webserver's mode rewrite must be enabled.
Php 5.3 or above.
php cUrl must be installed.

#Installation
Simply clone this project to somewhere in your webserver's root or any of it's sub directories, then navigate to Configs/Configs.php and change /var/www/currentweb/BasicForBigCommerce/ in line 12 to the path where you have extracted your cloned project.Then change http://localhost/currentweb/BasicForBigCommerce/ in line 14 to the address that points the path above. Then you can see the list of the top artists by adding Lastfm/GeoArts/Navlist at the end of the address you have changed in line 14.(In both cases dont forget to add / at the end) Here is an example of what you should run in browser's address bar: lets say you have changed line 14 to http://example.com/LastFmTest/ , to see the list of the top artists you should run this address in your browser: http://example.com/LastFmTest/Lastfm/GeoArts/Navlist

#Tests
Simply navigate to where you have extracted the cloned project and then run phpunit in terminal. Using phpunit.xml in the root of the project, the phpunit will automatically run all the available tests in Tests directory or even the future tests you may add to this directory. If you want to add your own tests, add them to Tests directory of the root of the project. 

#License
None