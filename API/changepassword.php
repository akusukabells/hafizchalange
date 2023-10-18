<?php
include('../connector/db.php');
session_start();

if (isset($_POST['resetadmin'])) {
    $old = $_POST['oldpassword'];
    $new = $_POST['newpassword'];
    $repet = $_POST['confirmpassword'];
    if ($new == $repet) {
        $nis = $_SESSION['nis'];
        $password = sha1($old);
        $sql = "SELECT * FROM user where nis ='$nis' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $newpassword = sha1($new);
                $sql = "UPDATE user SET password='$newpassword' WHERE nis='$nis'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status'] =  "Update Record successfully";
                    header("location: ../admin/changepassword.php");
                }
            }
        } else {
            $_SESSION['status'] =  "Password Salah";
            header("location: ../admin/changepassword.php");
        }
    } else {
        $_SESSION['status'] =  "Password Confirm Salah";
        header("location: ../admin/changepassword.php");
    }
}

if (isset($_POST['resetstudent'])) {
    $old = $_POST['oldpassword'];
    $new = $_POST['newpassword'];
    $repet = $_POST['confirmpassword'];
    if ($new == $repet) {
        $nis = $_SESSION['nis'];
        $password = sha1($old);
        $sql = "SELECT * FROM user where nis ='$nis' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $newpassword = sha1($new);
                $sql = "UPDATE user SET password='$newpassword' WHERE nis='$nis'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status'] =  "Update Record successfully";
                    header("location: ../student/changepassword.php");
                }
            }
        } else {
            $_SESSION['status'] =  "Password Salah";
            header("location: ../student/changepassword.php");
        }
    } else {
        $_SESSION['status'] =  "Password Confirm Salah";
        header("location: ../student/changepassword.php");
    }
}
