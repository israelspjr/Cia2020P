<?php
class Busca extends Database{
 
    function __construct() {
        parent::__construct();    
    }  
    function __destruct() {
        parent::__destruct();
    }
     
   function Buscar_nome($tabela, $campo , $valor, $where = ""){
       mysqli_set_charset('utf8'); 
       $sql = "SELECT SQL_CACHE * FROM ".$tabela." WHERE ".$where.$campo." LIKE '%$valor%' limit 20";
       $result = $this->executeQuery($sql);       
       return $result;            
   }   
   
    function Buscar_nome_email($valor){
       mysqli_set_charset('utf8'); 
       $sql = "SELECT SQL_CACHE nome FROM clientePf as CPF
	   INNER JOIN enderecoVirtual AS E on E.clientePf_idClientePf = CPF.idClientePf
	   WHERE E.valor LIKE '%$valor%' limit 20";
	//   echo $sql;
       $result = $this->executeQuery($sql);       
       return $result;            
   }
   
   function Buscar_professor_email($valor){
       mysqli_set_charset('utf8'); 
       $sql = "SELECT SQL_CACHE nome FROM professor as P
	   INNER JOIN enderecoVirtual AS E on E.professor_idProfessor = P.idProfessor
	   WHERE E.valor LIKE '%$valor%' limit 20";
//	   echo $sql;
       $result = $this->executeQuery($sql);       
       return $result;            
   }
      
   
   function Buscar_nome_cpf($valor){
       mysqli_set_charset('utf8'); 
      $sql = "SELECT SQL_CACHE nome FROM clientePf as CPF
	  WHERE documentoUnico LIKE '%$valor%' limit 20";
       $result = $this->executeQuery($sql);       
       return $result;            
   }   
   
    function Buscar_professor_cpf($valor){
       mysqli_set_charset('utf8'); 
      $sql = "SELECT SQL_CACHE nome FROM professor as P
	  WHERE documentoUnico LIKE '%$valor%' limit 20";
       $result = $this->executeQuery($sql);       
       return $result;            
   }  
   
    function Buscar_aluno_telefone($valor){
       mysqli_set_charset('utf8'); 
      $sql = "SELECT SQL_CACHE nome FROM clientePf as CPF
	  INNER JOIN telefone AS T on CPF.idClientePf = T.clientePf_IdClientePf
	  WHERE numero LIKE '%$valor%' AND T.clientePf_idClientePf IS NOT NULL group by T.clientePf_idClientePf";
//	  echo $sql;
       $result = $this->executeQuery($sql);       
       return $result;            
   }   
    
   
   function Buscar_professor_telefone($valor){
       mysqli_set_charset('utf8'); 
      $sql = "SELECT SQL_CACHE nome FROM professor as P
	  INNER JOIN telefone AS T on P.idProfessor = T.professor_idProfessor
	  WHERE numero LIKE '%$valor%' limit 1";
       $result = $this->executeQuery($sql);       
       return $result;            
   }   
   
}