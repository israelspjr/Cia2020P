<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescontoGeral.class.php");

$DescontoGeral = new DescontoGeral();

?>
<div id="cadastro_DescontoGeral" class="">

<fieldset>
  <legend>Desconto Geral</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/descontoGeral/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/descontoGeral/index.php";?>', '#cadastro_DescontoGeral');" /> </div>
<div class="lista"><table id="tb_lista_DescontoGeral" class="registros">
    <thead>
      <tr>
	  <th>idDescontoGeral</th><th>Descrição</th><th>Valor</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/descontoGeral/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/descontoGeral/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE inativo = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/descontoGeral/";		
		
		echo $DescontoGeral->selectDescontoGeralTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idDescontoGeral</th><th>Descrição</th><th>Valor</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_DescontoGeral', 'config');</script> 
</div>