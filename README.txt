Project Name: UCSD Alumni Heatmap
Author: Eswar Dhinakaran
Written In: PHP, Javascript, MySQL
Purpose: Display a heatmap of UC San Diego Alumni distribution around the world. It 		employs Google Maps API to display alumni location based on a provided SQL 	database with columns with the alumni latitude, longitude, major and class

Current Status: The project has been uploaded to this website: 		http://alumniheatmapucsd.net63.net/

		It is a free website hosting service so that the website can be 			reviewed before the real database is plugged in (this is for 		security reasons). 

File Descriptions: 

	Core Files: 

		index.php: the file that is opened when website is opened. it opens 			a heatmap of all alumni from all classes.
		
		Major.php: the file that is opened to quickly load a new heatmap if
		the user submits a form request on the menu bar to specify viewing
		a specific major or class of UCSD Students.

		connectDB.php: this file connects to the database. It needs to be 
		securely uploaded. It is accessed by all files that touch the 
		database (addCountry.php, analytics.php, analyzeResults.php, 				index.php, Major.php, randentries.php, testind.php)
	
	Other Important Files;
			
		addCountry.php: this file adds a column to the table so that the 
		latitudes and longitudes can be ISO converted to a country code
		so we can get a table of which countries contain the most UCSD 
		alumni. *

		analytics.php: this file calls analyzeResults.php to do the data
		crunching. It simply uses Javascript to load the data onto a div*

		analyzeResults.php: this file converts latitudes and longitudes into
		ISO Country Codes. Another thing I have been trying to implement is 
		to employ the Haversine Algorithm of finding the distance between
		any two points on the surface of a sphere to find the average
		distance between UCSD Alumni. It can be used by users to find 
		the average distance UCSD Alumni are to them. *
	
		randentries.php: This file is important to enter random latitudes
		and longitudes into the database. There is a simple weighting
		mechanism so that some form of uneven distribution can be seen
		in the locations of these hypothetical alumni


* These files/algorithms are not necessary to run the actual heatmap and are just
for laughs and giggles.		 


		