<?php

include("../connector/db.php");
session_start();
if (isset($_POST['goselect'])) {
    header("location: ../CRUD/select_question.php");
}

if (isset($_POST['goadd'])) {
    $_SESSION['id'] = getID();
    if ($_POST['select_question'] == 1) {
        unset($_SESSION['edit']);
        header("location: ../CRUD/question.php");
    } else {
        unset($_SESSION['edit']);
        header("location: ../CRUD/susunkata.php");
    }
}
if (isset($_POST['adddatasusunkata'])) {
    $id = $_POST['idquestion'];
    $idlevel = $_POST['idlevel'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $score = $_POST['score'];
    $option = $_POST['member'];
    for ($i = 0; $i < $option; $i++) {
        $idoption = getIDoption();
        $opsi = $_POST['option' . $i];
        $sql_A = "INSERT INTO option (idoption,idquestion,option) VALUE ('$idoption','$id','$opsi')";
        if ($conn->query($sql_A) === TRUE) {
        }
    }
    $sql = "INSERT INTO question (idquestion, answer,idlevel,multioption,option, question, score) VALUE ('$id','$answer','$idlevel','true', '$option','$question','$score')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "New record created successfully";
        header("location: ../admin/question.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/question.php");
    }
}
if (isset($_POST['adddata'])) {
    $id = $_POST['idquestion'];
    $idlevel = $_POST['idlevel'];
    $question = $_POST['question'];
    $option_a = $_POST['option_1'];
    $option_b = $_POST['option_2'];
    $option_c = $_POST['option_3'];
    $option_d = $_POST['option_4'];
    $answer = $_POST['answer'];
    $score = $_POST['score'];
    if ($answer == "A") {
        $jawab = $option_a;
    } else if ($answer == "B") {
        $jawab = $option_b;
    } else if ($answer == "C") {
        $jawab = $option_c;
    } else if ($answer == "D") {
        $jawab = $option_d;
    }
    for ($i = 1; $i <= 4; $i++) {
        $idoption = getIDoption();
        $opsi = $_POST['option_' . $i];
        $sql_A = "INSERT INTO option (idoption,idquestion,option) VALUE ('$idoption','$id','$opsi')";
        if ($conn->query($sql_A) === TRUE) {
        }
    }

    $sql = "INSERT INTO question (idquestion, answer,idlevel,multioption,option, question, score) VALUE ('$id','$jawab','$idlevel','false', '4','$question','$score')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "New record created successfully";
        header("location: ../admin/question.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/question.php");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM question WHERE idquestion='$id'";
    $sqloption = "DELETE FROM option WHERE idquestion='$id'";
    if ($conn->query($sql) === TRUE && $conn->query($sqloption) === TRUE) {
        $_SESSION['status'] =  "Delete Record successfully";
        header("location: ../admin/question.php");
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/question.php");
    }
}
if (isset($_POST['edit'])) {
    $id = $_POST['idquestion'];
    $idlevel = $_POST['idlevel'];
    $question = $_POST['question'];
    $option_a = $_POST['option_1'];
    $option_b = $_POST['option_2'];
    $option_c = $_POST['option_3'];
    $option_d = $_POST['option_4'];
    $answer = $_POST['answer'];
    $score = $_POST['score'];
    if ($answer == "A") {
        $jawab = $option_a;
    } else if ($answer == "B") {
        $jawab = $option_b;
    } else if ($answer == "C") {
        $jawab = $option_c;
    } else if ($answer == "D") {
        $jawab = $option_d;
    }

    $sql = "SELECT * FROM option where idquestion='$id'";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $opsi = $_POST['option_' . $no];
        $idoption = $row['idoption'];
        $updateoption = "UPDATE option set option='$opsi' WHERE idoption ='$idoption'";
        if ($conn->query($updateoption) === TRUE) {
            $no++;
        }
    }

    $sql = "UPDATE question SET answer='$jawab', idlevel='$idlevel', question='$question',score='$score' where idquestion = '$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] =  "update Record successfully";
        header("location: ../admin/question.php");
        unset($_SESSION['edit']);
    } else {
        $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
        header("location: ../admin/question.php");
        unset($_SESSION['edit']);
    }
}

if (isset($_POST['goedit'])) {
    $_SESSION['edit'] = $_POST['goedit'];
    $id = $_POST['goedit'];
    $sql = "SELECT * FROM question where idquestion='$id'";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $key => $row) {
        if ($row['multioption'] == "true") {
            $_SESSION['status'] =  "Coming Soon";
            header("location: ../admin/question.php");
        } else {
            header("location: ../CRUD/question.php");
        }
    }
}

function getID()
{
    include("../connector/db.php");
    $sql = "SELECT idquestion FROM question";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $id = intval(substr($row['idquestion'], 2, 3));
        if ($no != $id) {
            $idclass = $no;
        }
        $no++;
    }
    if (empty($idclass)) {
        $idclass = $no;
        if ($idclass < 10) {
            return "Q-00" . $idclass;
        } else {
            return "Q-0" . $idclass;
        }
    } else {
        if ($idclass < 10) {
            return "Q-00" . $idclass;
        } else {
            return "Q-0" . $idclass;
        }
    }
}

function getIDoption()
{
    include("../connector/db.php");
    $sql = "SELECT idoption FROM option";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    foreach ($result as $key => $row) {
        $id = intval(substr($row['idoption'], 2, 3));
        if ($no != $id) {
            $idclass = $no;
            if ($idclass < 10) {
                return "O000" . $idclass;
            } else {
                return "O00" . $idclass;
            }
            break;
        }
        $no++;
    }
    if (empty($idclass)) {
        $idclass = $no;
        if ($idclass < 10) {
            return "O000" . $idclass;
        } else {
            return "O00" . $idclass;
        }
    } else {
        if ($idclass < 10) {
            return "O000" . $idclass;
        } else {
            return "O00" . $idclass;
        }
    }
}
