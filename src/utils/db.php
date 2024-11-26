<?php

function startConnection(): ?PDO
{
    try
    {
        $db_conn= new PDO("mysql:host=localhost;dbname=trello_trial", "root", "");
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        return null;
    }
    return $db_conn;
}

function getAll($id_l): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare('SELECT * FROM `tasks` WHERE id_l = :id_l ORDER BY `tasks`.`position` ASC' );
        $stmt->bindParam('id_l', $id_l);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    endif;
}

function create($name, $description, $picture, $position, $id_l)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("INSERT INTO tasks (name, picture, description, position, id_l) VALUES(:name, :picture, :description, :position, :id_l)");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('position', $position);
        $stmt->bindParam('id_l', $id_l);
        $stmt->execute();
    endif;
}

function reorderTasks($order, $id_l)
{
    $position = 1;
    foreach ($order as $id):
        $db_conn = startConnection();
        if(!is_null($db_conn)):
            $stmt = $db_conn->prepare("UPDATE tasks SET position = :position, id_l = :id_l WHERE tasks.id = :id");
            $stmt->bindParam('position', $position);
            $stmt->bindParam('id', $id);
            $stmt->bindParam('id_l', $id_l);
            $stmt->execute();
            $position++;
        endif;
    endforeach;
}

function getposition($id_l): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT MAX(position) FROM `tasks` WHERE id_l = :id_l");
        $stmt->bindParam('id_l', $id_l);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function setposition($id_l)
{
    $positions = getposition($id_l);
        if ($positions['MAX(position)'] === NULL):
            $position = 1;
            return $position;
        else:
            $position = $positions['MAX(position)'] + 1;
            return $position;
        endif; 
}

function getdetails($id): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT * FROM tasks WHERE  id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function changePositions($position)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("UPDATE `tasks` SET `position` = `position` - 1 WHERE `position` > :position ");
        $stmt->bindParam('position', $position);
        $stmt->execute();
    endif;
}

function deleteTask($id): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        deleteTaskPicture($id);

        $stmt = $db_conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();

        return true;
    endif;
}

function deleteTaskPicture($taskId)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT picture FROM `tasks` WHERE id = :id");
        $stmt->bindParam('id', $taskId);
        $stmt->execute();
        $picture = $stmt->fetch(PDO::FETCH_ASSOC);
        unlink("images/".$picture['picture']);
    endif;
}

function edittask($name, $description, $filename, $id)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $picture = $filename;
        $stmt = $db_conn->prepare("UPDATE tasks SET name = :name, picture = :picture, description = :description WHERE tasks.id = :id");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    endif;
}

function addNewPicture($filearray)
{
    if(!empty($_FILES["picture"]["name"])):
        $filename = $_FILES['picture']['name'];
        $tempname = $_FILES['picture']['tmp_name'];
        $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $filename = sha1(rand(1000, 999999999999999) . "-" . date('d-m-y h:i:s') . "-" . $_FILES['picture']['name']) . "." . $fileType;
        $folder = "images/" . $filename;
        $allowTypes = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allowTypes)):
            move_uploaded_file($tempname, $folder);
            return $filename;

        else:
            $error = "error";
            return $error;
        endif;
    else:
        $filename = null;
        return $filename;
    endif;
}

function EditPicture($filearray, $id)
{
    if(!empty($_FILES["picture"]["name"])):
        $filename = $_FILES['picture']['name'];
        $tempname = $_FILES['picture']['tmp_name'];
        $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $filename = sha1(rand(1000, 999999999999999) . "-" . date('d-m-y h:i:s') . "-" . $_FILES['picture']['name']) . "." . $fileType;
        $folder = "images/" . $filename;
        $allowTypes = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allowTypes)):
            $details = getdetails($id);
            unlink("images/".$details['picture']);
            move_uploaded_file($tempname, $folder);
            return $filename;

        else:
            $error = "error";
            return $error;
        endif;
    else:
        $details = getdetails($id);
        $filename = $details['picture'];
        return $filename;
    endif;
}

function getList(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare('SELECT * FROM `lists`');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    endif;
}

function addList($name)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("INSERT INTO lists (name) VALUES(:name)");
        $stmt->bindParam('name', $name);
        $stmt->execute();
    endif;
}

function deleteList($id_l)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("DELETE FROM lists WHERE id_l = :id_l; DELETE FROM tasks WHERE id_l = :id_l");
        $stmt->bindParam('id_l', $id_l);
        $stmt->execute();
    endif;
} 
