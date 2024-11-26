<?php

include_once "utils\db.php";
if (!empty($_POST['reorder'])):
    $lists = explode("|", $_POST['tasks_order']);
    foreach ($lists as $list): 
        $array = explode(":", $list);
        $id_l = $array[0];
        foreach ($array as $task) {
            $order = explode(";", $task);
            reorderTasks($order, $id_l);
        }
    endforeach;
endif;

header("Location: index.php");


