# Kitchen Management Tool
Dissertation project: 
Kitchen Management Tool

E-training – Web application to help with the initial stages of training a chef 

To view the website application please visit https://icanprep.com/ 
Requirements: Up to date Chrome browser and screen size of 10" or more.

Alternatively use these instructions:

1. Download source code from Github

2. Download Xammp at https://www.apachefriends.org/index.html to set up a server 

3. Go to Xammp control pannel and click start my SQL and start Apache and Create database using the shell

3.5. To create the database type in cd c:\xampp\mysql\bin , make sure this is the right path in the right drive

3.6. Then type mysql.exe -u root --password

3.7. Next type the password, the password in most cases is either: password or nothing


4. Create a database, type: create database kmt;

4.1. Point the shell to the database, type: use kmt;

4.2. Create tables in the database, Copy and Paste db.sql 

4.2.1. Check that it exists, type: show tables; and type: select * from tableName

4.2.2. Find the database on http://localhost/phpmyadmin/ in browser

5. Find xammp/htdocs file. Copy and paste App file from Github into this folder

6. Go to Chrome browser and type http://localhost/App/index.html to get to homepage
