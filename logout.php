<?php
//identificar si esta iniciada la sesion
session_start();
session_unset();
session_unset();

header("Location: index.php");