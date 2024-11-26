<?php

include_once "utils\db.php";

if (!empty($_POST['add'])):
    if (!empty($_POST['listname'])):
        $listname = $_POST['listname'];
        addList($listname);
        header("Location: index.php");
    else:
        echo "Add name of a list <br><br>";
    endif;
endif;

?>

<?php

include_once "utils\db.php";
$lists = getList();

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header> <img src="resources/Group1.png"> </header>

<div class="alllists">

    <?php foreach($lists as $list):
        $id_l = $list['id_l'];
        $tasks = getAll($id_l); ?>
        <div class="onelist" data-id="<?=$list['id_l'];?>">

            <div class="listname">
                <div class="line"></div>
                <div class="listnamecontent">
                    <div class="listnametext"><?=$list['name'];?><div class="tasksamount"><?php $amount=0; foreach($tasks as $task): $amount=$amount+1; endforeach; echo $amount;?></div></div>
                    <a class="deletelistbutton" href="deletelist.php?id_l=<?=$id_l; ?>">Usuń listę <img src="resources/trashIcon.png"></a>
                </div>
            </div>

            <div class="sortable connectedSortable">
                <?php foreach($tasks as $task):?>
                        <div class="onetask" data-id="<?=$task['id'];?>">
                            <div class="ui-state-default"> <?=$task['name'];?></div>
                            <a class="deletebuttons" href="deletetask.php?id=<?=$task['id'];?>&position=<?=$task['position'];?>">Usuń</a>
                            <a class="detailsbuttons" href="details.php?id=<?=$task['id']; ?>">Szczegóły</a>
                        </div>
                <?php endforeach ?>
            </div>

            <a class="addtaskbutton" href="addtask1.php?id_l=<?=$id_l; ?>">Dodaj zadanie <img src="resources/addIcon.png"></a>
        </div>

    <?php endforeach ?>

</div>

<form action="" method="POST" class="addlistform">
    <div class="">Nazwa listy: <br><input type="text" name="listname"></div>
    <input type="submit" name="add" value="Dodaj listę" class="addnewlistbutton">
    <a class="cancelbutton" href="index.php">Anuluj</a>
</form>

<footer>
    <div class="buttons">
    
        <form action="reorder.php" method="POST">
            <input type="hidden" name="tasks_order">
            <input type="submit" name="reorder" value="Zapisz kolejność" class="reordertasksbutton">
        </form>
    </div>

</footer>


    <script>
        $(document).ready(function ()
        {
            $(".sortable").sortable(
            {
                connectWith: ".connectedSortable",
                placeholder: "ui-state-highlight",
                stop: function ()
                {
                    var lists = $('.onelist'),
                        listsData = [],
                        tasksOrderInput = $('[name=tasks_order]');

                    lists.each(function() {
                        var idList = $(this).data('id'),
                            tasksInList = $(this).find('.onetask'),
                            tasksIds = [];

                        tasksInList.each(function() {
                            tasksIds.push($(this).data('id'))
                        });

                        if(tasksIds.length > 0)
                            listsData.push(idList + ':' + tasksIds.join(';'));
                    });

                    tasksOrderInput.val(listsData.join('|'));
                }
            })
        });
    </script>
</body>
</html>