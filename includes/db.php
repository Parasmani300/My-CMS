<?php
    $connection  = mysqli_connect('localhost','root','','cms');

    if( !$connection){
        echo "Database not connected";
    }
?>