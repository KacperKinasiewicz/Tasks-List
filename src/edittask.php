<?php

include_once "utils\db.php";
$details = getdetails($_GET['id']);

?>

<!DOCTYPE html>
<html lang="pl">

<?php

include_once "utils\db.php";
$details = getdetails($_GET['id']);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style3.css">
</head>

<body>

<div class="container">
    <header> <img src="resources/Group1.png"> </header>
    <div class="editContainer">
        <div class="picturedetail">
            <?php
            if (!is_null($details['picture'])):
                $path = "images/".$details['picture'];
                echo "<img src='".$path."'>";
            endif;
            ?>
        </div>

<div class="upline"></div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="editHeader">Nazwa: <br><textarea name="name"><?=$details['name'];?></textarea></div>

            <div class="editDescription">Opis: <br><textarea name="description"><?=$details['description'];?></textarea></div>

            <div class="editPicture">Obraz: <br><input type="file" name="picture"><br><br></div>
            <div class="error">
                <?php if (!empty($_POST['edit'])):
                        if (!empty($_POST['name'])):
                            $taskname = $_POST['name'];
                            $taskdesc = $_POST['description'];
                            $id=$details['id'];
                            $filename = EditPicture($_FILES, $id);

                            if ($filename == "error"):
                                echo "Dodaj plik z jednym z rozszerzeń: 'jpg', 'png', 'jpeg'. <br><br>";

                            else:
                                edittask ($taskname, $taskdesc, $filename, $id);
                                $details = getdetails($_GET['id']);
                                header("Location: details.php?id=".$id);
                            endif;

                        else:
                            echo "Podaj nazwę zadania. <br><br>";
                        endif;
                    endif;
                ?>
            </div>

            <div class="editTask"> <input type="submit" name="edit" value="Edytuj zadanie"></div>
            <a class="editBack" href="details.php?id=<?=$details['id'];?>">Powrót</a></div>
        </form>
    </div>
</div>



</body>
</html>