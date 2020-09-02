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

<!-- data Tables -->
<link rel="stylesheet" href="<?php echo CAMINHO_CFG?>css/table_jui.css" />
<script src="<?php echo CAMINHO_CFG?>js/jquery.min.js" language="javascript" type="text/javascript"></script>
<!-- data Tables -->
<script src="<?php echo CAMINHO_CFG?>js/jquery.dataTables.min.js" language="javascript" type="text/javascript" ></script>
<fieldset>
  <legend>Configurações de sistema</legend>


<div class="lista">
  <table id="tb_lista_config" class="registros">
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
tabelaDataTable('tb_lista_acervo');
</script> 
