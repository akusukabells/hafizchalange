<?php

include("../connector/db.php");
session_start();
if (isset($_POST['goaddclass'])) {
    $_SESSION['id'] = getID();
    header("location: ../CRUD/class.php");
}

if (isset($_POST['adddataclass'])) {
    $id = $_POST['idclass'];
    $nama = $_POST['nameclass'];
    $sql = "INSERT INTO class (idclass, nameclass) VALUE ('$id','$nama')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "New record created successfully";
        header("location: ../admin/class.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/class.php");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM class WHERE idclass='$id'";
    $sqladdclass = "DELETE FROM addclass WHERE idclass='$id'";
    if ($conn->query($sql) === TRUE && $conn->query($sqladdclass) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/class.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/class.php");
    }
}
if (isset($_POST['editclass'])) {
    $id = $_POST['idclass'];
    $nama = $_POST['nameclass'];
    $sql = "UPDATE class SET nameclass='$nama' WHERE idclass='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/class.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/class.php");
        unset($_SESSION['edit']);
    }
}

if (isset($_POST['edit'])) {
    $_SESSION['edit'] = $_POST['edit'];
    header("location: ../CRUD/class.php");
}

function getID()
{
    include("../connector/db.php");
    $sql = "SELECT idclass FROM class";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $id = intval(substr($row['idclass'], 2, 3));
        if ($no != $id) {
            $idclass = $no;
        }
        $no++;
    }
    if (empty($idclass)) {
        $idclass = $no;
        if ($idclass < 10) {
            return "C-00" . $idclass;
        } else {
            return "C-0" . $idclass;
        }
    } else {
        if ($idclass < 10) {
            return "C-00" . $idclass;
        } else {
            return "C-0" . $idclass;
        }
    }
}
