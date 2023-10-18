<?php

include("../connector/db.php");
session_start();
if (isset($_POST['goadd'])) {
    $_SESSION['id'] = getID();
    unset($_SESSION['edit']);
    header("location: ../CRUD/users.php");
}

if (isset($_POST['adddata'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['name'];
    $pass = sha1($nis);
    $role = $_POST['role'];
    $sql = "INSERT INTO user (nis, nama,role,password) VALUE ('$nis','$nama','$role','$pass')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "New record created successfully";
        header("location: ../admin/users.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/users.php");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM user WHERE nis='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/users.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/users.php");
    }
}
if (isset($_POST['editclass'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['name'];
    $role = $_POST['role'];
    $sql = "UPDATE user SET nama='$nama',role='$role' WHERE nis='$nis'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "Update Record successfully";
        header("location: ../admin/users.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/users.php");
        unset($_SESSION['edit']);
    }
}

if (isset($_POST['goedit'])) {
    $_SESSION['edit'] = $_POST['goedit'];
    header("location: ../CRUD/users.php");
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
