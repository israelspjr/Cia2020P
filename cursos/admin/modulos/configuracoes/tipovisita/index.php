<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVisita.class.php");

$TipoVisita = new TipoVisita();

?>
<div id="cadastro_TipoVisita" class="">
<fieldset>
  <legend>Tipo Visita</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipovisita/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipovisita/index.php";?>', '#cadastro_TipoVisita');" /> </div>
<div class="lista"><table id="tb_lista_TipoVisita" class="registros">
    <thead>
      <tr>
	  <th>idTipoVisita</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipovisita/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipovisita/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipovisita/";		
		
		echo $TipoVisita->selectTipoVisitaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoVisita</th><th>Tipo</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoVisita', 'config');</script> 
</div>