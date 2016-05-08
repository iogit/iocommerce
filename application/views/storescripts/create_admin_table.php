 <?php 
// connect to your MySQL database here
require_once "connect_to_mysql.php";

echo "success";
// Create an sql command structure for creating a table
$tableCreate = "CREATE TABLE members (
                id int(11) NOT NULL auto_increment,
                username varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                website varchar(255) NULL,
                account_type enum('a','b','c') NOT NULL default 'a',
                PRIMARY KEY (id),
                UNIQUE KEY email (email)
                )";

// This line uses the mysql_query() function to create the table now
$queryResult = mysql_query($tableCreate);
// Create a conditional to see if the query executed successfully or not
if ($queryResult === TRUE) {
        print "<br /><br />Success in TABLE creation! Happy Coding!";
} else {
        print "<br /><br />No TABLE created. Check";
}
// close mysql connection
mysql_close();
?>