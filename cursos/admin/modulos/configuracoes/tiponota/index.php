<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoNota.class.php");

$TipoNota = new TipoNota();

?>
<div id="cadastro_TipoNota" class="">
<fieldset>
  <legend>Aspectos da PSA</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tiponota/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tiponota/index.php";?>', '#cadastro_TipoNota');" /> </div>
<div class="lista"><table id="tb_lista_TipoNota" class="registros">
    <thead>
      <tr>
	  <th>idTipoNota</th><th>Nome</th><th>Descrição</th><th>Status</th><th>Descritiva</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tiponota/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tiponota/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tiponota/";		
		
		echo $TipoNota->selectTipoNotaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoNota</th><th>Nome</th><th>Descrição</th><th>Status</th><th>Descritiva</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoNota', 'config');</script> 
</div>