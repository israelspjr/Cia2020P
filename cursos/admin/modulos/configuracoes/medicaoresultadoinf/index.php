<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MedicaoResultadoINF.class.php");

$MedicaoResultadoINF = new MedicaoResultadoINF();

?>
<div id="cadastro_MedicaoResultadoINF" class="">

<fieldset>
  <legend>Medição Resultado I.N.F.</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/medicaoresultadoinf/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/medicaoresultadoinf/index.php";?>', '#cadastro_MedicaoResultadoINF');" /> </div>
<div class="lista"><table id="tb_lista_MedicaoResultadoINF" class="registros">
    <thead>
      <tr>
	  <th>idMedicaoResultadoINF</th><th>Relacionamento I.N.F.</th><th>Medição Resultado</th><th>Qtd.</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/medicaoresultadoinf/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/medicaoresultadoinf/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE m.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/medicaoresultadoinf/";		
		
		echo $MedicaoResultadoINF->selectMedicaoResultadoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idMedicaoResultadoINF</th><th>Relacionamento I.N.F.</th><th>Medição Resultado</th><th>Qtd.</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_MedicaoResultadoINF', 'config');</script> 
</div>