<?php
ob_start();
require_once('load.php');
require_once('class/client.php' );
require_once(ABSPATH.cls.'/Zebra_Pagination.php' );
	$visiteur = new client();
	


/*****************pagination ********************/
$pagination = new Zebra_Pagination();
$pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
$records_per_page = 1;
$begin=(($pagination->get_page() - 1) * $records_per_page);
$pas=$records_per_page; 
/******************************************/
$config->query="SELECT SQL_CALC_FOUND_ROWS * FROM `interface`  ORDER BY `id` DESC LIMIT " . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . "; ";
$config->pripare();
$my_annonce = $config->data;


/*****************pagination ********************/
$config->query="SELECT FOUND_ROWS() AS rows";
$config->pripare();
$rows =mysqli_fetch_assoc($config->data);
  // pass the total number of records to the pagination class
 $pagination->records($rows['rows']);
        // records per page
 $pagination->records_per_page($records_per_page);
/******************************************/

if(isset($_GET['project'])){
	$pg=(int)$visiteur->scan($_GET['project']);
	$config->query="SELECT count(*) as rows FROM `interface` WHERE id= '".$pg."'";
	$config->pripare();
 $nbr_pg =mysqli_fetch_assoc($config->data);
 if($nbr_pg['rows']==1)
 {
	 $config->query="SELECT * FROM `interface` WHERE id= '".$pg."'";
	 $config->pripare();
	$my_annonce = $config->data;
 }
	}	

?>	

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>الصدوق للإستثمار</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <!--Zebra pagination -->
<link rel='stylesheet' type='text/css' href='css/zebra_pagination.css'/>

</head>

<body>
  <!-- Page Content
    ================================================== -->
  <!-- Hero -->

  <section class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="">
        </div>
      </div>

      <div class="">
        <h1>
            مؤسسة الصدوق للاستثمار
          </h1>

        <p class="lead text-white">

تمنح شركتنا الفرصة لخريجي الجامعة الشباب وتجعلهم يتجمعون في نفس النشاط وتمنحهم فائدة في التواجد في قطاع نشاطهم

        </p>
        <a class="btn btn-full" href="#project">إبدأ الآن</a>
      </div>
    </div>

  </section>
  <!-- /Hero -->

  <!-- Header -->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!--<a href="index.html"><img src="img/logo-nav.png" alt="" title="" /></img></a> -->
        <!-- Uncomment below if you prefer to use a text image -->
       <h1><a href="index.html#hero">الصدوق</a></h1>
      </div>

      <nav id="nav-menu-container" x>
        <ul class="nav-menu" >
          <li><a href="index.php#about">الفكرة</a></li>
          <li><a href="index.php#features">مميزاتنا</a></li>
          <li><a href="index.php#portfolio">معلومات</a></li>
          <li><a href="index.php#team">الطابع القانوني</a></li>
          <li><a href="index.php#project">مشاريعنا</a></li>
          <li><a href="index.php#contact">اتصل بنا</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->

  <!-- About -->


    <section class="album py-5 bg-light" id="project">
    <div class="container">
      <h2 class="text-center fblue">
        المشاريع
        </h2>
        <?php 
			if($my_annonce)
			{
				while($row = mysqli_fetch_assoc($my_annonce))
				   {
					 	echo '
						<div class="row">
							<div class="col-md-12">
							  <div class="card mb-4 box-shadow">
							   <div class="card-header bg-info text-white text-center"><span class="display-4 ">'.$row["nom"].'</span></div>
								<div class="card-body"> '.$visiteur->math2html($row['txt']).'</div>
							  </div>
							</div>
                        </div>
						';
				   }
			}
		?>
      					  
        
        
      <div class="row"><?php /*if(!isset($_GET['pg'])){$pagination->render();} */?></div>    
    </div>
    
      </section>

  <!-- /Team -->
  <!-- @component: footer -->

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-title">اتصل بنا</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-4">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>15 شارع عبد الحميد ابن باديس<br>دائرة زمورة ولاية غليزان</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>arif.topo89@gmail.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>0556437579</p>
            </div>

          </div>
        </div>

        <div class="col-lg-5 col-md-8">
              <img class="img-thumbnail" src="img/position.PNG" width="1016" height="389" alt="">
        </div>

      </div>


    </div>
  </section>

  <footer class="site-footer">
    <div class="bottom">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-xs-12 text-lg-left text-center">
            <p class="copyright-text">

            </p>
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bell
              -->
             <a href="#">مؤسسة الصدوق للاستثمار</a>
             <ul class="unstyle">
                 <li><a href="https://paper.dropbox.com/doc/.docx-RQhKm00BytBjJHmmn9cCH" target='new_blank'>السيرة الذاتية لمسير المؤسسة</a></li>
                 <li><a href="https://paper.dropbox.com/doc/.docx-BtQTUHhco6dWZRJIacCiN" target='new_blank'>القوانين</a></li>
                 <li><a href="https://paper.dropbox.com/doc/.docx-M0b9lD6EJZFgNs979fW6l" target='new_blank'>نموذج عقد الاستثمار</a></li>
             </ul>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12 text-lg-right text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="index.html">الصدوق </a>
              </li>

              <li class="list-inline-item">
                <a href="#about">الفكرة</a>
              </li>

              <li class="list-inline-item">
                <a href="#features">مميزاتنا</a>
              </li>

              <li class="list-inline-item">
                <a href="#portfolio">معلومات</a>
              </li>

              <li class="list-inline-item">
                <a href="#team">الطابع القانوني</a>
              </li>

              <li class="list-inline-item">
                <a href="#contact">اتصل بنا</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </footer>
  <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>


  <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/tether/js/tether.min.js"></script>
  <script src="lib/stellar/stellar.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/easing/easing.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/parallax/parallax.js"></script>
  <script src="lib/lockfixed/lockfixed.min.js"></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>

  <script src="contactform/contactform.js"></script>

</body>
</html>
