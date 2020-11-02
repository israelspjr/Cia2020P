<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PeriodoAcompanhamentoCurso.class.php");

$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();

?>

<div id="cadastro_PeriodoAcompanhamentoCurso" class="">
  <fieldset>
    <legend>Período Acompanhamento Curso</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/periodoacompanhamentocurso/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/periodoacompanhamentocurso/index.php";?>', '#cadastro_PeriodoAcompanhamentoCurso');" /> </div>
    <div class="lista">
      <table id="tb_lista_PeriodoAcompanhamentoCurso" class="registros">
        <thead>
          <tr>
            <th></th>
            <th>Mês</th>
            <th>Ano</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/periodoacompanhamentocurso/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/periodoacompanhamentocurso/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/periodoacompanhamentocurso/";
		
		echo $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th>Mês</th>
            <th>Ano</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_PeriodoAcompanhamentoCurso', 'ordenaColuna');</script> 
</div>
