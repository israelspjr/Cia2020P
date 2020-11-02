<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaProfessor.class.php");

$PsaProfessor = new PsaProfessor();

?>

<div id="cadastro_PsaProfessor" class="">
  <fieldset>
    <legend>P.S.A. Professor</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/psaprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/psaprofessor/index.php";?>', '#cadastro_PsaProfessor');" /> </div>
    <div class="lista">
      <table id="tb_lista_PsaProfessor" class="registros">
        <thead>
          <tr>
            <th>idPsaProfessor</th>
            <th>Tipo</th>
            <th>Título</th>
            <th>Pergunta</th>
            <th>Status</th>
          
          
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/psaprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/psaprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE p.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/psaprofessor/";		
		
		echo $PsaProfessor->selectPsaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idPsaProfessor</th>
            <th>Tipo</th>
            <th>Título</th>
            <th>Pergunta</th>
            <th>Status</th>
            
            
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_PsaProfessor', 'config');</script> 
</div>
