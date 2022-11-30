<?php

require "connection.php";

$connection = db_connect();

function titleExists($table, $title)
{
    try
    {
        global $connection;

        $sql = 'SELECT title FROM ' . $table . ' WHERE title = ?' ;
        $statement = $connection->prepare($sql);
        $statement->execute(array($title));

        if($statement->rowCount() > 0)
        {
            return true;
        }
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

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

        $sql = 'SELECT *, DATE_FORMAT(date_task,"%d/%m/%Y") AS ttime, projects.title AS project
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


// -- ADD PROJECT ---

function add_project($title, $category, $id)
{
    try
    {
        global $connection;

        if($id)
        {
            $sql = 'UPDATE projects SET title = ?, category = ? WHERE id = ?';
        }
        else
        {
            $sql = 'INSERT INTO projects(title, category) VALUES(?, ?)';
        }
        $statement = $connection->prepare($sql);
        $new_project = array($title, $category);

        if($id)
        {
            $new_project = array($title, $category, $id);
        }

        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}


// --- ADD TASKS ---
function add_task($title, $date, $time, $project_id)
{
    try
    {
        global $connection;
        $sql = 'INSERT INTO tasks(title, date_task, time_task, project_id) VALUES(?, ?, ?, ?)';

        $statement = $connection->prepare($sql);
        $new_task = array($title, $date, $time, $project_id);

        $affectedLines = $statement->execute($new_task);

        return $affectedLines;
    }
    catch (PDOException $err)
    {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

// --- GET STUFF FROM DB ---
function get_project($id)
{
    try
    {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    }
    catch(PDOException $execption)
    {
        echo $sql . "<br>" . $execption->getMessage();
        exit;
    }
}

function get_task($taskID)
{
    
}
?>