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
if(isset($_POST['add_class']))
{
	$title=$admin->scan_text($_POST['title']);
	$txt=$admin->html2math($_POST['link']);
	$rsm=$admin->scan_text($_POST['rsm']);

		$admin->config->query="INSERT INTO `interface` (`id`, `nom`,`txt`,`admin`,`rsm`) VALUES (NULL, '".$title."', '".$txt."', '".$ensignient['id']."', '".$rsm."');"; 

	$added=$admin->config->pripare();
	
	
}
if(isset($_POST['delete']))
{
	if(isset($_POST['selected']))
	{
		if(count($_POST['selected'])>=1)
		{
			foreach($_POST['selected'] as $key=>$val)
			{
				$delete["$key"]=$admin->scan($val);
					
			}
			$deleted=implode(' ,',$delete);
			$config->query="delete from interface where id in($deleted)";
			$config->pripare();
		}
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
  <title>Projetcs</title>
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
      <div class="card mb-3">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>New Project</div>
        <div class="card-body">

		<div class="row">
		<?php 
		if(isset($_POST['add_class']))
		{
			if($added==true)
			{
				echo "<p class=' col-12 alert alert-info  text-center'>success ".$_POST['title']." </p>"; 
			}
			else
			{
				echo '<p class=" col-12 alert alert-warning text-center">faild add </p>'; 
					}
				}
		?>
</div>
<div class="row">
          <form method="post">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="exampleInputName">Subject</label>
                    <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="write Title Here" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title'];?>">
                  </div>
                  <div class="col-md-3 p-4">
                    <input name="add_class" class="btn btn-primary  " type="submit" value="Add new project"/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row col-md-5">
                 <label for="rsm">Summary </label>
                <textarea id="rsm" class="form-control" name="rsm"><?php if(isset($_POST['rsm'])) echo $_POST['rsm'];?></textarea
                ></div>
              </div>
            
            <div class="form-group">
                <label for="detaill">The details</label>
                <textarea class="form-control" id="editor" type="" aria-describedby="" placeholder="" name="link"><?php if(isset($_POST['link'])) echo $_POST['link'];?></textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">              
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
        <div dir="" class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header bg-dark text-white">
              <i class="fa fa-pie-chart"></i>List of projects</div>
            <div class="card-body">
            <form action=" " method="post">
   
      		 <div class="form-group ml-2">
                <div class="form-row">
                    <input name="delete" class="btn btn-danger " type="submit" value="Delete"/>
                </div>
              </div>         
            
            
              	 <div class="table-responsive">
                 
              <?php 
				/*****************pagination ********************/
				/* add 1) SQL_CALC_FOUND_ROWS *
				/*     2) LIMIT ".(($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . "
				/*     3) <?php //render the pagination links 
						   $pagination->render(); ?>
				*/
				$pagination = new Zebra_Pagination();
				$pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
				$records_per_page = 30;
				$begin=(($pagination->get_page() - 1) * $records_per_page);
				$pas=$records_per_page; 
				/******************************************/
				$admin->config->query="SELECT SQL_CALC_FOUND_ROWS * FROM interface order by id desc LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . " ;";
				
				
				$admin->config->pripare();
				$cours = $config->data;
				
				/*****************pagination ********************/
				$config->query="SELECT FOUND_ROWS() AS rows";
				$config->pripare();
				$rows =mysqli_fetch_assoc($config->data);
				  // pass the total number of records to the pagination class
				 $pagination->records($rows['rows']);
						// records per page
				 $pagination->records_per_page($records_per_page);
				/******************************************/
				?>   
                 
            <table dir  class="table table-bordered table-hover" >
              <thead>
                <tr>
                 <th ><input class="checkbox" type="checkbox" id="select_all" /></th>
               	 <th >Subject</th>
                 <th >Modification</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>/</th>
               	 <th class="">Subject</th>
                 <th class="">Modification</th>
                </tr>
              </tfoot>
              <tbody>
              <!--afficher table -->
              <?php 
			    
				
			  while($cour=mysqli_fetch_assoc($cours))
				{
				$row_id=$admin->scan_text($cour['id']);
				$row_title=$admin->scan_text_out($cour['nom']);
				echo "
				<tr>
					<td><input class='checkbox' type='checkbox' value='".$row_id."' name='selected[]' /></td>
					<td><a href ='../projects.php?project=".$row_id."' target='new' >".$row_title."</a></td>
					<td><a href ='updt.php?prj=".$row_id."' target='new' >Modifier</a></td>
				</tr>";	
				}
				?>
              </tbody>
            </table>
          </div>
          	</form>
            </div>
            <div class="card-footer small text-muted"><?php $pagination->render();?></div>
          </div>
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