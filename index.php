<?php include('php/config.php'); include('php/functions.php'); ?>
<html>
<head>
  <meta http-equiv="Content-type"  content="text/html;charset=UTF-8" />
  <link rel="stylesheet" href="assets/css/green.css" media="screen" />
  <script type="text/javascript" language="javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="assets/js/import.js"></script>
  <title>CSV Import</title>
</head>
<body>
<div id="container">
  <h1>CSV Import</h1>
  
  <div id="content">
    <div id="form1">
      <h3>CSV File</h3>
      <div class="pad">
        These files come from ./csv folder<br />
        <select id="csv_files">
        	<option value="">Seç</option>
        	<?php list_csv_files(CSV_FOLDER); ?></select><br />

        Seperator<br />
        <input id="seperator" value=";" /><br />
        
				Enclosing<br />
        <input id="wrapper" value="&quot;" /><br />
        
				Database Name<br />
        <input id="database" value="<?php echo MYSQL_DB; ?>" /><br />
        
				DB User<br />
        <input id="user" value="<?php echo MYSQL_USER; ?>" /><br />
        
				DB Pass<br />
        <input id="pass" value="<?php echo MYSQL_PASS; ?>" /><br />                
        
				DB Table (will be created if it doesn't exist)<br />
        <input id="table" value="<?php echo DEFAULT_TABLE_NAME; ?>" /><br />                
				<br />
        
        <input type="button" value="Başla" id="start" />
      </div>
    </div>
    <div id="form2">
      <h3><span id="currently">Preparing the file</span></h3>
      <img src="assets/loading.gif" alt="" id="inprogress" /> <span id="description">CSV file is being read and split into chunks.</span>
    </div>
    
    <div id="form3">
      <h3>Processing...</h3>
      <div class="pad">
        <div id="progressbar"><div id="progress">1%</span></div><br />
        <div id="progresstext"></div>
      </div>
    	</div>
    
  	</div>
  	<div style="clear:both"></div>
  </div>
  
  <br /><br />
  <div id="footer">
    <small>CSV Import &copy; 2011 Jquery & PHP CSV Importer script</small><br />
    <small><a href="https://github.com/aozisik/php-csv-importer">CSV Import on Github</a></small>
  </div>

</body>
</html>