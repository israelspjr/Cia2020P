<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenProva.class.php");

$ItenProva = new ItenProva();

?>
<div id="cadastro_ItenProva" class="">
<fieldset>
  <legend>Item Prova</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/itenprova/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/itenprova/index.php";?>', '#cadastro_ItenProva');" /> </div>
<div class="lista"><table id="tb_lista_ItenProva" class="registros">
    <thead>
      <tr>
	  <th>idItenProva</th><th>Prova</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/itenprova/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/itenprova/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE i.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/itenprova/";		
		
		echo $ItenProva->selectItenProvaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idItenProva</th><th>Prova</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ItenProva', 'config');</script> 
</div>