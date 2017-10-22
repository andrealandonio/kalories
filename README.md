# Kalories

User can see a list of his meals and calories.
Calories are entered manually and each entry could be edited and deleted.

An entry has the following fields:
* date
* time
* text
* number of calories

User can filter date (from-to).
For example: how much calories have I had in the last week?
User can set the expected number of calories per day in a settings' panel.
When displayed, the total for that day is colored in green, otherwise it is red.

# Note

* A basic layout is provided
* No jQuery calendar plugins are used

# How to install

In this repo you can find a WordPress installation with a plugin and a theme with the name "kalories". They contain a basic set of templates for the website homepage and the required functionalities.
To run the website you have to simply setup a web server, create a database, activate the plugin and apply the theme. No more operations are required.
The website has been developed and tested with PhpStorm on an environment composed by nginx, varnish and mysql.

# How to test

On plugin activation 3 users are automatically created with the following credentials:

* user1 / user1
* user2 / user2
* user3 / user3

You can user one of the 3 accounts to test the website functionalities. 
The homepage is composed by a form to add/modify a meal (date and times are managed as strings with a specific format), a form to set the user preferences (daily calories threshold) and the list of the user's meal in the main area. In the sidebar there is a widget to manage login/logout and a widget to manage search filters.
