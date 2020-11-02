<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OperadoraCelular.class.php");

$OperadoraCelular = new OperadoraCelular();

?>
<div id="cadastro_OperadoraCelular" class="">

<fieldset>
  <legend>Operadora Celular</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/operadoracelular/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/operadoracelular/index.php";?>', '#cadastro_OperadoraCelular');" /> </div>
<div class="lista"><table id="tb_lista_OperadoraCelular" class="registros">
    <thead>
      <tr>
	  <th>idOperadoraCelular</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/operadoracelular/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/operadoracelular/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/operadoracelular/";		
		
		echo $OperadoraCelular->selectOperadoraCelularTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idOperadoraCelular</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_OperadoraCelular', 'config');</script> 
</div>