<?php
ob_start();
$added=false;
require_once('../load.php');
require_once(ABSPATH.cls.'/Zebra_Pagination.php' );
require_once('class/client.php' );
//include('class/client.php');
$admin=new client();
$email=$admin->scan($_SESSION['email_ad']);
$config->query="SELECT id FROM admin where email='".$email."'";
$config->pripare();
$ensignient=mysqli_fetch_assoc($config->data);
if(!isset($_SESSION['email_ad'])or !isset($_SESSION['password_ad']))
{
header("location: logout.php");
}
else
{


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Acceuil</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require_once('menu.php')?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Acceuil</li>
      </ol>
      <div class="jumbotron text-center bg-dark text-white">
        <div class="container">
          <h1 class="jumbotron-heading">Administration</h1>
          <p class=" text-white">“Whenever you have taken up work in hand, you must see it to the finish. That is the ultimate secret of success. Never, never, never give up!” – Dada Vaswani</p>
          <p>
            <a href="project.php" class="btn btn-primary my-2">Project management</a>
            <a href="galerie.php" class="btn btn-info my-2">Photo Modifications</a>
          </p>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © TicketDZ 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
        <?php require_once('Modellogout.php')?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
  </div>
</body>

</html>
<?php }
?>