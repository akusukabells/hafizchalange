<?php
include('../connector/db.php');
session_start();

if (isset($_POST['resetpassword'])) {
    $nis = $_POST['oldpassword'];
    $sql = "SELECT * FROM user where nis ='$nis'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $newpassword = sha1($nis);
            $sql = "UPDATE user SET password='$newpassword' WHERE nis='$nis'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['status'] =  "Reset Password successfully";
                header("location: ../admin/resetpassword.php");
            }
        }
    } else {
        $_SESSION['status'] =  "NIS Tidak ditemukan";
        header("location: ../admin/resetpassword.php");
    }
}
