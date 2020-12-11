<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$where = "WHERE dataExclusao is null "; 

$dataCadastro = $_POST['dataCad1'];
if($dataCadastro!=''):
$where.=" AND dataCadastro >= '".Uteis::gravarData($dataCadastro)."' ";
endif;    

$dataCadastro2 = $_POST['dataCad2'];
if($dataCadastro2!=''):
$where.=" AND dataCadastro <= '".Uteis::gravarData($dataCadastro2)."' ";
endif;

$dataAprovacao = $_POST['dataApr1'];
if($dataAprovacao!=''):
$where.=" AND dataAprovacao >= '".Uteis::gravarData($dataAprovacao)."' ";
endif;

$dataAprovacao2 = $_POST['dataApr2'];
if($dataAprovacao2!=''):
$where.=" AND dataAprovacao <= '".Uteis::gravarData($dataAprovacao2)."' ";
endif;

$idIdioma = $_POST['idioma'];
if($idIdioma!=''):
$where.=" AND idioma_idIdioma = $idIdioma ";
endif;

$idGestor = $_POST['gestor'];
if($idGestor!=''):
$where.=" AND gestor_idGestor = $idGestor ";
endif;

$idStatusAprovacao = $_POST['status'];
if($idStatusAprovacao!=''):
$where.=" AND statusAprovacao_idStatusAprovacao = $idStatusAprovacao";
endif;

$Proposta = new Proposta();  
$prop = $Proposta->selectProposta($where);
if(count($prop)>0){  
  for($i=0;$i<count($prop);$i++):
    if(!in_array($prop[$i]['clientePj_idClientePj'], $idcliente)):
    if( $prop[$i]['clientePj_idClientePj'] ): 
        $idcliente[$i] = $prop[$i]['clientePj_idClientePj'];
    endif;
    endif;    
  endfor;
  $idclientes = implode(",", $idcliente);
  $where2 .= "WHERE idClientePj IN(".$idclientes.") order by razaoSocial ASC";

$cliente = new ClientePj(); 
$resp = $cliente->selectClientePj($where2);
for($i=0;$i<count($resp);$i++):
 $html .=  "<option value='".$resp[$i]['idClientePj']."'>".Uteis::resumir($resp[$i]['razaoSocial'])."</option>";
endfor;
echo $html;
}