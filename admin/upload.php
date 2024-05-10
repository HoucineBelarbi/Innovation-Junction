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
if(isset($_POST['add_class']))
{
	
	$_POST['title']=$admin->scan_html($_POST['title']);
	$_POST['niveau']=$admin->scan_text($_POST['niveau']);
	
	$admin->config->query="INSERT INTO `news` (`id`, `txt`,`date_add`,`admin`,`niveau`) VALUES (NULL, '".$_POST['title']."',now(),'".$ensignient['id']."','".$_POST['niveau']."');";
	

	$admin->config->pripare();
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
  <?php echo $header_ad;   ?>
  
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

<body>
<div class="container">
<?php include('include/header.php');?><!-- /.end nav -->


<div class="container-fluid">
<!--<marquee direction="right" class=" row label label-success size-18 center-block padding-haut">
<ul  class="list-inline">
<li class="item">تعلن الجمعية عن افتتاح اولمبياد العلمية في ولاية غليزان جميع الشعب <a href="../include/register.php" class="blon">للتسجيل اضغط هنا</a></li>
<li class="item">تعلن الجمعية عن افتتاح اولمبياد العلمية في ولاية غليزان جميع الشعب <a href="#" class="blon">للتسجيل اضغط هنا</a></li>
</ul>
</marquee> -->

<section class="row col-xs-offset-1">
<h1 class="center-block text-center margin-bottom">مركز رفع الصور</h1>

<table class="table table-responsive margin-bottom table-condensed table-striped ">


    <td> 
      <form enctype='multipart/form-data'  method='POST'>
    <div class='form-group '>
    	<input type='file' id='file-1' class='file' multiple name='image[]'>
    </div>
<input name='end' type='submit' class='btn btn-md center-block btn-success' value='Ajouter Les Photos '>
</form>                               
 <?php 
 if(isset($_POST['end'] ))
	{
		
		if(isset($_FILES['image']['tmp_name']) and !empty($_FILES['image']['tmp_name']) and count($_FILES['image']['tmp_name'])<$picture->maxe and $_FILES['image']['tmp_name']!=NULL)
		{
			
			
			$pic_uploaded=$picture->upload($_FILES);
			
			if(count($pic_uploaded)>0)
			{
				echo "uploaded >0";
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


</td>



</tr>
<form class=" form-group center-block" method="post" >


</form>
</table>

</section>

<section class="row col-xs-offset-1">
<h1 class="center-block text-center margin-bottom">معرض الصور</h1>


<form class=" form-group center-block" method="post">
<input class="btn btn-danger btn-sm" name="delete" type='submit' value="حذف"/>
<table class="table table-responsive margin-bottom  ">
<tr><th><input class="checkbox" type="checkbox" id="select_all" /></th><th class="text-center">الصور</th></tr>
</table>
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
 <div class="row">
 <?php 

while($niveau=mysqli_fetch_assoc($niveaus))
{
echo "
<div class='col-md-3 col-lg-3'>
<span class='label '><input class='checkbox' type='checkbox' value='".$niveau['id']."' name='selected[]' /></span>
<img class='img-responsive img-thumbnail' src='".$niveau['url']."' />
</div>";	
}
?>

 </div>                            
<?php 
/* render the pagination links */ 
$pagination->render(); ?>
</section>



</div>


<section class="row">
<div dir="ltr" class=" center-block margin-bottom">
<ul class="list-inline">
<li class="item"><a href="#">Contact</a></li>
<li class="item"><a href="#">Adress: </a></li>
<li class="item"><a href="#">Telephone: </a></li>
<li class="item"><a href="#">Fax: </a></li>
</ul>
</div>
</section>

</div>

</body>
</html>
<?php }
?>