<?php
ob_start();
require_once('../load.php');
require_once(ABSPATH.cls.'/Zebra_Pagination.php' );
require_once('class/client.php' );
require_once('../class/image.php');
$picture=new Image();
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
			$config->query="SELECT * FROM image WHERE id in($deleted)";
			$config->pripare();
			$niveaus=$config->data;	
			$config->query="delete from image where id in($deleted)";
			$config->pripare();	
			
			if($config->pripare)
			{
			   while($deletethis=mysqli_fetch_assoc($niveaus))
				{
				if(file_exists($deletethis['url']))unlink($deletethis['url']);
				}
			}
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
  <title>Galerie</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
      <script src="vendor/jquery/jquery.min.js"></script>

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
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Galerie</li>
      </ol>
      <div class="card mb-3 ">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>New image</div>
            <div class="card-body">
            <form  enctype='multipart/form-data'  method='POST'>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6 "> <input type='file' id='file-1' class=' form-control' multiple name='image[]'></div>
                  <div class="col-md-3">
                  <input name='end' type='submit' class='btn btn-md float-right btn-success ' value='Add new '>
                  </div>
                </div>
              </div>
            </form>
             <?php 
 if(isset($_POST['end'] ))
	{
		
		if(isset($_FILES['image']['tmp_name']) and !empty($_FILES['image']['tmp_name']) and count($_FILES['image']['tmp_name'])<$picture->maxe and $_FILES['image']['tmp_name']!=NULL)
		{
			
			
			$pic_uploaded=$picture->upload($_FILES);
			
			if(count($pic_uploaded)>0)
			{
			echo "<ul class=' list-unstyled  list-inline'>";			
				foreach($pic_uploaded as $pic=>$url)
				{
					$url_pic="../".$picture->directory."/".$url;
					$config->query="INSERT INTO `image` (`id`, `url`,`admin`) VALUES (NULL, '".$url_pic."','".$ensignient['id']."');";
					$config->pripare();
					
					echo "<li class=''>
					<img class='img-responsive img-thumbnail' width='100px' hidden='100px' src='".$url_pic."' /></a></li>";	
				}
				echo "</ul>";
			}
			
			unset($_FILES); 
		}
		
	}
?>  
			</div>
            </div>
 
  
    <?php /*****************pagination ********************/
/* add 1) SQL_CALC_FOUND_ROWS *
/*     2) LIMIT ".(($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . "
/*     3) <?php //render the pagination links 
           $pagination->render(); ?>
*/
$pagination = new Zebra_Pagination();
$pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
$records_per_page = 20;
$begin=(($pagination->get_page() - 1) * $records_per_page);
$pas=$records_per_page; 
/******************************************/
$admin->config->query="SELECT SQL_CALC_FOUND_ROWS * FROM `image` ORDER BY (id) DESC LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . ";";
$admin->config->pripare();
$niveaus = $config->data;
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
          
    <div class="card mb-3">
        <div class="card-header  bg-dark text-white">
          <i class="fa fa-area-chart"></i>Exhibition</div>
         <div class="card-body bg-light text-left">
            <form method="post">
             <div class="d-flex align-items-center pt-3 py-1 my-3 text-white-50  rounded box-shadow bg-white">
                     <div class="col-md-6 mb-3">
                        <input class="btn btn-danger " name="delete" type='submit' value="Delete"/>
                     </div>
                     <div class="col-md-6 mb-3">
                       <div class="custom-control custom-checkbox" >
                         <input class="custom-control-input" type="checkbox" id="select_all" />
                         <label class="custom-control-label bg-transparent" for="select_all">Select all</label>
                       </div>
                       
                      </div>
              </div>
             <div class="d-flex align-items-center p-3 my-3 text-white-50  rounded box-shadow bg-white">
                 <div class="row listpic">
                <?php

                while($niveau=mysqli_fetch_assoc($niveaus))
        {
        echo '<div class="col-md-4">
                      <div class="card mb-4 box-shadow">
                       <div class="card-body ">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group ">
                              <input class=\'checkbox \' type=\'checkbox\' value='.$niveau["id"].' name=\'selected[]\' />
                            </div>
                          </div>
                        </div>
                        <img class="card-img-bottom img-responsive img-thumbnail" src="'.$niveau['url'].'">
                      </div>
                    </div>';	
        }
        ?>
                </div>
             </div>
            </form>
        </div>
        <div class="row pagination">
     <?php /* render the pagination links */ $pagination->render(); ?>
    </div>
      </div>
   
      </div>
   </div>
      
      
      
    </div>
    </div>
    
    
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your TicketDZ 2018</small>
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
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
  </div>
</body>

</html>
<?php }
?>