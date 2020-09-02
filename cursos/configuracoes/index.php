<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/padrao.php");
$Configuracoes = new Configuracoes();

$ondeAtualiza = "#centro";

if( isset($_REQUEST["tr"]) ){
  
  $arrayRetorno = array();
  
  $idAcervo = $_REQUEST["idAcervo"];
  $ordem = $_REQUEST["ordem"];  
  
  $arrayRetorno["updateTr"] = $Configuracoes->selectConfigTr();
  $arrayRetorno["tabela"] = "#tb_lista_config";
  $arrayRetorno["ordem"] = $ordem;
  
  echo json_encode($arrayRetorno);
  exit;   
}
?>

<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css.php"); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js.php"); ?>

<fieldset>
  <legend>Configurações de sistema</legend>


<div class="lista">
  <table id="tb_lista_config" class="display">
    <thead>
      <tr>
        <th>Nome da empresa</th>
        <th>Logo</th>
        <th>WhatsApp</th>
        <th>Email</th>        
        <th>Site</th>
        <th>Rodapé</th>  
        <th>Cabeçalho</th>                        
      </tr>
    </thead>
    <tbody>
      <?php            
        echo $Configuracoes->selectConfigTr($where);
      ?>
    </tbody>
    <tfoot>
      <tr>       
         <th>Nome da empresa</th>
        <th>Logo</th>
        <th>WhatsApp</th>
        <th>Email</th>        
        <th>Site</th>
        <th>Rodapé</th>  
        <th>Cabeçalho</th>       </tr>
    </tfoot>
  </table>
</div>
</fieldset>
<script>
/*$(document).ready( function () {
    $('#tb_lista_config').DataTable();
} );*/
tabelaDataTable('tb_lista_config');
</script> 
