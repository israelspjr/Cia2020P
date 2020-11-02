<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenQualidadeComunicacao.class.php");

$ItenQualidadeComunicacao = new ItenQualidadeComunicacao();

?>
<div id="cadastro_ItenQualidadeComunicacao" class="">
<fieldset>
  <legend>Item Qualidade Comunicação</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/itenqualidadecomunicacao/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/itenqualidadecomunicacao/index.php";?>', '#cadastro_ItenQualidadeComunicacao');" /> </div>
<div class="lista"><table id="tb_lista_ItenQualidadeComunicacao" class="registros">
    <thead>
      <tr>
	  <th>idItenQualidadeComunicacao</th><th>Tipo Qualidade Comunicação</th><th>Nome</th><th>Descrição</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/itenqualidadecomunicacao/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/itenqualidadecomunicacao/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE i.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/itenqualidadecomunicacao/";		
		
		echo $ItenQualidadeComunicacao->selectItenQualidadeComunicacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idItenQualidadeComunicacao</th><th>Tipo Qualidade Comunicação</th><th>Nome</th><th>Descrição</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ItenQualidadeComunicacao', 'config');</script> 
</div>