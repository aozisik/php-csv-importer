var piece_count = 0;
var pieces_completed = 1;
var line_count = 0;

function ratio(a, b, c)
{
  if(a == 0) return 0;
  return (b*c)/a;
}

function update_progress()
{
  d = ratio(piece_count, pieces_completed, 300);
  percent = ratio(300, d, 100);
  p = Math.round(percent);
  $('#progress').css('width', d).html(p + '%');
}

function process_tmp()
{
  $.getJSON('process.php', function(JSON)
  {
    if(pieces_completed != piece_count)
    {                   
      pieces_completed = pieces_completed + 1;
      update_progress();      
      process_tmp();  
    }
    else
    {
      $('#progress').css('width', '0').html('');
      $('#progresstext').html('SQL dosyaları veritabanına aktarılıyor.');
      pieces_completed = 1;
      process_sql();
    }
  });  
}

function process_sql()
{
  $.getJSON('run_sql.php', function(JSON)
  {  
    if(pieces_completed != piece_count)
    {                   
      pieces_completed = pieces_completed + 1;
      update_progress();      
      process_sql();  
    }
    else
    {
      $('#inprogress').hide();
      $('#currently').html('Tamamlandı');
      $('#description').html('İşlem başarıyla tamamlandı. ' +line_count+' satır veritabanına aktarıldı.');
      $('#form3').slideUp(function(){$('#form2').slideDown()});
    }    
  });
}

function get_piece_count()           
{
  $.getJSON('get_piece_count.php', function(JSON)
  {
    $('#currently').html('CSV Parçaları');
    $('#description').html('CSV dosyası ' + JSON + ' parçaya bölündü. Az sonra bu parçalar işlenmeye başlayacak.');
    
    piece_count = JSON;
    
    $('#form2').slideUp(function(){$('#form3').slideDown()});
    
    $('#progresstext').html('SQL dosyaları oluşturuluyor.');
    process_tmp();
  });
}

$(document).ready(function()
{
  
  $('#start').click(function()
  {        
  	var csv_file = $('#csv_files').val();
  	var seperator = $('#seperator').val();
  	var wrapper = $('#wrapper').val();
  	var database = $('#database').val();
  	var user = $('#user').val();
  	var pass = $('#pass').val();
  	var table = $('#table').val();
  	
  	var errors = false;
  	
  	if(csv_file == undefined || csv_file == '')
  	{
  		errors = true;
  		$('#csv_files').addClass('error_borders');
  	}

  	if(seperator == undefined || seperator == '')
  	{
  		errors = true;
  		$('#seperator').addClass('error_borders');
  	}  	
  	
  	if(database == undefined || database == '')
  	{
  		errors = true;
  		$('#database').addClass('error_borders');  		
  	}
  	
  	if(user == undefined || user == '')
  	{
  		errors = true;
  		$('#user').addClass('error_borders');  		
  	}

  	
  	if(table == undefined || table == '')
  	{
  		errors = true;
  		$('#table').addClass('error_borders');  		
  	}    	 	
  	
  	if(errors == true)
  		return;
  	                                
    $('#form1').slideUp(function(){$('#form2').slideDown()});
    
    var filename = $('#csv_files').val();
    
    var build_link = 'prepare_file.php?name=' + filename + '&seperator=' + seperator + '&wrapper=' + wrapper + '&database=' + database + '&user=' + user + '&pass='  + pass + '&table=' + table;  
    alert(build_link);
    $.getJSON(build_link, function(JSON)
    {
      line_count = JSON;
      $('#currently').html('Bilgi Alındı');
      $('#description').html(JSON + ' satır bulundu. CSV dosyası parçalara ayrıldı.');
      get_piece_count();
    });
  });

});
  