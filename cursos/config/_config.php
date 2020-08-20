<?php
header('Content-type: text/html; charset=utf-8');

define("EMPRESA", "LINUX");

error_reporting(0
  //E_ALL
 // E_ERROR | E_PARSE
  //E_ERROR | E_PARSE | E_WARNING
);
  
   //////////////////////////////BANCO////////////////////////////// 
  define("DATABASE_SERVER", "132.148.146.94");
  define("DATABASE_USER", "sistemac_user");
  define("DATABASE_PASS", "cia2015@@");
  define("DATABASE_DB", "sistemac_bd");
      
  //////////////////////////////EMAIL////////////////////////////// 
  define("HOST", "smtp.companhiadosidiomas.com.br");
  define("USERNAME", "smtp");
  define("PASSWORD", "smtp2004");
  define("FROMNAME", "Companhia de Idiomas - favor não responder este email");

  ////////////////////////////////ENDERECO DEFAULT//////////////////////////  
  define("ID_PAIS", 33);
  define("ID_CIDADE", 9422);
  define("ID_UF", 26);
    //endereco padrao 
  define("ENDERECO", "São Paulo - SP");   

define("EMAIL_ADM", "israel@companhiadeidiomas.com.br");

