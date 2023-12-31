<?php
session_start();
if (!isset($_SESSION["nis"])) {
    header("Location:../index.php");
}

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
    <link href="https://fonts.cdnfonts.com/css/blackpool" rel="stylesheet">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
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
                        <?php include("logo.php"); ?>
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
                    <div class="col-md-7 ">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">Class<?php echo $_SESSION['nis']; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="grid-container">
                                    <?php
                                    include("../connector/db.php");
                                    $sql = "SELECT * FROM class";
                                    $result = mysqli_query($conn, $sql);
                                    $no = 1;
                                    foreach ($result as $key => $row) {
                                    ?>
                                        <form action="../API/addclass.php" method="post">
                                            <button class="shadow-lg p-3 bg-white rounded btn btn-link" name="goto" value="<?php echo $row['idclass']; ?>">

                                                <div class="grid-item"><?php echo $row['nameclass']; ?></div>
                                                <?php
                                                $idclass = $row['idclass'];
                                                $sql = "SELECT * FROM addclass where idclass='$idclass'";
                                                $result = mysqli_query($conn, $sql);
                                                $no = 0;
                                                foreach ($result as $key => $row) {
                                                    $no++;
                                                }
                                                ?>
                                                <div class="grid-count"><?php echo $no . " student"; ?></div>

                                            </button>
                                        </form>
                                    <?php

                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">TOP Score</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" style="margin-left:1%">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">No</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">SCORE</th>
                                            <th scope="col">Reward</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("../connector/db.php");
                                        $sql = "SELECT * FROM exp INNER JOIN user ON exp.nis = user.nis ORDER BY exp DESC";
                                        $result = mysqli_query($conn, $sql);
                                        $no = 1;
                                        foreach ($result as $key => $row) {
                                        ?>
                                            <tr>
                                                <?php
                                                if ($no == 1) {
                                                    echo "<td><box-icon name='crown' type='solid' color='#FFD700' ></box-icon></td>";
                                                ?>
                                                    <th scope="row"><?php echo $no; ?></th>
                                                    <td><?php echo $row['nis']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['exp']; ?></td>
                                                    <td><?php
                                                        $sql = "SELECT * FROM reward";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo $row['juara1'];
                                                            }
                                                        }
                                                        ?></td>


                                                <?php

                                                } else if ($no == 2) {
                                                    echo "<td><box-icon name='crown' type='solid' color='#D3D3D3' ></box-icon></td>";
                                                ?>
                                                    <th scope="row"><?php echo $no; ?></th>
                                                    <td><?php echo $row['nis']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['exp']; ?></td>
                                                    <td><?php
                                                        $sql = "SELECT * FROM reward";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo $row['juara2'];
                                                            }
                                                        }
                                                        ?></td>

                                                <?php
                                                } else if ($no == 3) {
                                                    echo "<td><box-icon name='crown' type='solid' color='#964B00' ></box-icon></td>";
                                                ?>
                                                    <th scope="row"><?php echo $no; ?></th>
                                                    <td><?php echo $row['nis']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['exp']; ?></td>
                                                    <td><?php
                                                        $sql = "SELECT * FROM reward";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo $row['juara3'];
                                                            }
                                                        }
                                                        ?></td>

                                                <?php
                                                } else {
                                                ?>
                                                    <th scope="row"><?php echo $no; ?></th>
                                                    <td><?php echo $row['nis']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['exp']; ?></td>
                                                <?php
                                                }
                                                ?>

                                            </tr>
                                        <?php
                                            $no++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
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