<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoContatoProposta.class.php");

$TipoContatoProposta = new TipoContatoProposta();

?>
<div id="cadastro_TipoContatoProposta" class="">
<fieldset>
  <legend>Tipo Contato Proposta</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipocontatoproposta/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipocontatoproposta/index.php";?>', '#cadastro_TipoContatoProposta');" /> </div>
<div class="lista"><table id="tb_lista_TipoContatoProposta" class="registros">
    <thead>
      <tr>
	  <th>idTipoContatoProposta</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipocontatoproposta/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipocontatoproposta/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipocontatoproposta/";		
		
		echo $TipoContatoProposta->selectTipoContatoPropostaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoContatoProposta</th><th>Tipo</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoContatoProposta', 'config');</script> 
</div>