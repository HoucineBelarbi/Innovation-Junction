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
  <title>Change password</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!--css zebra pagination -->
<link rel="stylesheet" type="text/css" href="css/zebra_pagination.css">
  <!--ckeditor  -->
  <!--theme simple editor mkeditor -->
  <!--zebra pagination -->
  <link rel='stylesheet' type='text/css' href='../style/css/zebra_pagination.css'/>
  <!--jquery -->
  <!--select all -->
 
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php require_once('menu.php')?>

  
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change password</li>
      </ol>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>change password</div>
        <div class="card-body">

		<div class="row">
	
</div>
<div class="row p-3">
          <form method="post" >
              <div class="form-group">
                <div class="form-row">
                    <label for="exampleInputName">New Password</label>
                    <input class="form-control" id="password" type="password" aria-describedby="nameHelp" placeholder="New Password" name="newpassword" value="<?php if(isset($_POST['newpassword'])) echo $_POST['newpassword'];?>">
                </div>
              </div>
       
       
       <div class="form-group">
                <div class="form-row">
                    <label for="exampleInputName">Password again</label>
                    <input class="form-control" id="password_again" type="password" aria-describedby="nameHelp" placeholder="Password Again" name="passwordagain" value="<?php if(isset($_POST['passwordagain'])) echo $_POST['passwordagain'];?>">
                </div>
              </div>
           
       
         <input name="changepass" class="btn btn-success  " type="submit" value="Change"/>

            </form>
          </div>
          
                  <?php 
		if(isset($_POST['changepass']))
			{
				if(isset($_POST['newpassword']) and isset($_POST['passwordagain'])){

					if($admin->validate_password($_POST['newpassword']))
					{
						$password=$admin->scan($_POST['newpassword']);
						$passwordagain=$admin->scan($_POST['passwordagain']);
						if($admin->validate_password_again($password,$passwordagain))
						{
								$admin->config->query="update admin set password ='".$password."';"; 
								$added=$admin->config->pripare(); 
								
								if($added==true)
								{
									echo "<p class='col-12 alert badge-success text-center'>change password successd</p>"; 
								}
								else
								{
									echo '<p class="col-12 alert alert-warning text-center">change password faild</p>'; 
								}
						}
						else 
						{
						echo "<span class=' alert badge-danger text-white'>password again =/=password </span>";
						}
						
					}
					else
					{
						echo $admin->db_error;
						echo "<span class=' alert badge-info text-white'>new password: </span><span class=' badge badge-danger text-white'>{0-9}</span> and <span class=' badge badge-danger text-white'>{a-Z}</span> and  <span class=' badge badge-danger text-white'>len{8-12}<span>";
					}
				}
				else 
				{
					echo "need input";
				}
			}
				


		?>
        </div>
        
      </div>
       </div>
   
  <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your TicketDz 2018</small>
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
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-charts.min.js"></script>
    </div>
</body>

</html>
<?php }
?>