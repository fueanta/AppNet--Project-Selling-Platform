<?php

/* defining constants */
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'appnet');
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');

// function that sends the database connection
function get_db_connection()
{
    /* A resource link to our database */
    $connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    OR die('Failed to establish a connection with MySQL: ' . mysqli_connect_error());

    return $connection;
}