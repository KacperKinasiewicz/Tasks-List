<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial - Add Task</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
<header> <img src="resources/Group1.png"> </header>
    <form action="" method="POST" enctype="multipart/form-data" class="addtaskform">
        <div class="line"></div>
        <div class="nametextarea">Nazwa: <br><textarea name="name"></textarea></div>
        <div>Zdjęcie: <br><input type="file" name="picture"></div>
        <div class="descriptiontextarea">Opis: <br><textarea name="description"></textarea></div>
        <div class="error"><?php

            include_once "utils\db.php";

            if (!empty($_POST['add'])):
                if (!empty($_POST['name'])):
                    $id_l = $_GET['id_l'];
                    $taskname = $_POST['name'];
                    $taskdesc = $_POST['description'];
                    $position = setposition($id_l);
                    $filename = addNewPicture($_FILES);

                    if ($filename == "error"):
                        echo "Dodaj plik z jednym z rozszerzeń: 'jpg', 'png', 'jpeg'. <br><br>";

                    else:
                        create($taskname, $taskdesc, $filename, $position, $id_l);
                        header("Location: index.php");
                    endif;
                else:
                    echo "Podaj nazwę zadania. <br><br>";
                endif;
            endif;

            ?></div>
        <input type="submit" name="add" value="Dodaj zadanie">
        <a class="cancelbutton" href="index.php">Anuluj</a>
    </form>
</body>
</html>

