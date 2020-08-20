<?php
$pgprof = true;
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/padrao.php");

$Configuracoes = new Configuracoes();
ini_set("display_errors", 1);

session_start(); 
session_destroy();
?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema Cursos - <?php echo $Configuracoes->selectConfig()?></title>
<link rel="shortcut icon" href="images/_favicon.ico">
<style>
	.t1{
		border-bottom: 5px #ff6e15 solid;
		border-right: 3px #fff solid;
		border-left: 3px #fff solid;
		-webkit-box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31); 
		box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31);
	}

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

	.bot{
		max-width: 250px;
		transform: scale(0.5);
    	transition: 0.5s;
	}

	.bot:hover{
		max-width: 250px;
		transform: scale(0.8);
    	transition: 0.9s;
	}
	
	@media (max-width:767px) {
	.c1{
		width: 49%;
	}
	.c2{
		width: 49%;
	}
	
	.c2:hover {
		background-position: bottom;
    	background-size: auto;	
	}
	
	.c3{
		width: 50%;
	}
	.c4{
		width: 48%;
	}	
	.footer1C {
		width:100%;
		padding-top:20px;
		float:left;
	}
	}
	
	@media (min-width:768px) {
	.c1{
		width: 25%;
	}
	.c2{
		width: 25%;
	}
	
	.c3{
		width: 25%;
	}
	.c4{
		width: 24%;
	}
	.footer1C {
		width:50%;
		padding-top:20px;
		float:left;
	}	
	}
	.c1{
		
		height:500px;
		background-image: url(images/c1.jpg);
		-webkit-transition: background 1s ease-in-out;
   		-moz-transition: background 1s ease-in-out;
    	-o-transition: background 1s ease-in-out;
    	transition: background 1s ease-in-out;
		border-right: 3px #fff solid;
		float:left;
	}

	.c1:hover{
		background-image: url(images/c1h.jpg);
	 }

	.c2{
		
		height:500px;
		background-image: url(images/c2.jpg);
	    -webkit-transition: background 1s ease-in-out;
        -moz-transition: background 1s ease-in-out;
        -o-transition: background 1s ease-in-out;
        transition: background 1s ease-in-out;
		border-right: 3px #fff solid;
		float:left;
	}

	.c2:hover{				
		background-image: url(images/c2h.jpg);
	}

	.c3{
		
		height:500px;
		background-image: url(images/c3.jpg);
	 	 -webkit-transition: background 1s ease-in-out;
   		 -moz-transition: background 1s ease-in-out;
   		 -o-transition: background 1s ease-in-out;
    	transition: background 1s ease-in-out;
		border-right: 3px #fff solid;
		float:left;
	}

	.c3:hover{
		background-image: url(images/c3h.jpg);
	}

	.c4{
		
		height:500px;
		background-image: url(images/c4.jpg);
		-webkit-transition: background 1s ease-in-out;
    	-moz-transition: background 1s ease-in-out;
    	-o-transition: background 1s ease-in-out;
    	transition: background 1s ease-in-out;
		float:left;
	}

	.c4:hover{
	    background-image: url(images/c4h.jpg);
	}

	.footer {
	    font: 13px verdana,tahoma,sans-serif;
		margin-top: 120px;
	}

	.ficons1{
        background: rgb(222,58,76);
		background: linear-gradient(90deg, rgba(222,58,76,1) 0%, rgba(132,40,107,1) 46%); 
		-webkit-box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31); 
		box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31);
		border-radius: 70px;
		max-width: 400px;
	}

	.ficons2{
        background: rgb(132,40,107);
		background: -webkit-linear-gradient(left, rgba(132,40,107,1) 0%, rgba(255,110,21,1) 50%);
		background: -o-linear-gradient(left, rgba(132,40,107,1) 0%, rgba(255,110,21,1) 50%);
		background: linear-gradient(to right, rgba(132,40,107,1) 0%, rgba(255,110,21,1) 50%); 
		-webkit-box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31); 
		box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31);
		border-radius: 70px;
		max-width: 400px;
	}

	.ficons2:hover{
		transform: scale(1.1);
    	transition: 0.5s;
	}
	
	.ficons1:hover{
		transform: scale(1.1);
    	transition: 0.5s;
	}

	.site a{
		font-size: 10px;
		color: #fff;
		background-color: transparent;
		padding: 12px; 
		border-radius: 15px;
		-webkit-box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31); 
		box-shadow: 0px 10px 13px -7px #000000, 10px -2px 26px 1px rgba(0,0,0,0.31);
	}

	.site {
		font-weight: bold;
		text-align: center;
	    margin-top: 40px;
	}
 </style>
</head>

<body>
	<div class="header">
 			 <center> <img src="images/logo3.png" alt="logo" class="logo"/></center>
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
	    		<center> <a href="https://api.whatsapp.com/send?phone=5511982044234&amp;text=Dúvida Geral: " rel="noopener noreferrer"> <img src="images/whats.png" class="ficons1"> </a></center> 
		   	</div>

    	   	<div class="footer1C">
		    	<center>  <a href="mailto:atendimento@companhiadeidiomas.com.br "> <img src="images/emaill.png" class="ficons2"> </a></center> 
	    	</div>
    </div>
 

   <div class="site">
	   <a href="https://www.companhiadeidiomas.com.br" target="_blank" >  WWW.COMPANHIADEIDIOMAS.COM.BR </a> <br> <br>
   </div>
</body>
</html>



