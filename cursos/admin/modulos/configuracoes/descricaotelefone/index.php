<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescricaoTelefone.class.php");

$DescricaoTelefone = new DescricaoTelefone();

?>
<div id="cadastro_DescricaoTelefone" class="">

<fieldset>
  <legend>Descrição Telefone</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/descricaotelefone/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/descricaotelefone/index.php";?>', '#cadastro_DescricaoTelefone');" /> </div>
<div class="lista"><table id="tb_lista_DescricaoTelefone" class="registros">
    <thead>
      <tr>
	  <th>idDescricaoTelefone</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/descricaotelefone/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/descricaotelefone/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/descricaotelefone/";		
		
		echo $DescricaoTelefone->selectDescricaoTelefoneTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idDescricaoTelefone</th><th>Nome</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_DescricaoTelefone', 'config');</script> 
</div>