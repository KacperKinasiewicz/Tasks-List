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
</head>

<body>

<div class="container">
    <header> <img src="resources/Group1.png"> </header>

    <div class="detailcontainer">
        <div class="picturedetail">
            <?php
            if (!is_null($details['picture'])):
                $path = "images/".$details['picture'];
                echo "<img src='".$path."'>";
            endif;
            ?>
        </div>

        <div class="upline"></div>


        <div class="taskHeader">
            <div class="taskName"> <?php echo $details['name']; ?> </div>
                <a class="closeIcon" href="index.php"><img src="resources/closeIcon.png"></a>
        </div>


        <div class="smallLine"></div>


        <div class="taskDescription"> <?php echo $details['description']; ?> </div>


        <div class="smallLine"></div>


        <div class="detailsFooter">


            <a class="deleteBtn" href="deletetask.php?id=<?=$details['id'];?>&position=<?=$details['position'];?>">Usuń zadanie</a>

            <a class="editBtn" href="edittask.php?id=<?=$details['id'];?>">Edytuj zadanie</a>





        </div>


    </div>


</div>



</body>
</html>

