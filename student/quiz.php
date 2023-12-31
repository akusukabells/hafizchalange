<?php
session_start();
if (!isset($_SESSION["nis"]))
    header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="robots" content="noindex">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1" />
    <title>
        Leader Board
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
    <!-- <link type="text/css" rel="stylesheet" href="http://jqueryte.com/css/jquery-te.css" charset="utf-8"> -->
    <link href="../assets/css/main.css" rel="stylesheet" />
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            font-size: 25px;
            text-align: center;
        }

        .grid-count {
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="">
    <div class="wrapper ">
        <!-- sidebar -->
        <?php
        include "navbar.php";
        ?>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <?php include("../admin/logo.php"); ?>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <?php include "navitem.php"; ?>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content" style="min-height: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="card" style="min-height:400px;">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="title">Quiz</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="btn btn-primary btn-block btn-round" style="margin-top:0px;max-width:120px !important;float:right !important;" aria-readonly="true">
                                                <?php

                                                echo $_SESSION['number'] . "/" . $_SESSION['maxnumber'] . " Question";
                                                ?></div>

                                        </div>

                                    </div>
                                    <!-- konten   -->
                                    <?php
                                    include('../connector/db.php');
                                    $id = $_SESSION['nis'] . "-" . $_SESSION['number'];
                                    $sql = "SELECT * FROM temp_quiz INNER JOIN question ON temp_quiz.idquestion = question.idquestion where idtemp ='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row['multioption'] == "false") {
                                    ?>
                                                <form method="post" action="../API/student_class.php">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Question score : <?php echo $_SESSION['score']; ?></label>
                                                        <h2><?php echo $row['question']; ?></h2>
                                                    </div>
                                                    <div class="form-check">
                                                        <?php
                                                        $idquestions = $row['idquestion'];
                                                        $sql = "SELECT * FROM option where idquestion='$idquestions'";
                                                        $result = mysqli_query($conn, $sql);
                                                        foreach ($result as $key => $row) {
                                                            echo "<br>";
                                                            echo "<input class='form-check-input' type='radio' name='choice' value='" . $row['option'] . "'>";
                                                            echo "<label class='form-check-label' for='exampleRadios1'>";
                                                            echo "<h3>" . $row['option'] . "</h3>";
                                                            echo "</label>";
                                                        }
                                                        if (!empty($_SESSION['multi'])) {
                                                            echo "<br><center><h4>Result<br></h4><h3>" . $_SESSION['multi'] . "</h3></center>";
                                                        }
                                                        ?>

                                                    </div>
                                                    <button class=" btn btn-primary btn-block btn-round" name="quiz" style="margin-top:50px;float:right !important;">Submit</button>
                                                </form>
                                            <?php
                                            } else {
                                            ?>
                                                <form method="post" action="../API/student_class.php">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Question score : <?php echo $_SESSION['score']; ?></label>
                                                        <h4><?php echo $row['question']; ?></h4>
                                                    </div>
                                                    <div class="form-check">
                                                        <?php
                                                        $idquestions = $row['idquestion'];
                                                        $nis = $_SESSION['nis'];
                                                        $sql = "SELECT * FROM temp_option where idquestion='$idquestions' AND nis='$nis'";
                                                        $result = mysqli_query($conn, $sql);
                                                        foreach ($result as $key => $row) {
                                                            echo "<br>";
                                                            echo "<input class='form-check-input' type='radio' name='choice' value='" . $row['option'] . "'>";
                                                            echo "<label class='form-check-label' for='exampleRadios1'>";
                                                            echo "<h3>" . $row['option'] . "</h3>";
                                                            echo "</label>";
                                                        }
                                                        if (!empty($_SESSION['multi'])) {
                                                            echo "<br><center><h4>Result<br></h4><h3>" . $_SESSION['multi'] . "</h3></center>";
                                                        }
                                                        ?>

                                                    </div>
                                                    <button class=" btn btn-primary btn-block btn-round" name="quiz" style="margin-top:50px;float:right !important;">Submit</button>
                                                </form>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer -->
        <?php
        include "footer.php";
        ?>
    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
    <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>

</html>