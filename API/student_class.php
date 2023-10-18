<?php
session_start();
include("../connector/db.php");
if (isset($_POST['gotoLevel'])) {
    unset($_SESSION['idclass']);
    $_SESSION['idclass'] = $_POST['gotoLevel'];
    header("location:../student/class.php");
}

if (isset($_POST['goquiz'])) {
    unset($_SESSION['multi']);
    unset($_SESSION['idlevel']);
    unset($_SESSION['score']);
    $_SESSION['idlevel'] = $_POST['goquiz'];

    $nis = $_SESSION['nis'];
    $del_quiz = "DELETE FROM temp_quiz WHERE nis='$nis'";
    $del_opsi = "DELETE FROM temp_option WHERE nis='$nis'";
    if ($conn->query($del_quiz) === TRUE && $conn->query($del_opsi) === TRUE) {
        $nomor = 1;
        $idlevel = $_SESSION['idlevel'];
        $sql = "SELECT * FROM question where idlevel ='$idlevel'";
        $result = mysqli_query($conn, $sql);
        foreach ($result as $key => $row) {
            $idquestion = $row['idquestion'];
            $answer = $row['answer'];
            $multioption = $row['multioption'];
            $score = $row['score'];
            $id = $nis . "-" . $nomor;
            $sql = "INSERT INTO temp_quiz (idtemp,idquestion,nis,answer,answer_temp,periksa,multioption,score) VALUE ('$id','$idquestion','$nis','$answer','-', 0,'$multioption','$score')";
            if ($conn->query($sql) === TRUE) {
            }
            if ($multioption == "true") {
                $nomoroption = 1;
                $getoption = "SELECT * FROM option where idquestion='$idquestion'";
                $result = mysqli_query($conn, $getoption);
                foreach ($result as $key => $row) {
                    $idoption = $row['idoption'];
                    $idquestion = $row['idquestion'];
                    $option = $row['option'];
                    $id = $nis . "-" . $idquestion . "-" . $nomoroption;
                    $postoption = "INSERT INTO temp_option (idtempoption,idoption,nis,periksa,idquestion, option) VALUE ('$id','$idoption','$nis','$nomoroption','$idquestion','$option')";
                    if ($conn->query($postoption)) {
                    }
                    $nomoroption++;
                }
            }
            $nomor++;
        }
    }
    $_SESSION['maxnumber'] = $nomor - 1;
    $_SESSION['score'] = 0;
    $_SESSION['number'] = 1;
    $idcheck = $nis . "-1";
    $sql = "SELECT * FROM temp_quiz where idtemp ='$idcheck'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            header("location:../student/quiz.php");
        }
    } else {
        $_SESSION['status'] =  "Question Not Found";
        header("location:../student/class.php");
    }
}

if (isset($_POST['quiz'])) {
    $choice = $_POST['choice'];
    if ($choice != null) {
        $nis = $_SESSION['nis'];
        $idtempquiz = $nis . "-" . $_SESSION['number'];
        $sql = "SELECT * FROM temp_quiz where idtemp ='$idtempquiz'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row1 = $result->fetch_assoc()) {
                if ($row1['multioption'] == "false") {
                    //untuk quiz biasa
                    if ($choice == $row1['answer']) {
                        //jawab benar
                        $_SESSION['score'] = $row1['score'] + $_SESSION['score'];
                        $sql = "UPDATE temp_quiz SET answer_temp='$choice',periksa=1 WHERE idtemp='$idtempquiz'";
                        if ($conn->query($sql)) {
                        }
                    } else {
                        //jawab salah
                        $sql = "UPDATE temp_quiz SET answer_temp='$choice',periksa=0 WHERE idtemp='$idtempquiz'";
                        if ($conn->query($sql)) {
                        }
                    }
                    $_SESSION['number']++;
                    $nextquestion = $nis . "-" . $_SESSION['number'];
                    $sql = "SELECT * FROM temp_quiz where idtemp ='$nextquestion'";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //ada soal
                            header("location:../student/quiz.php");
                        }
                    } else {
                        //gk ada soal
                        header("location:../student/result.php");
                    }
                } else if ($row1['multioption'] == "true") {
                    //untuk susun kata
                    $idquestiontemp = $row1['idquestion'];
                    $getoption = "SELECT * FROM temp_option where nis='$nis' AND idquestion='$idquestiontemp' AND option ='$choice'";
                    $result = mysqli_query($conn, $getoption);
                    $row = $result->fetch_assoc();
                    //simpan soal
                    $_SESSION['multi'] = $_SESSION['multi'] . $row['option'];
                    $idtemp = $row['idtempoption'];
                    $sql = "DELETE FROM temp_option WHERE idtempoption='$idtemp'";
                    if ($conn->query($sql) === TRUE) {
                        $getnextoption = "SELECT * FROM temp_option where nis='$nis' AND idquestion='$idquestiontemp'";
                        $result = mysqli_query($conn, $getnextoption);
                        if ($result->num_rows > 0) {
                            header("location:../student/quiz.php");
                        } else {
                            //datasudahtidakada
                            if ($_SESSION['multi'] == $row1['answer']) {
                                //jawab benar
                                $_SESSION['score'] = $row1['score'] + $_SESSION['score'];
                                $jawaban = $_SESSION['multi'];
                                $sql = "UPDATE temp_quiz SET answer_temp='$jawaban',periksa=1 WHERE idtemp='$idtempquiz'";
                                $conn->query($sql);
                            } else {
                                //jawab salah
                                $jawaban = $_SESSION['multi'];
                                $sql = "UPDATE temp_quiz SET answer_temp='$jawaban',periksa=0 WHERE idtemp='$idtempquiz'";
                                $conn->query($sql);
                            }
                            $_SESSION['number']++;
                            $nextquestion = $nis . "-" . $_SESSION['number'];
                            $sql = "SELECT * FROM temp_quiz where idtemp ='$nextquestion'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    //ada soal
                                    unset($_SESSION['multi']);
                                    header("location:../student/quiz.php");
                                }
                            } else {
                                //gk ada soal
                                unset($_SESSION['multi']);
                                header("location:../student/result.php");
                            }
                        }
                    }
                }
            }
        }
    } else {
        header("location:../student/quiz.php");
    }
}


if (isset($_POST['result'])) {
    $nis = $_SESSION['nis'];
    $sql = "SELECT * FROM exp where nis ='$nis'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        //ada data exp
        $row = $result->fetch_assoc();
        $total = $_SESSION['score'] + $row['exp'];
        $sql = "UPDATE exp SET exp='$total'WHERE nis='$nis'";
        if ($conn->query($sql)) {
            unset($_SESSION['score']);
            unset($_SESSION['number']);
            $del_quiz = "DELETE FROM temp_quiz WHERE nis='$nis'";
            $del_opsi = "DELETE FROM temp_option WHERE nis='$nis'";
            $conn->query($del_opsi);
            $conn->query($del_quiz);
            header("location:../student/class.php");
        }
    } else {
        //tidak ada data exp
        $total = $_SESSION['score'];
        $sql = "INSERT INTO exp (nis, exp) VALUE ('$nis','$total')";
        if ($conn->query($sql)) {
            unset($_SESSION['score']);
            unset($_SESSION['number']);
            $del_quiz = "DELETE FROM temp_quiz WHERE nis='$nis'";
            $del_opsi = "DELETE FROM temp_option WHERE nis='$nis'";
            $conn->query($del_opsi);
            $conn->query($del_quiz);
            header("location:../student/class.php");
        }
    }
}
