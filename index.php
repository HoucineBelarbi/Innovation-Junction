<?php
ob_start();
require_once('load.php');
require_once('class/client.php' );
require_once(ABSPATH.cls.'/Zebra_Pagination.php' );
	$visiteur = new client();
	


/*****************pagination ********************/
$pagination = new Zebra_Pagination();
$pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
$records_per_page = 6;
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

if(isset($_GET['pg'])){
	$pg=addslashes((int)$visiteur->scan($_GET['pg']));
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
        <a class="btn btn-full" href="#about">إبدأ الآن</a>
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
       <h1><a href="#hero">الصدوق</a></h1>
      </div>

      <nav id="nav-menu-container" x>
        <ul class="nav-menu" >
          <li><a href="#about">الفكرة</a></li>
          <li><a href="#features">مميزاتنا</a></li>
          <li><a href="#portfolio">معلومات</a></li>
          <li><a href="#team">الطابع القانوني</a></li>
          <li><a href="#project">مشاريعنا</a></li>
          <li><a href="#contact">اتصل بنا</a></li>
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

  <section class="about" id="about">
    <div class="container text-center">
      <h2 class=" fblue">
         فرصة العمر
        </h2>

      <p class="lead">
        إذا كانت لديك فكرة أو مشروع تريد إنجازه فالمؤسسة في خدمتكم فقط أرسل نوع المهنة التي تمارسها كانت تجارية أو فلاحية أو صناعية مع إرسال سيرتك الذاتية وسجل السوابق القضائية.
      </p>

      <div class="row stats-row">
        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle py-5 ">
            <div class="h3 m-0 fblue">الهندسة الزراعي</div>
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
         <div class="circle pt-6 ">
            <div class="h3 m-0 fblue">الإقتصاد</div>
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
         <div class="circle py-5 ">
            <div class="h3 m-0 fblue">هندسة الكمبيوتر</div>
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle py-5 ">
            <div class="h3 m-0 fblue">الهندسة الصناعية</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /About -->
  <!-- Parallax -->

  <div class="block bg-primary block-pd-lg block-bg-overlay text-center img-fluid" data-bg-img="img/parallax-bg.jpg" data-settings='{"stellar-background-ratio": 0.6}' data-toggle="parallax-bg">
    <h2 class="featurette-heading">
     كن واحدا من افضل عملائنا
      </h2>

    <p class="lead">
       الصدوق المؤسسة للاستثمارات الإسلامية هي مؤسسة ذات طابع استثماري إسلامي تم إنشائها  للاستمارات في مختلف المعاملات الاقتصادية الغير الربوية.
    </p>
    <img alt="Bell - A perfect theme" class="gadgets-img hidden-md-down" src="img/pexels-photo-955447.jpeg">
  </div>
  <!-- /Parallax -->
  <!-- Features -->

  <section class="features" id="features">
    <div class="container">
      <h2 class="text-center">
          لماذا نتفوق على غيرنا
        </h2>
        <p class="text-center lead">إن مؤسسة الصدوق للاستثمارات الإسلامية تقوم بإنشاء مؤسسات اخرى والقيام بمجموعة من الارشادات تقنية وقانونية في شتى المجالات الاقتصادية (انشاء مؤسسات تجارية في مختلف المجالات الاقتصادية كالصناعة الغذائية مثلا او الاستثمار في المجال الفلاحي).</p>
      <div class="row">
        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">


          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Features -->
  <!-- Call to Action -->


  <!-- /Call to Action -->
  <!-- Portfolio -->

  <section class="portfolio " id="portfolio">
    <div class="container text-center">
      <h1 class="fblue">
          معلومات
        </h1>
      <p class="lead col-md-8 offset-md-2 col-lg-8 offset-lg-2">
          يكون مدة جمع الاستثمار من 6-8 أشهر وعندما يفوق نسبة المشروع 60 بالمائة تقوم المؤسسة بتطبيق المشروع.
ملاحظة: إذا مرت المدة أكثر من 6 أشهر والمشروع لم يفوق نسبته أكثر من 60 بالمئة فالمؤسسة ستقوم بإيقاف المشروع وتقوم بإرجاع المال.
قيمة الاستثمار تبدأ بمبلغ 25000دج فما فوق.

      </p>
    </div>

    <div class="portfolio-grid">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block ">
            <a href="#contact"><img class="img-thumbnail img-fluid"  src="img/harvest-grain-combine-arable-farming-163752.jpeg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    الهندسة الزراعية
                  </h3>

                  <p class="card-text">
                    كن واحد من عملائنا
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img class="img-thumbnail img-fluid" alt="" src="img/calculator-calculation-insurance-finance-53621.jpeg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    الإقتصاد
                  </h3>

                  <p class="card-text">
                    كن واحد من عملائنا
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img class="img-thumbnail img-fluid" alt="" src="img/pexels-photo-256297.jpeg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    الهندسة الصناعية
                  </h3>
                  <p class="card-text">
                    كن واحد من عملائنا
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img class="img-thumbnail img-fluid"  alt="" src="img/pexels-photo-461146.jpeg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    هندسة الكمبيوتر
                  </h3>

                  <p class="card-text">
                    كن واحد من عملائنا
                  </p>
                </div>
              </div></a>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- /Portfolio -->
  <!-- Team -->

  <section class="row portfolio mt-5 px-3 pb-4" id="team">
    <div class="container">
      <h2 class="text-center">
         الطابع القانوني
        </h2>
      <div class="row" >
           <div class="card text-center w-100 border p-3">
           <div class="body-card">
               <p class="card-text lead text-right  shadow p-3 mb-1 bg-white rounded ">إن مؤسسة الصدوق للاستثمارات الإسلامية تقوم بإنشاء مؤسسات اخرى والقيام بمجموعة من الارشادات تقنية وقانونية في شتى المجالات الاقتصادية (انشاء مؤسسات تجارية في مختلف المجالات الاقتصادية كالصناعة الغذائية مثلا او الاستثمار في المجال الفلاحي).</p>
               <p class="card-text lead text-right shadow p-3 mb-1 bg-white rounded ">إن مؤسسة ذات أسهم مسهلة عبارة عن مؤسسة تسهل الاستثمار دون عرقلة قانونية وإعطاء للمستثمر قوانين حسب للاستثمار الإسلامي. </p>
               <p class="card-text lead text-right  shadow p-3 mb-3 bg-white rounded ">لماذا الاستثمار في المجال الغذائي والفلاحي:</p>
               <p class="card-text lead text-right  shadow p-3 mb-5 bg-white rounded ">إن مختلف البنوك التي تتدعى أنها غير ربوية هو خطا لذلك أنشأت هذه المؤسسة حتى تغطى ما كانت تدعيه هذه البنوك فعندما تستثمر في مؤسسة الصدوق ستحس بتغير خاصة ومؤسسة الصدوق تهتم أكثر ما هو غذائي لأن الغداء غير الشرعي يضر بالصحة وخاصة عندما تقرأ قصص الصحابة كابى بكر الصديق رضي الله عنه لما أحس بالغثيان عندما شرب لبنا حراما لذلك فمؤسسة الصدوق تضمن لكم مائة بالمائة أنها غير ربوية ورابحة في الدنيا والآخرة وسيطمئن قلبك عندما تقوم بعملية الاستثمار في مؤسسة الصدوق واستهلاك هذه المنتوجات. </p>
               <div class="card-text lead pb-2  bg-info rounded col-md-7 offset-md-3"><span class="text-center text-white lead">عن عائشة رضي الله عنها قالت </span><br>
               <p class="bg-white p-5 mt-3 text-right text-danger font-italic font-weight-light">
: كان لأبي بكر غلام يخرج له الخراج، وكان أبو بكر يأكل من خراجه، فجاء يوما بشيء فأكل منه أبو بكر، فقال له الغلام: تدري ما هذا؟ فقال أبو بكر: وما هو؟ قال: كنت تكهنت لإنسان في الجاهلية وما أحسن الكهانة إلا أني خدعته، فلقيني فأعطاني بذلك، فهذا الذي اختلفا منه، فأدخل أبو بكر يده فقاء كل شيء في بطنه
</p>
<span class="text-right text-white lead">[البخاري (4/236)]</span>
</div>
      </div>
           </div>
      </div>
    </div>
  </section>

    <section class="album py-5 bg-light" id="project">
    <div class="container">
        <h2 class="text-center fblue">
        المشاريع
        </h2>
      <div class="row">  
			<?php if($my_annonce)
            {
			  
            while($row = mysqli_fetch_assoc($my_annonce))
               {
				$id=$visiteur->scan_text_out((int)$row['id']);
              $title=$visiteur->scan_text_out($row['nom']);
			  $rsm=$visiteur->scan_text_out($row['rsm']);
                echo "<div class=\"col-md-4\">
              <div class=\"card mb-4 box-shadow\">
			   <div class=\" card-header text-center bg-info text-white\">".$title."</div>
                <div class=\"card-body\">
                  <p class=\"card-text text-center\">".$rsm."</p>
                  <div class=\"d-flex justify-content-between align-items-center\">
                    <div class=\"btn-group\">
                     <button onClick=\"window.open('projects.php?project=".$id."')\" type=\"button\" class=\"btn btn-sm btn-outline-primary\">التفاصيل</button>
                        </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>";
               }
            }
               ?>

            


      </div>
          <a href="details.php" class="text-center flbue">
       ... المزيد
        </a>
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
