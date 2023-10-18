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
        Question
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
                        <div class="card" style="min-height:400px;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="title">Question</h5>
                                    </div>
                                </div>
                                <?php
                                include("../connector/db.php");
                                if (!empty($_SESSION['edit'])) {
                                    $id = $_SESSION['edit'];
                                    $sql = "SELECT * FROM question where idquestion ='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                ?>
                                            <form method="post" action="../API/question.php">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">ID Question</label>
                                                    <input type="text" class="form-control" name="idquestion" value="<?php echo $_SESSION['edit']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Level</label>
                                                    <select class="form-control" name="idlevel">
                                                        <?php

                                                        $sql = "SELECT * FROM level";
                                                        $result = mysqli_query($conn, $sql);
                                                        foreach ($result as $key => $row1) {
                                                            if ($row1['idlevel'] == $row['idlevel']) {
                                                                echo "<option value=" . $row1['idlevel'] . " selected>" . $row1['namelevel'] . "</option>";
                                                            } else {
                                                                echo "<option value=" . $row1['idlevel'] . ">" . $row1['namelevel'] . "</option>";
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Question</label>
                                                    <textarea class="form-control" name="question" rows="3" placeholder="Question"><?php echo $row['question']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Option</label>
                                                    <?php
                                                    $ids = $_SESSION['edit'];
                                                    $sql = "SELECT * FROM option WHERE idquestion = '$id'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $no = 1;
                                                    function keabcd($no)
                                                    {
                                                        switch ($no) {
                                                            case "1":
                                                                return "A";
                                                            case "2":
                                                                return "B";
                                                            case "3":
                                                                return "C";
                                                            case "4":
                                                                return "D";
                                                        }
                                                    }
                                                    function keabcdid($no)
                                                    {
                                                        switch ($no) {
                                                            case "1":
                                                                return "option_1";
                                                            case "2":
                                                                return "option_2";
                                                            case "3":
                                                                return "option_3";
                                                            case "4":
                                                                return "option_4";
                                                        }
                                                    }
                                                    foreach ($result as $key => $row2) {
                                                    ?>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><?php echo keabcd($no); ?></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="<?php echo keabcdid($no); ?>" placeholder="Option" value="<?php echo $row2['option']; ?>">
                                                        </div>
                                                    <?php
                                                        $no++;
                                                    }


                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Answer</label>
                                                    <select class="form-control" name="answer">
                                                        <?php
                                                        $ids = $_SESSION['edit'];
                                                        $sqloption = "SELECT * FROM option WHERE idquestion = '$id'";
                                                        $result2 = mysqli_query($conn, $sqloption);
                                                        $nomor = 1;
                                                        foreach ($result2 as $key => $row3) {
                                                            if ($row['answer'] == $row3['option']) {
                                                                echo "<option value=" . keabcd($nomor) . " selected>" . keabcd($nomor) . "</option>";
                                                            } else {
                                                                echo "<option value=" . keabcd($nomor) . ">" . keabcd($nomor) . "</option>";
                                                            }
                                                            $nomor++;
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Score</label>
                                                        <input type="number" class="form-control" name="score" value="<?php echo $row['score'] ?>">
                                                    </div>
                                                </div>
                                                <button class=" btn btn-primary btn-block btn-round" name="edit" style="margin-top:50px;float:right !important;">Save</button>

                                            </form>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <form method="post" action="../API/question.php">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">ID Question</label>
                                            <input type="text" class="form-control" name="idquestion" value="<?php echo $_SESSION['id']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Level</label>
                                            <select class="form-control" name="idlevel">
                                                <?php
                                                $sql = "SELECT * FROM level";
                                                $result = mysqli_query($conn, $sql);
                                                foreach ($result as $key => $row) {
                                                    echo "<option value=" . $row['idlevel'] . ">" . $row['namelevel'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Question</label>
                                            <textarea class="form-control" name="question" rows="3" placeholder="Question"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Option</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">A</div>
                                                </div>
                                                <input type="text" class="form-control" name="option_1" placeholder="Option A">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">B</div>
                                                </div>
                                                <input type="text" class="form-control" name="option_2" placeholder="Option B">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">C</div>
                                                </div>
                                                <input type="text" class="form-control" name="option_3" placeholder="Option C">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">D</div>
                                                </div>
                                                <input type="text" class="form-control" name="option_4" placeholder="Option D">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Answer</label>
                                            <select class="form-control" name="answer">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Score</label>
                                            <input type="number" class="form-control" name="score">
                                        </div>
                                        <button class=" btn btn-primary btn-block btn-round" name="adddata" style="margin-top:50px;float:right !important;">Add Question</button>

                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="test_details.php" id="test_details">
                <input type="hidden" id="test_id" name="test_id">
            </form>
            <!-- footer -->
            <?php
            include "footer.php";
            ?>
        </div>
    </div>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.1.0" type="text/javascript"></script>
    <!-- <script src="http://jqueryte.com/js/jquery-te-1.4.0.min.js"></script> -->
</body>


</html>