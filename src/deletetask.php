<?php
include "utils\db.php";

deleteTask($_GET['id']);
changePositions($_GET['position']);
header("Location: index.php");


