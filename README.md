# folat-beta-wp
Development of Folat application for beta testing

# Installation and Usage
## Wordpress Workflow
The development environment for this app will use [wordpress-workflow](https://github.com/vinco/wordpress-workflow). 
*Make sure to install all dependancies for this.*
Once you have all the dependancies for wordpress-workflow, 
clone the wordpress-workflow repository into the root of the project. 
(make sure to delete the empty wordpress-workflow directory first if necessary)
```
rm -rf wordpress-workflow
git clone git@github.com:vinco/wordpress-workflow.git
```

Then run the following command **from the root of the project** to start the VM
```
vagrant up
```
This will start the nginx server up on the local vm. It can take a while the first time.
next you need to install wordpress on the local VM using the following command (from the root of the project directory)
```
fab environment:vagrant bootstrap
```
This will install the appropriate version of wordpress and activate the folat theme and any plugins required (found in settings.json)

Next we will import the database from /src/database/data.sql using the following command
```
fab environment:vagrant resetdb import_data
```
We should also import the /uploads directory into the VM so you can view all of the images for the site correctly.
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
The css for the project is handled using [Compass](http://compass-style.org/install/) 
To edit global, component, or page css you must run the following command from the root theme director (/src/themes/folat/)
**never edit the style.css of the wordpress theme directly as your changes may be overwritten by compass**
```
compass watch
```
Any changes to scss will automatically be processed and generated in the themes style.css file

If you run into any trouble feel free to contact me at desarrollowebuno@gmail.com

