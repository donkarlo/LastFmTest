# LastFmTest

# Synopsis
This project is to list top artists by country and their top tracks feeded by Last.fm provided api. 

#Motivation
Interest in different countries music, makes us to be curious about who are 
among the top artists of  a country and what are their top tracks. 
This application is a response to this problem.

#Requierments
Apache webserver 2.2 or above. 
Apache webserver's mode rewrite must be enabled.
Php 5.3 or above.
php cUrl must be installed.

#Installation
Simply clone this project to somewhere in your webserver's root or any of it's sub directories,
 then navigate to Configs/Configs.php and change /var/www/currentweb/BasicForBigCommerce/ 
in line 12 to the path where you have extracted your cloned project.
Then change http://localhost/currentweb/BasicForBigCommerce/ in line 14 to the address
 that points the path above. Then you can see the list of the top artists by adding 
Lastfm/GeoArts/Navlist at the end of the address you have changed in line 14.
(In both cases dont forget to add / at the end) Here is an example of what 
you should run in browser's address bar: lets say you have changed line 14 
to http://example.com/LastFmTest/ , to see the list of the top artists you should 
run this address in your browser: http://example.com/LastFmTest/Lastfm/GeoArts/Navlist/ .

#Tests
Simply navigate to where you have extracted the cloned project and 
then run phpunit in terminal. Using phpunit.xml in the root of the project, 
the phpunit will automatically run all the available tests in Tests directory 
or even the future tests you may add to this directory. If you want to add your 
own tests, add them to Tests directory of the root of the project. 

#How thing work under the hood:
When in the browser's address bar you type http://example.com/LastFmTest/Lastfm/GeoArts/Navlist/spain/10
and hit enter, the application will search inside Modules/Lastfm/Controllers for
GeoArts file and runs Navlist with a given array argument like array(spain,10). 
All this happens in \Sol\Mvc\Controllers\SimpleRouter (you can follow the namespaces as directories). 
Actually whenever a request arrives the .htaccess file in the root of the project 
will map it to index.php where the \Configs\Configs and \Sol\Core\Autoload are included and a call to SimpleRouter 
will cause the above process to trigger.When navlist with given args is called it gathers the needed 
classes to generate the response which is a layout with the views set. The other action of the GeoArts
controller is functioning the same way and the rest of the documentation is available in the Controller
itself. <br/>

Note:some of the following code can be found in Modules\Lastfm\Services\GeoArtsNavigation
the rest is just left in front of eyes due to time limit and keep the tracking simple.
let's say you have ran GeoArts::Navlist, by calling LastFm\Modules\Callers\CallerFactory::getDefaultCaller ()
I get a LastFm\Modules\Callers\CurlCaller instance. Then I will set the Api key. (every one should receive 
one such key from last.fm website ) and right after I call LastFm\Modules\Geo::getTopArtists() with
arguments I have computed in the GeoArts::Navlist action. The rest is the matter of making the Navlist view 
and SimpleLayout (a layout for testing) ready to be rendered.<br/>

The same process takes place in GeoArts::ArtistTopTracks action. <br/>


#Limitations due to time
I have created just two tests one for Lastfm/Models/Geo and the other for Lastfm/Models/Artist to show that
I am familiar with unit testing. <br/>

I didn't have time to refactor the code in actions into services where I should combine views and models.
That's why actions in GeoArtist Controller are not as slim as possiable.<br/>

I thought Front controller pattern would be the best for this application, since it doesn't need
any chain of commands to get executed before a view is shown. Page controller was also fine but it seemed 
to me too primitive. Since I had to recreate a whole MVC frame work quickly, I didn't have time to comment
most of the code. I hope I have written the code enough self descriptive. I have just created something quick to
cover the task, it is not something to be used in production at all.
The whole application could be done a lot simpler with something like Laravel. I though since 
the assignment says "appropriate" it means additional unused services must not be contained in the framework. 
Thats why I wrote this very basic framework.
<br/>

I hoped I could refactor classes like Lastfm/Models/Artist into a mapper like Lastfm/Mappers/Artist 
which could hold the responsibility of creating an Artist class in Lastfm\Models as a domain model
object so I could decouple domain model objects creation(The responsibility of data  mappers) 
from the domain object itself. <br/>

I avoided a templating engine for the same reason, but I kept logic out of view as 
much as possible.<br/>

 After Writing this README.md file, I will move to create some nicer exception and error handling as 
the current one is not fair at all. I will try to cover the mentioned problems as well in the remaining time.
<br/>


I have just added several countries to the list.
Of course in a real application this would be formed from some external source like a database.
<br/>

In cases where redirection were needed, like bad security user inputs, I just killed the application. 
In real application they would be for sure redirected to some sort of warning page while his/her
IP is saved in an external source.<br/>

Artists lists limits per page and so many constants could 
be moved to a configuration file as an external source. 
<br/>

I could have used some other ways other than cURL to call the remote function like sockets. I just happened to chose this
one.<br/>

I hate static methods and I used so many of them to make a prototype ready in the given time.
<br/>

Since last.fm is blocked in my country of origin,  I mostly had to guess the procedures which
 was one other source of time consumption
so changing the code was seriously a pain since if the code broke I could hardly be notified.<br/>

The pagination module I used is the one I wrote 7 years ago. 
There are so many nice pagination systems out there. I thought using this old code in new 
context will better show how
this quick made framework works.<br/>

If I had time, I would also add a singletone application registry from where I 
retrieved the request parameters so I could mock the request object whenever a 
class needed it while testing.<br/>

 

#License
None