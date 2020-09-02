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

<!-- data Tables 
<link rel="stylesheet" href="<?php echo CAMINHO_CFG?>css/table_jui.css" />-->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

<script src="https://code.jquery.com/jquery-3.5.1.js" language="javascript" type="text/javascript"></script>

<!-- data Tables -->

<script src="<?php echo CAMINHO_CFG?>DataTables/datatables.js" language="javascript" type="text/javascript" ></script>

<!-- Funções uteis 
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" language="javascript" type="text/javascript"></script>-->

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
$(document).ready( function () {
    $('#tb_lista_config').DataTable();
} );
//tabelaDataTable('tb_lista_acervo');
</script> 
