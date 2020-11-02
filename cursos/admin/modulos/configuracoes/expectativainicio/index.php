<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ExpectativaInicio.class.php");

$ExpectativaInicio = new ExpectativaInicio();

?>
<div id="cadastro_ExpectativaInicio" class="">

<fieldset>
  <legend>Expectativa Início</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/expectativainicio/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/expectativainicio/index.php";?>', '#cadastro_ExpectativaInicio');" /> </div>
<div class="lista"><table id="tb_lista_ExpectativaInicio" class="registros">
    <thead>
      <tr>
	  <th>ID</th><th>Expectativa</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/expectativainicio/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/expectativainicio/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/expectativainicio/";		
		
		echo $ExpectativaInicio->selectExpectativaInicioTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th><th>Expectativa</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ExpectativaInicio', 'config');</script> 
</div>