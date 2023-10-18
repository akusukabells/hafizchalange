<?php

include("../connector/db.php");
session_start();
if (isset($_POST['goaddlevel'])) {
    $_SESSION['id'] = getID();
    header("location: ../CRUD/level.php");
}

if (isset($_POST['adddatalevel'])) {
    $id = $_POST['idlevel'];
    $nama = $_POST['namelevel'];
    $unlock = $_POST['unlockexp'];
    $idclass = $_POST['idclass'];
    $sql = "INSERT INTO level (idlevel, namelevel,idclass,unlockexp) VALUE ('$id','$nama','$idclass','$unlock')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "New record created successfully";
        header("location: ../admin/level.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/level.php");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM level WHERE idlevel='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/level.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/level.php");
    }
}
if (isset($_POST['editclass'])) {
    $id = $_POST['idlevel'];
    $nama = $_POST['namelevel'];
    $unlock = $_POST['unlockexp'];
    $idclass = $_POST['idclass'];
    $sql = "UPDATE level SET namelevel='$nama',unlockexp='$unlock',idclass='$idclass' WHERE idlevel='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "update Record successfully";
        header("location: ../admin/level.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/level.php");
        unset($_SESSION['edit']);
    }
}

if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
    header("location: ../CRUD/level.php");
}

function getID()
{
    include("../connector/db.php");
    $sql = "SELECT idlevel FROM level";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $id = intval(substr($row['idlevel'], 2, 3));
        if ($no != $id) {
            $idclass = $no;
        }
        $no++;
    }
    if (empty($idclass)) {
        $idclass = $no;
        if ($idclass < 10) {
            return "L-00" . $idclass;
        } else {
            return "L-0" . $idclass;
        }
    } else {
        if ($idclass < 10) {
            return "L-00" . $idclass;
        } else {
            return "L-0" . $idclass;
        }
    }
}
