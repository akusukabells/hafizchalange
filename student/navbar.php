<?php
/*getting active page name*/
$activePage = basename($_SERVER['PHP_SELF'], ".php");
include('../connector/db.php');
if ($_SESSION['role'] == 1) {
    header("Location: ../admin/dashboard.php");
}
?>
<div class="sidebar" data-color="orange">
    <div class="logo" style="padding:unset;">
        <a href="dashboard.php" class="simple-text logo-mini" style="width:80%">
            Hallo, <?php echo $_SESSION['nama']; ?><br>
            Score <?php
                    $nis = $_SESSION['nis'];
                    $sql = "SELECT * FROM exp where nis ='$nis'";
                    $result = mysqli_query($conn, $sql);
                    $exp;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo $row['exp'];
                            $exp = $row['exp'];
                        }
                    } ?>
        </a>

    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="dashboard.php">
                    <i class="now-ui-icons shopping_shop"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="changepassword.php">
                    <i class="now-ui-icons loader_gear"></i>
                    <p>Change Password</p>
                </a>
            </li>
            <li>
                <a href="../API/logout.php">
                    <i class="now-ui-icons media-1_button-power"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>