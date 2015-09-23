# folat-beta-wp
Development of Folat application for beta testing

# Installation and Usage
## Wordpress Workflow
The development environment for this app will use [wordpress-workflow](https://github.com/vinco/wordpress-workflow). 
*Make sure to install all dependancies for this.*

To start the project run the following command **from the root of the project**
```
wordpress-workflow/startProject.sh
```
This will create the necessary file structure for the vagrant VM to run properly
if you then go to http://wordpress.local you should see the nginx default 403 forbidden error. That's good, it simply means that you have an empty public directory in your nginx server, next you need to install wordpress on the loca VM using the following command (again from the root of the project directory)
```
fab environment:vagrant bootstrap
```
This will install the appropriate version of wordpress and activate the folat theme and any plugins required (found in settings.json)

Next we will import the database from /src/database/data.sql using the following command
```
fab environment:vagrant resetdb import_data
```
If you like you can also import the /uploads directory into the VM so you can view all of the images for the site correctly.
First log in to the local VM and fix permissions on the uploads directory by running the following commands from the root of the project
```
vagrant ssh
chmod -R 777 public_www/wp-content/uploads
```
Now copy the synced uploads directory from the wordpress-workflow directory in your vm
```
cp -R wordpress-workflow/init/uploads/ public_www/wp-content/

```
Now you have the full app in your development environment and can start working! 

## Compass and Sass
The css for the project is handled using Compass 
To edit global, component, or page css you must run the following command from the root theme director (/src/themes/folat/)
```
compass watch
```
Any changes to scss will automatically be processed and generated in the themes style.css file
