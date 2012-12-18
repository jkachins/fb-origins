Facebook/Heroku sample app -- PHP
=================================

This is a sample app showing use of the Facebook Graph API, written in PHP, designed for deployment to [Heroku](http://www.heroku.com/).

Run locally
-----------

Configure Apache with a `VirtualHost` that points to the location of this code checkout on your system.

[Create an app on Facebook](https://developers.facebook.com/apps) and set the Website URL to your local VirtualHost.

Copy the App ID and Secret from the Facebook app settings page into your `VirtualHost` config, something like:

    <VirtualHost *:80>
        DocumentRoot /Users/adam/Sites/myapp
        ServerName myapp.localhost
        SetEnv FACEBOOK_APP_ID 12345
        SetEnv FACEBOOK_SECRET abcde
        SetEnv CLEARDB_DATABASE_URL mysql://username:password@testingurl/database
        SetEnv MEMCACHIER_PASSWORD memcachePassword
	SetEnv MEMCACHIER_SERVERS dev1.ec2.memcachier.com:11211
	SetEnv MEMCACHIER_USERNAME memcacheUser
	
    </VirtualHost>

Restart Apache, and you should be able to visit your app at its local URL.

STYLE
Using something of an MVC pattern.  Controllers stored in the controller folder.
Models are stored in the Object folder.  Views are stored in the origins folder.
Controllers are actually just adapters (should be renamed), and get information
from requests and convert it into internal objects to send to the service layer.
These services actually modify the data and do the heavy processing, and live in
the BO folder.  The data is actually modified in the Datbase through the DAO
classes.  Right now, the BO layer may be a bit inflated, and more logic should
rightfully be in the model objects.
**I haven't moved this yet since I don't want any DAO logic living in my models**

Each view should start off by creating an appropriate controller and calling a
single method from it.  This should return an associative array that contains
all the information that needs to be used in the view.  Any page that requires a
login should use the "checkLogin" fragment.

FOLDERS
-BO: Service Layer, performs computation and provides access to the DAO.
-DAO: Data Access layer, communicates with the Database.
-Cache: Just Memcache and Memcache warpper stuff.
-Controller: Handles getting information from a request type, and sending information back.
-facebook: I honestly don't know.
-fragments: used for fragments of view code that can be included across multiple views.
-origins: The HTTP web views.
-SDK: Facebook PHP SDK.  Best not to touch.
-Stylesheets: Cascade Style Sheets
-javascript: javascript


TODO
-I don't like Cache living alone at the top.
-Unit Tests should exist for almost every public method.
-Organize Folder structure with more nested folders in Controllers and Views.
-Organize loose files
-Finish off requests to invite players to game.
-Post to groups or send individual messages based on game or character.

LONG VISION
-Add a private/public option for games to display to public or friends or just invited.
-Add inventory based off of Item framework that exists.
-Use some CSS
-Add javascript and AJAX to create more responsive/interactive interface
-Solidify Public/Internal API
-Go Mobile.
-Add images.
-Use the Open Graph API