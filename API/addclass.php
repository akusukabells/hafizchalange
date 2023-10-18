<?php
session_start();
include('../connector/db.php');

if (isset($_POST['goto'])) {
    unset($_SESSION['idclass']);
    $_SESSION['idclass'] = $_POST['goto'];
    header("location:../admin/addclass.php");
}
if (isset($_POST['goadd'])) {
    header("location:../CRUD/addclass.php");
}

if (isset($_POST['addclassdata'])) {
    $nis = $_POST['nis'];
    $idclass = $_SESSION['idclass'];
    $sql = "SELECT * FROM user where nis ='$nis'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $id = getID();
            $sql = "INSERT INTO addclass (idaddclass,idclass,nis) VALUE ('$id','$idclass','$nis')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] =  "New record created successfully";
                header("location: ../admin/addclass.php");
            } else {
                $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
                header("location: ../admin/addclass.php");
            }
        }
    } else {
        $_SESSION['status'] =  "NIS Tidak ditemukan";
        header("location: ../admin/addclass.php");
    }
}

if (isset($_POST['delete'])) {
    $nis = $_POST['delete'];
    $idclass = $_SESSION['idclass'];
    $sql = "DELETE FROM addclass WHERE nis='$nis' AND idclass = '$idclass'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/addclass.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/addclass.php");
    }
}

function getID()
{
    include("../connector/db.php");
    $sql = "SELECT idaddclass FROM addclass";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $id = intval(substr($row['idaddclass'], 2, 3));
        if ($no != $id) {
            $idclass = $no;
            if ($idclass < 10) {
                return "A-00" . $idclass;
                break;
            } else {
                return "A-0" . $idclass;
                break;
            }
        }
        $no++;
    }
    if (empty($idclass)) {
        $idclass = $no;
        if ($idclass < 10) {
            return "A-00" . $idclass;
        } else {
            return "A-0" . $idclass;
        }
    } else {
        if ($idclass < 10) {
            return "A-00" . $idclass;
        } else {
            return "A-0" . $idclass;
        }
    }
}
