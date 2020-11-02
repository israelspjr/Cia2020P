<?php
//pagina contendo a listagem
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoQualidadeComunicacao.class.php");

$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();

?>
<div id="cadastro_TipoQualidadeComunicacao" class="">
<fieldset>
  <legend>Tipo Qualidade Comunicação</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO CADASTRO" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoqualidadecomunicacao/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoqualidadecomunicacao/index.php";?>', '#cadastro_TipoQualidadeComunicacao');" /> </div>
<div class="lista"><table id="tb_lista_TipoQualidadeComunicacao" class="registros">
    <thead>
      <tr>
	  <th>idTipoQualidadeComunicacao</th><th>Idioma</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoqualidadecomunicacao/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoqualidadecomunicacao/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE t.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoqualidadecomunicacao/";		
		
		echo $TipoQualidadeComunicacao->selectTipoQualidadeComunicacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoQualidadeComunicacao</th><th>Idioma</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoQualidadeComunicacao', 'config');</script> 
</div>