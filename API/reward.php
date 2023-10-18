<?php
session_start();
include('../connector/db.php');


if (isset($_POST['goaddreward'])) {
    header("location:../CRUD/reward.php");
}


if (isset($_POST['addreward'])) {
    $juara1 = $_POST['juara_1'];
    $juara2 = $_POST['juara_2'];
    $juara3 = $_POST['juara_3'];

    $sql = "UPDATE reward SET juara1='$juara1',juara2='$juara2',juara3='$juara3' WHERE idreward=1";
    $reset = "DELETE FROM exp";
    if ($conn->query($reset) === TRUE) {
    }
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "update Record successfully";
        header("location: ../admin/reward.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/reward.php");
        unset($_SESSION['edit']);
    }
}

if (isset($_POST['tambahreward'])) {
    $juara1 = $_POST['juara_1'];
    $juara2 = $_POST['juara_2'];
    $juara3 = $_POST['juara_3'];

    $sql = "INSERT INTO reward (idreward, juara1,juara2,juara3) VALUE ('1','$juara1','$juara2','$juara3')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "update Record successfully";
        header("location: ../admin/reward.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/reward.php");
        unset($_SESSION['edit']);
    }
}
