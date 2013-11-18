<?php

include("vPlease-wait.html");

session_start(usuarios);
session_destroy();

header("Location:index.php");

?>
