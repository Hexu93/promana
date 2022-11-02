<?php
/*
WARNING: This installer will overwrite the database!
*/

require "../model/config.php";

try
{
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);

    $sql_structure = file_get_contents("structure.sql");
    $sql_content = file_get_contents("content.sql");

    $connection->exec($sql_structure);
    $connection->exec($sql_content);

    echo "<p>Database created and populates successfully. <br><a ref='../'>Home</a></p>";
}
catch (PDOException $error)
{
    echo "<br> ERROR:" . $error->getMessage();
}

?>