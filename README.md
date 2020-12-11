# CourseMap README
## Team
Jacob Dyer, Luke Elias, Joyce Fang, Jensen Li, Anya Tralshawala

## Overview
CourseMap is a course planner designed primarily for undergraduate college students. It aims to be an application that will help students make sure that they fill the requirements for graduation, along with allowing them to test multiple different schedules for their future. Additionally, it also aims to help advisors by allowing them to more easily work with students on a plan that encompasses their whole time at college, along with giving advisors a tool to help verify that a student has met all of the requirements for graduation.

## Built With
* PHP
* HTML/CSS
* JavaScript

## Scraping
* All of the methods used for scraping data are available in the .course_data folder, along with the final dataset that we used in the system (primary_course_final_semesters.json).
* catalog_main was unused since we found out that the data in the [RPI catalog](http://catalog.rpi.edu/) had manual edits and was unusable (since it’s hard to get data when the tags themselves inside of the data are misspelled).
* main.py has all of the code that we used for the dataset inside of CourseMap, although it should be noted that it won’t run out of the box as we figured out how to do parts of the application in separate chunks.

## Notes
* If your database username and password are not root root, go to db.php and edit it there
* The files in the “resources_linda” folder are word documents provided by Linda, the academic advisor for ITWS. It contains helpful information for concentration templates and course groups.
* The files in the “course_data” folder are excel spreadsheets not used in the actual site. We did this to organize concentration requirements and other requirements like ITWS core requirements. 

## Installation Instructions
1) Create a folder called coursemap in your localhost htdocs folder
2) Clone this repository into the coursemap folder created in Step 1
3) Go to phpMyAdmin and create a database called “website”
4) Click on the “website” database and import the “website.sql” file
5) Create a virtual host by going to the file httpd-vhosts.conf and inserting:
    
       <VirtualHost *:80>

          DocumentRoot "/opt/lampp/htdocs/coursemap/Primary-Source"

          ServerName coursemap

       \</VirtualHost>

Note: DocumentRoot may vary across machines.

6) Add another entry in the hosts file like so:
	127.0.0.1 coursemap
7) In your browser, go to [http://coursemap:8080](http://coursemap:8080) (MacOS) OR [http://coursemap/](http://coursemap/) (Windows)
