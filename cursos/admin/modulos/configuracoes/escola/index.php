<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Escola.class.php");

$Escola = new Escola();

?>
<div id="cadastro_Escola" class="">

<fieldset>
  <legend>Escola</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/escola/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/escola/index.php";?>', '#cadastro_Escola');" /> </div>
<div class="lista"><table id="tb_lista_Escola" class="registros">
    <thead>
      <tr>
	  <th>ID</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/escola/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/escola/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/escola/";		
		
		echo $Escola->selectEscolaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Escola', 'config');</script> 
</div>