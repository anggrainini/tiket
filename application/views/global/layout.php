<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
       <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <!--content header -->
  <div class="navbar-wrapper">
      <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
              <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo base_url();?>web/home">Maguwoharjo Stadium</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url();?>web/home">Home</a></li>
                <li class="active"><a href="<?php echo base_url();?>web/schedule">Schedule</a></li>
                <li class="active"><a href="<?php echo base_url();?>web/Stadium">Stadium</a></li>
                <li class="active"><a href="<?php echo base_url();?>web/guestbook">Guestbook</a></li>
                <li class="active"><a href="<?php echo base_url();?>web/about">About Us</a></li>
                <li class="active"><a href="<?php echo base_url();?>web/Log">Login/Register</a></li>
              </ul>
              </div>
          </div>
      </nav>
      </div>
      </div>


  <!--content main -->
       <?php echo $content; ?>
  <!--content footer -->
      
      <footer class="footer-distributed">

      <div class="footer-left">

        <h3>Maguwoharjo International Stadium</h3>

        <p class="footer-links">
          <a href="<?php echo base_url();?>web/home">Home</a>
          ·
          <a href="<?php echo base_url();?>web/schedule">Schedule</a>
          ·
          <a href="<?php echo base_url();?>web/stadium">Stadium</a>
          ·
          <a href="<?php echo base_url();?>web/guestbook">Guestbook</a>
          .
          <a href="<?php echo base_url();?>web/About">About Us</a>
        </p>

        <p class="footer-company-name">Maguwoharjo International Stadium &copy; 2015</p>
      </div>

      <div class="footer-center">

        <div>
          <i class="glyphicon glyphicon-map-marker"></i>
          <p>Jl.Raya Stadion Maguwogarjo No. 1,</p>
          <p>Maguwoharjo, Depok, Sleman, Yogyakarta, Indonesia</p>
        </div>

        <div>
          <i class="glyphicon glyphicon-earphone"></i>
          <p>+62 274 888777</p>
        </div>

        <div>
          <i class="glyphicon glyphicon-envelope"></i>
          <p><a href="mailto:support@maguwoharjo-stadium.com">support@maguwoharjo-stadium.com</a></p>
        </div>

      </div>
      

    </footer>
  <!-- Bootstrap core JavaScript
  
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>