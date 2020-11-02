<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVariedadeRecurso.class.php");

$TipoVariedadeRecurso = new TipoVariedadeRecurso();

?>
<div id="cadastro_TipoVariedadeRecurso" class="">
<fieldset>
  <legend>TipoVariedadeRecurso</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipovariedaderecurso/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipovariedaderecurso/index.php";?>', '#cadastro_TipoVariedadeRecurso');" /> </div>
<div class="lista"><table id="tb_lista_TipoVariedadeRecurso" class="registros">
    <thead>
      <tr>
	  <th>idTipoVariedadeRecurso</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipovariedaderecurso/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipovariedaderecurso/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipovariedaderecurso/";		
		
		echo $TipoVariedadeRecurso->selectTipoVariedadeRecursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoVariedadeRecurso</th><th>Tipo</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoVariedadeRecurso', 'config');</script> 
</div>