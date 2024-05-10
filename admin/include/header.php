<nav class="navbar navbar-default bg-noir">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">الرئيسية</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php 
		if(isset($_SESSION['email_ad']))
		{
		  echo "
		  <li><a href='interface.php'>الواجهة<span class='sr-only'>(current)</span></a></li>
		  <li><a href='news.php'>الاخبار اليومية <span class='sr-only'>(current)</span></a></li>
		  <li><a href='lesson.php'>الدروس المكتوبة <span class='sr-only'>(current)</span></a></li>
		  <li><a href='upload.php'>معرض الصور <span class='sr-only'>(current)</span></a></li>
		  <li><a href='annonces.php'>النشاطات و المسابقات <span class='sr-only'>(current)</span></a></li>
		  <li><a href='new_class.php'>الاقسام <span class='sr-only'>(current)</span></a></li>
		  <li><a href='module.php'>المواد <span class='sr-only'>(current)</span></a></li>
		   <li><a href='tub.php'>دروس مرئية <span class='sr-only'>(current)</span></a></li>
		  <li><a href='logout.php'>تسجيل خروج <span class='sr-only'>(current)</span></a></li>
		  ";
		}
		else 
		{
			echo "
			<li><a href='login.php'>الدخول <span class='sr-only'>(current)</span></a></li>
			";

		}
		?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!-- /.end nav -->
