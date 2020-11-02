<?php
//pagina contendo a listagem
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoCurso = new TipoCurso();

?>
<div id="cadastro_TipoCurso" class="">
<fieldset>
  <legend>Tipo Curso</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoCurso/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoCurso/index.php";?>', '#cadastro_TipoCurso');" /> </div>
<div class="lista"><table id="tb_lista_TipoCurso" class="registros">
    <thead>
      <tr>
	  <th>idTipoCurso</th><th>Tipo</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoCurso/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoCurso/index.php";
		$ondeAtualiza= "#centro";
	//	$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoCurso/";		
		
		echo $TipoCurso->selectTipoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoCurso</th><th>Tipo</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoCurso', 'config');</script> 
</div>