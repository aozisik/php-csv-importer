CSV IMPORT
================

It's a php + ajax script that can import large csv files to a mysql table.


How Does it Work?
================


The script lists CSV files in the CSV folder (this can be changed from php/config.php). 
Once you enter necessary data about the CSV files such as the database connection arguments
it will read the CSV file line by line and create .dat files to store serialized data temporarily.

Then the script will automatically parse these CSV temporary .dat files into SQL commands.

NOTE: The first line of the CSV file should be a header because this first line will name the columns
of the resulting MYSQL table.

Finally, the SQL commands are executed.

If the process fails at any step, you can always investigate the workflow in either tmp or sql folder or
if it is a MySQL error, you can see the problem logged in ./error.txt
