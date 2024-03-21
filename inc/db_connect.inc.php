<?php
// db_connect.inc.php
// Create a new connection to the MySQL server without selecting a database
$db = new mysqli('localhost', 'root', '', 'petrescue');

// If there was an error selecting the database
if ($db->connect_error) {
  die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
}

// Set the character encoding of the database connection to UTF-8
$db->set_charset('utf8');
