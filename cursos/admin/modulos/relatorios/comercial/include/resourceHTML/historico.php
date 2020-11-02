<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Ocorrencia = new Ocorrencia();

$idClientePf = $_REQUEST['idClientePf'];
?>
<div id="cadastro_historico" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="modulos_historico" class="conteudo_nivel">
    <div id="div_cadastro_historico" class="div_aba_interna">
<fieldset>
<legend>
Histórico de ocorrências
</legend>
</fieldset>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onClick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/form/ocorrencia.php?idClientePf=".$idClientePf;?>', '<?php echo CAMINHO_RELAT."comercial/include/resourceHTML/historico.php?idClientePf=".$idClientePf?>', '#cadastro_historico');" /> </div>
    <div id="lista_ocorrencia" class="lista">
    <table id="tb_lista_Ocorrencia" class="registros">
    <thead>
      <tr>
	  <th>Nome</th>        
		<th>Data Contato</th>
		<th>Observação</th>
		<th>Data Retorno</th>
		<th>status</th>
        </tr>
    </thead>
      <?php 
//	  	$caminhoAbrir= CAMINHO_CAD."clientePf/include/form/ocorrencia.php";
//		$caminhoAtualizar=  CAMINHO_CAD."clientePf/include/resourceHTML/historico.php?idClientePf=".$idClientePf;
		$ondeAtualiza= "#modulos_historico";
//		$caminhoModulo = CAMINHO_CAD."clientePf/include/";	
	  
	  
	  
	  echo $Ocorrencia->selectOcorrenciaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, " AND T.clientePf_idClientePf = ".$idClientePf);?>
      </table>
      </div>
    </div>
</div>
</div>


 <script>
eventDestacar(1);
//tabelaDataTable('tb_lista_historico', 'simples');
tabelaDataTable('tb_lista_Ocorrencia', 'simples');
</script> 

