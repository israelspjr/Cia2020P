<?php
//$pgprof = true;
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/padrao.php");

$Configuracoes = new Configuracoes();
ini_set("display_errors", 1);

$config = $Configuracoes->selectConfig();

$array = array("+", "-", " ");

$zap = str_replace($array, "", $config[0]['whatsApp']);
//echo "<pre>";
//var_dump($config);

session_start(); 
session_destroy();
?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema Cursos - <?php echo $config[0]['nomeEmpresa'];?></title>
<link rel="shortcut icon" href="images/_favicon.ico">
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php"); ?>
<style>
	

	body{
		background-image: url(images/bcg.jpg);
		width: auto;
		height: auto;
		background-attachment: fixed;
		background-size: cover;
		margin: 0px auto !important;
	    max-width: 1200px !important;
	    padding: 0px !important;
	}

	.header{
		background-color:transparent;
		border-bottom: 5px #ff6e15 solid;
	}

	.logo {
	    max-width: 250px;
		padding: 10px;
	}
	
	.footer {
	    font: 13px verdana,tahoma,sans-serif;
		margin-top: 120px;
	}


 </style>
</head>

<body>
	<div class="header">
 			 <center> <img src="images/<?php echo $config[0]['logo'];?>" alt="logo" class="logo"/></center>
	</div>
     
    <div>
           <!-- COLUNA 1 -->
            	<div class="c1">
            		<center> <a href="/cursos/portais/login.php?app=1"> <img src="images/icon.png" class="bot"> </a></center> 
            	</div>
      	
           <!-- COLUNA 2 -->
            	<div class="c2">
            		<center> <a href="/cursos/mobile/professor/login.php"> <img src="images/iconprof.png" class="bot"> </a></center> 
            	</div>
            	
           <!-- COLUNA 3 -->
	           	<div class="c3">
            		<center> <a href="/cursos/admin/"> <img src="images/iconadm.png" class="bot"> </a></center> 
            	</div>

           <!-- COLUNA 1 --4-->
            	<div class="c4">
            		<center> <a href="/cursos/mobile/rh/login.php"> <img src="images/iconrh.png" class="bot"> </a></center> 
            	</div>
 </div>
 <div style="padding-top:100px;">
 
 </div>
    <div class="footer" width="100%">
		   	<div class="footer1C">
	    		<center> <a href="https://api.whatsapp.com/send?phone=<?php echo $config[0]['whatsApp'];?>&amp;text=Dúvida Geral: " rel="noopener noreferrer"> <div class="zap23"><img src="images/zap23.png" class="ficons1"><span><?php echo $config[0]['whatsApp'];?></span></div> </a></center> 
		   	</div>

    	   	<div class="footer1C">
		    	<center> <div class="emailIndex"> <a href="mailto:<?php echo $config[0]['email'];?>"> <img src="images/email.png" class="ficons2"> <span><?php echo $config[0]['email'];?></span></div></a></center> 
	    	</div>
 

   <div class="site">
	   <a href="https://<?php echo $config[0]['site'];?>" target="_blank" >  <?php echo $config[0]['site'];?> </a> <br> <br>
   </div>
</body>
</html>



