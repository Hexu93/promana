<?php

require "connection.php";

$connection = db_connect();

function get_all_projects()
{
    try
    {
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY title';
        $projects = $connection->query($sql);

        return $projects;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_all_projects_count()
{
    try
    {
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}