Team Dudes
John Donich, Chris Petrovic, Dan Robson

Site hosted at auxiliotech.com

The general contents of the root folder

1. application folder
	- contains most of the relevant files for the project

2. Folders with associated files for the site
	- assets: contains the text for the bio pages 
	- styles: contains all the css for the site
	- is: contains the all the javascript files for the site
	- images: all the images for the site


===========================================================

Files In The Application Folder of import

	1. the config folder
		- routes.php - defines the functional path from url to the backend scripts
			- e.g. $route['(:any)/(:any)'] = 'depot/gallery/$1/$2';
			- when the url is base_url/artist_name/portfolio will call the 
				function gallery() in the depot.php controller
		
		- there are other files like database and config that define some of the parameters for the site
		 
	2. Controllers
		- depot.php - this is the primary backend file. Each function represents a page 
	
	3. Models
		- depot_model.php - contains all of the data selct and insert functions

	4.Views
		- contains all of the markup files these files are called in the controller by 
			load->view(file.php, $data). $data contains all the variables passed into the markup files