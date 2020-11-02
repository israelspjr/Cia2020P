<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCursoIdioma.class.php");

$FocoCursoIdioma = new FocoCursoIdioma();

?>
<div id="cadastro_FocoCursoIdioma" class="">
<fieldset>
  <legend>Foco Curso Idioma</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/fococursoidioma/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/fococursoidioma/index.php";?>', '#cadastro_FocoCursoIdioma');" /> </div>
<div class="lista"><table id="tb_lista_FocoCursoIdioma" class="registros">
    <thead>
      <tr>
	  <th>idFocoCursoIdioma</th><th>Foco Curso</th><th>Idioma</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/fococursoidioma/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/fococursoidioma/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE f.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/fococursoidioma/";		
		
		echo $FocoCursoIdioma->selectFocoCursoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
         <th>idFocoCursoIdioma</th><th>Foco Curso</th><th>Idioma</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_FocoCursoIdioma', 'config');</script> 
</div>