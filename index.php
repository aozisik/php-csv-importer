<?php include('php/config.php'); include('php/functions.php'); ?>
<html>
<head>
  <meta http-equiv="Content-type"  content="text/html;charset=UTF-8" />
  <link rel="stylesheet" href="public/css/green.css" media="screen" />
  <script type="text/javascript" language="javascript" src="public/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="public/js/import.js"></script>
  <title>Importer</title>
</head>
<body>
<div id="container">
  <h1>Import</h1>
  
  <div id="content">
    <div id="form1">
      <h3>CSV Dosyası</h3>
      <div class="pad">
        Bu dosyalar csv adlı klasörden seçilerek listelenir<br />
        <select id="csv_files">
        	<option value="">Seç</option>
        	<?php list_csv_files($csv_folder); ?></select><br />

        Ayraç<br />
        <input id="seperator" value=";" /><br />
        
				Sarıcı<br />
        <input id="wrapper" value="&quot;" /><br />
        
				Veritabanı Adı<br />
        <input id="database" placeholder="database" /><br />
        
				Kull. Adı<br />
        <input id="user" value="root" /><br />
        
				Şifre<br />
        <input id="pass" value="" /><br />                
        
				Tablo Adı<br />
        <input id="table" placeholder="table" /><br />                
				<br />
        
        <input type="button" value="Başla" id="start" />
      </div>
    </div>
    <div id="form2">
      <h3><span id="currently">Dosya Hazırlanıyor</span></h3>
      <img src="public/loading.gif" alt="" id="inprogress" /> <span id="description">CSV dosyası okunarak parçalara ayrılıyor.</span>
    </div>
    
    <div id="form3">
      <h3>İşlem Sürdürülüyor</h3>
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
    <small>CSV Import &copy; 2011 Jquery & PHP ile hazırlanan CSV import etme aracı</small>
  </div>

</body>
</html>