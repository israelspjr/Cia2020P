<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultado.class.php");

$MedicaoResultado = new MedicaoResultado();

?>
<div id="cadastro_MedicaoResultado" class="">

<fieldset>
  <legend>Medição Resultado</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/medicaoresultado/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/medicaoresultado/index.php";?>', '#cadastro_MedicaoResultado');" /> </div>
<div class="lista"><table id="tb_lista_MedicaoResultado" class="registros">
    <thead>
      <tr>
	  <th>idMedicaoResultado</th><th>Medição</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/medicaoresultado/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/medicaoresultado/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/medicaoresultado/";		
		
		echo $MedicaoResultado->selectMedicaoResultadoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idMedicaoResultado</th><th>Medição</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_MedicaoResultado', 'config');</script> 
</div>