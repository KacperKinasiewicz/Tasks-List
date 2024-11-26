<?php

include "utils\db.php";

deleteList($_GET['id_l']);
header("Location: index.php");
