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
function add_task($title, $date, $time, $project_id, $taskID)
{
    try
    {
        global $connection;

        if($taskID)
        {
            $sql = 'UPDATE tasks SET title = ?, date_task = ?, time_task = ?, project_id = ? where id = ?' ;
        }
        else
        {
            $sql = 'INSERT INTO tasks(title, date_task, time_task, project_id) VALUES(?, ?, ?, ?)';
        }
        $statement = $connection->prepare($sql);
        $new_task = array($title, $date, $time, $project_id);

        if($taskID)
        {
            $new_task = array($title, $date, $time, $project_id, $taskID);
        }
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
    try
    {
        global $connection;

        $sql = 'SELECT * FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task-bindValue(1, $taskID, PDO::PARAM_INT);
        $task->execute();

        return $task->fetch();
    }
    catch(PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

// --- DELETE STUFF ---
function delete_task($taskID)
{
    try
    {
        global $connection;

        $sql = 'DELETE FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();
        
        return true;
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function delete_project($projectID)
{
    try
    {
        global $connection;

        $sql = 'DELETE FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();
        
        return true;
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

// --- Output from database ---

function csv_projects(/*$projects1, $delimiter=";"*/) {
    
    try
    {
        global $connection;
        $delimiter=";";
    
        $f = fopen('file3.csv', 'w');
        $array = ['ID', 'Title', 'Related to'];
    
        fputcsv($f, $array , $delimiter);  
        $sql = "SELECT * FROM projects";    
        $query = $connection->query($sql); 
        while($row = $query->fetch(PDO::FETCH_ASSOC))  
        {  
            fputcsv($f, $row, $delimiter);  
        }  

        fclose($f);

        return true;
    }

    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
    
} 

function sqlToJSON() {
    try
    {
        global $connection;
        $sql = "SELECT * FROM projects";
        $query = $connection->query($sql);
        $emparray = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $emparray[] = $row;
        }
        echo json_encode($emparray);

        return true;
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

// --- SEARCH STUFF ---

function searchT($title)
{
    try
    {
        global $connection;
        $sql = "SELECT * FROM projects WHERE title LIKE '%" . $title . "%' ORDER BY title";
        $results = $connection->query($sql);

        return $results;
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function searchC($category)
{
    try
    {
        global $connection;
        $sql = "SELECT * FROM projects WHERE category LIKE '%" . $category . "%' ORDER BY title";
        $results = $connection->query($sql);



        return $results;
    }
    catch (PDOException $exception)
    {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

?>