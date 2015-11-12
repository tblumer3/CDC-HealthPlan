<?php
$_link = mysqli_connect($_db_server, $_db_user, $_db_pass, $_db_name);
if (!$_link) die("Error: database connection failed (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
