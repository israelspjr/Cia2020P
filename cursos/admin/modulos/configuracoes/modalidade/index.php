<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");

$Modalidade = new Modalidade();

?>
<div id="cadastro_Modalidade" class="">
<fieldset>
  <legend>Modalidade</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/modalidade/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/modalidade/index.php";?>', '#cadastro_Modalidade');" /> </div>
<div class="lista"><table id="tb_lista_Modalidade" class="registros">
    <thead>
      <tr>
	  <th>idModalidade</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/modalidade/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/modalidade/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/modalidade/";		
		
		echo $Modalidade->selectModalidadeTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idModalidade</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Modalidade', 'config');</script> 
</div>