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
  <title>Update</title>
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
  <script src='include/ckeditor/ckeditor.js'></script>
  <!--theme simple editor mkeditor -->
  <script src='include/ckeditor/samples/js/sample.js'></script>
  <!--zebra pagination -->
  <link rel='stylesheet' type='text/css' href='../style/css/zebra_pagination.css'/>
  <!--jquery -->
  <!--select all -->
   <script type="text/javascript">
$(document).ready(function(e) {
$('#select_all').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});  
});
</script> 
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
        <li class="breadcrumb-item active">Charts</li>
      </ol>
      <!-- Area Chart Example-->
     <?php
	    if(!isset($_GET['prj']))
        {
            echo "<div class='jumbotron'><h3 class='text-center'>The link you are looking for does not exist</h3></div>";
        }
        else
        {

			?>


      <div class="card mb-3">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>Modifier le projet</div>



            <div class="card-body">


             <div class="row w-100">
               <?php
			$id=(int)$_GET['prj'];
			if(isset($_POST['updt']))
			{
				$title_u=$admin->scan_text($_POST['title']);
				$rsm_u=$admin->scan_text($_POST['rsm']);
				$txt_u=$admin->html2math($_POST['link']);

				$admin->config->query="update `interface` set
				 `nom` ='".$title_u."',
				 `rsm`='".$rsm_u."',
				 `txt`='".$txt_u."'
				  where id='".$id."'";
				 
				$admin->config->pripare();
				
					if($admin->config->pripare==true)
					{
						echo "<p class='alert alert-success text-center w-100'>Modified successfully</p>"; 
					}
					else
					{
						echo $admin->config->query;
						echo '<p class="alert alert-warning text-center w-100">An error occurred while editing</p>'; 
					}
				}

				?>   
            </div>
             <div class="row">
              <?php
			
			$admin->config->query="SELECT * FROM interface WHERE id='".$id."'";
			$admin->config->pripare();
			$data=mysqli_fetch_assoc($admin->config->data);
			$title=$admin->scan_text_out($data['nom']);
			$rsm=$admin->scan_text_out($data['rsm']);
			$txt=$admin->html2math($data['txt']);
			?>
              <form method="post">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="exampleInputName">First name</label>
                        <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter Title Here" name="title" value="<?php echo $title;?>">
                      </div>
                      <div class="col-md-3 p-4">
                        <input name="updt" class="btn btn-warning text-white  " type="submit" value="Modifier"/>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row col-md-5">
                     <label for="rsm">Résumé </label>
                    <textarea id="rsm" class="form-control  text-center" name="rsm"><?php  echo $rsm;?></textarea
                    ></div>
                  </div>
                
                <div class="form-group">
                    <label for="detaill">Article</label>
                    <textarea class="form-control" id="editor" type="" aria-describedby="" placeholder="" name="link"><?php  echo $txt ;?></textarea>
                  </div>
                </form>
              </div>
            </div>




            <?php }?>
      </div>
      </div>
    </div>
    <!-- /.container-fluid-->
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


<script>
	initSample();
</script>
</body>

</html>
<?php }
?>