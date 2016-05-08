 <?php 
// connect to your MySQL database here
require_once "connect_to_mysql.php";


// Create an sql command structure for creating a table
$tableCreate = "CREATE TABLE products (
                id int(11) NOT NULL auto_increment,
                product_name varchar(255) NOT NULL,
                price varchar(16) NOT NULL,
                details text NOT NULL,
                category varchar(16) NOT NULL,
				subcategory varchar(16) NOT NULL,
				date_added date NOT NULL,
				PRIMARY KEY (id),
				UNIQUE KEY product_name(product_name)
                )";

// This line uses the mysql_query() function to create the table now
$queryResult = mysql_query($tableCreate);
// Create a conditional to see if the query executed successfully or not
if ($queryResult === TRUE) {
        print "<br /><br /> Products table has been  created succesfully.";
} else {
        print "<br /><br />Error : Products table hasn't been created.";
}
// close mysql connection

?>