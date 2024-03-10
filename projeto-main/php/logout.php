<?php
session_start();
session_destroy();
header('Location: ../screens/index.html');
?>