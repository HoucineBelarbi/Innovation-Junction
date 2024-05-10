<?php 
ob_start();
require_once('../load.php');
require_once('class/client.php' );
$newetudient = new client();
if(isset($_SESSION['email_ad'])or isset($_SESSION['password_ad']))
{
header("location: index.php");
}
else
{
	if (isset($_POST['login']))
{

	if(isset($_POST['email'])){$newetudient->email=$_POST['email'];}else $newetudient->email=NULL;
	if(isset($_POST['password'])){$newetudient->password=$_POST['password'];}else $newetudient->password=NULL;
	if($newetudient->validate_frm_login()) 
	{
		
		header("location: index.php");
	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label  for="exampleInputEmail1">Email address</label>
            <input name="email"  value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input  value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
          </div>
         
          <input name="login" value="الدخول" type="submit" class="btn btn-primary btn-block"/>
        </form>
        		<div class="card-text"> 
                
                <?php
if (isset($_POST['login']))
{
	if(isset($_POST['email'])){$newetudient->email=$_POST['email'];}else $newetudient->email=NULL;
	if(isset($_POST['password'])){$newetudient->password=$_POST['password'];}else $newetudient->password=NULL;
	if(!$newetudient->validate_frm_login()) 
	{
		
		echo '<p class="alert alert-warning text-center">'.$newetudient->error.'</p>';
	}
	
	else
	{ 
		if($newetudient->login())
		{
			echo '<p class="alert alert-success text-center">تم الدخول بنجاح <a href="index.php" target="_blank">لوحة التحكم</a></p> ';
		}
		else 
		{
			echo '<p class="alert alert-warning text-center">ddddd'.$newetudient->db_error.'</p>';
		}
	}

}

?>
                </div>
             </div>
              
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
<?php }?>