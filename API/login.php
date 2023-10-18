<?php

include("../connector/db.php");
session_start();
if (isset($_POST['login'])) {
    $nis = $_POST['nis'];
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM user WHERE nis='$nis' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nis'] = $row['nis'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['nama'] = $row['nama'];
        if ($row['role'] == 1) {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../student/dashboard.php");
        }
    } else {
        $_SESSION['status'] = "NIS atau password Anda salah. Silakan coba lagi!";
        header("Location: ../index.php");
    }
}
