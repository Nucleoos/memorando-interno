<?php

include("../view/vPlease-wait.html");

session_start(usuarios);
session_destroy();

header("Location:../view/index.php");

?>
