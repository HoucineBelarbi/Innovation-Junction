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
  <title>Change email</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!--css zebra pagination -->
<link rel="stylesheet" type="text/css" href="css/zebra_pagination.css">
  <!--ckeditor  -->
      <script src="js/jquery-1.11.2.min.js"></script>
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
        <li class="breadcrumb-item active">Change email</li>
      </ol>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>change email</div>
        <div class="card-body">

		<div class="row">
	
</div>
<div class="row p-3">
          <form method="post" >
              <div class="form-group">
                <div class="form-row">
                    <label for="exampleInputName">New mail</label>
                    <input class="form-control" id="newemail" type="text" aria-describedby="nameHelp" placeholder="New mail" name="newemail" value="<?php if(isset($_POST['newemail'])) echo $_POST['newemail'];?>">
                </div>
              </div>
       
       
       <div class="form-group">
                <div class="form-row">
                    <label for="exampleInputName">email again</label>
                    <input class="form-control" id="email_again" type="text" aria-describedby="nameHelp" placeholder="mail Again" name="emailagain" value="<?php if(isset($_POST['emailagain'])) echo $_POST['emailagain'];?>">
                </div>
              </div>
           
       
         <input name="changemail" class="btn btn-success  " type="submit" value="Change"/>

            </form>
          </div>
          
                  <?php 
		if(isset($_POST['changemail']))
			{
				if(isset($_POST['newemail']) and isset($_POST['emailagain'])){

					if($admin->validate_email($_POST['newemail']))
					{
						$email=$admin->scan($_POST['newemail']);
						$emailagain=$admin->scan($_POST['emailagain']);
						if($admin->validate_password_again($email,$emailagain))
						{
								$admin->config->query="update admin set email ='".$email."';"; 
								$added=$admin->config->pripare();  
								if($added==true)
								{
									echo "<p class='col-12 alert badge-success text-center'>change mail successd</p>"; 
								}
								else
								{
									echo '<p class="col-12 alert alert-warning text-center">change mail faild</p>'; 
								}
						}
						else 
						{
						echo "<span class=' alert badge-danger text-white'>mail again =/=mail </span>";
						}
						
					}
					else
					{
						echo $admin->db_error;
						echo "<span class=' alert badge-info text-white'>new mail: </span><span class=' badge badge-danger text-white'>exemple@domain.com</span>";
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