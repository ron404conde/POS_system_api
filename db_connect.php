<?php

    $conn = mysqli_connect("localhost", "root", "", "pos_system");

    if (!$conn)
    {
        die("Connection error: " .mysqli_connect_errno);
    }

?>