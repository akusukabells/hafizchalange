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
        Users
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
                                        <h5 class="title">Users</h5>
                                    </div>
                                </div>
                                <?php
                                include("../connector/db.php");
                                if (!empty($_SESSION['edit'])) {
                                    $id = $_SESSION['edit'];
                                    $sql = "SELECT * FROM user where nis ='$id'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($getData = $result->fetch_assoc()) {
                                ?>
                                            <form method="post" action="../API/users.php">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Nomor Induk Siswa</label>
                                                    <input type="number" class="form-control" name="nis" placeholder="Nomor Induk Siswa" value="<?php echo $_SESSION['edit']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Student Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Student Name" value="<?php echo $getData['nama']; ?>">
                                                </div>
                                                <div class=" form-group">
                                                    <label for="exampleFormControlSelect1">Role</label>
                                                    <select class="form-control" name="role">
                                                        <?php
                                                        if ($getData['role'] == "1") {
                                                        ?>
                                                            <option value="0">Student</option>
                                                            <option value="1" selected>Teacher</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="0" selected>Student</option>
                                                            <option value="1">Teacher</option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <button class=" btn btn-primary btn-block btn-round" name="editclass" style="margin-top:50px;float:right !important;">Save</button>

                                            </form>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <form method="post" action="../API/users.php">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nomor Induk Siswa</label>
                                            <input type="number" class="form-control" name="nis" placeholder="Nomor Induk Siswa">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Student Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Student Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Role</label>
                                            <select class="form-control" name="role">
                                                <option value="0">Student</option>
                                                <option value="1">Teacher</option>
                                            </select>
                                        </div>
                                        <button class=" btn btn-primary btn-block btn-round" name="adddata" style="margin-top:50px;float:right !important;">Add Student</button>

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