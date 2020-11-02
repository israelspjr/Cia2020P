<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/FocoCurso.class.php");

$FocoCurso = new FocoCurso();

?>

<div id="cadastro_FocoCurso" class="">
  <fieldset>
    <legend>Foco Curso</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/fococurso/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/fococurso/index.php";?>', '#cadastro_FocoCurso');" /> </div>
    <div class="lista">
      <table id="tb_lista_FocoCurso" class="registros">
        <thead>
          <tr>
            <th>idFocoCurso</th>
            <th>Foco</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/fococurso/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/fococurso/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/fococurso/";		
		
		echo $FocoCurso->selectFocoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idFocoCurso</th>
            <th>Foco</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_FocoCurso', 'simples');</script> 
</div>
