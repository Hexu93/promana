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






function get_all_tasks()
{
    try
    {
        global $connection;

        $sql = 'SELECT *, DATE_FORMAT(date_task,"%d/%m/%Y") AS ttime, projects.title 
        FROM tasks inner join projects on tasks.project_id = projects.id
        ORDER BY date_task asc ';
        $tasks = $connection->query($sql);

        return $tasks;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_all_tasks_count()
{
    try
    {
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

?>