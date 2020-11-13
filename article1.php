<?php
    require_once("connection.php");
    $sql = "select count(*) as count from donor";
    $result = mysqli_query($conn,$sql);
    $row = $result -> fetch_assoc();

    echo $row["count"];
?>
