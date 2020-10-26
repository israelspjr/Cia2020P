<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePf = $_GET['id'];
$Ocorrencia = new Ocorrencia();
error_reporting(E_ALL);
?>

 <div>
<fieldset>
<legend>
Follow-UP
</legend>
</fieldset>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/form/ocorrencia.php?idClientePf=".$idClientePf;?>', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/ocorrencia.php?idClientePf=".$idClientePf?>', '#div_ocorrencia');" /> </div>
    <div id="lista_ocorrencia" class="lista">
    <table id="tb_lista_Ocorrencia2" class="registros">
    <thead>
      <tr>
	  <th>Nome</th> 
            <th>Outra Pessoa </th>       
		<th>Data Contato</th>
		<th>Observação</th>
		<th>Data Retorno</th>
       <th> Funcionário </th> 
		<th>Status</th>
         <th></th>
        </tr>
    </thead>
    
      <?php 
	  	$caminhoAbrir= CAMINHO_CAD."clientePf/include/form/ocorrencia.php";
		$caminhoAtualizar=  CAMINHO_CAD."clientePf/include/resourceHTML/ocorrencia.php?id=".$idClientePf;
		$ondeAtualiza= "#div_ocorrencia";
//		$caminhoModulo = CAMINHO_CAD."clientePf/include/";	
	  
	  
	  
	  echo $Ocorrencia->selectOcorrenciaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, " AND T.clientePf_idClientePf = ".$idClientePf);?>
      
      <tfoot>
        <tr>
	  <th>Nome</th>
      <th>Outra Pessoa </th>        
		<th>Data Contato</th>
		<th>Observação</th>
		<th>Data Retorno</th>
        <th> Funcionário </th>
		<th>Status</th>
        <th></th>
        </tr>
        </tfoot>
      </table>
      </div>
      
       <script>
	   tabelaDataTable('tb_lista_Ocorrencia2', 'simples');
</script> 