<!DOCTYPE HTML>
<html>

<head>
  <title>dbNINCA: Network from INflammation to CAncer</title>
  <meta name="description" content="" />
  <meta name="keywords" content="bioinformatics, database" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('style/style.css')?>" />
  <script src="<?php echo base_url('script/jquery-1.10.2.min.js')?>"></script>
</head>

<body>
  <div id="main">
    <!-- begin header -->
    <div id="header">
      <!-- begin logo --> 
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
           <a href="<?php echo base_url("/"); ?>"><img src="<?php echo base_url('images/logo.png')?>"/></a>
        </div>
      </div>
      <!-- end logo -->

      <!-- begin menubar -->
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="<?php echo base_url("/"); ?>">Home / Search</a></li>
          <li><a href="<?php echo base_url("/browser"); ?>">Browse</a></li>
          <li><a href="<?php echo base_url("/statistics"); ?>">Statistics</a></li>
          <li><a href="<?php echo base_url("/download"); ?>">Download</a></li>
          <li><a href="<?php echo base_url("/help"); ?>">Help</a></li>
        </ul>
      </div>
      <!-- end menubar -->
    </div>
    <!-- end header -->

    <div id="content_header"></div>
    <!-- begin site_content -->
    <div id="site_content">