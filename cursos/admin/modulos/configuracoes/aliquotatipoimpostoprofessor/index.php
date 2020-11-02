<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AliquotaTipoImpostoProfessor.class.php");

$AliquotaTipoImpostoProfessor = new AliquotaTipoImpostoProfessor();

?>

<div id="cadastro_AliquotaTipoImpostoProfessor" class="">
  <fieldset>
    <legend>Aliquota Tipo Imposto Professor</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/aliquotatipoimpostoprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/aliquotatipoimpostoprofessor/index.php";?>', '#cadastro_AliquotaTipoImpostoProfessor');" /> </div>
    <div class="lista">
      <table id="tb_lista_AliquotaTipoImpostoProfessor" class="registros">
        <thead>
          <tr>
            <th>ID</th>
            <th>Imposto</th>
            <th>De</th>
            <th>Ate</th>
            <th>Porcentagem</th>
            <th>Parcela Dedutiva</th>
            <th>Teto</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/aliquotatipoimpostoprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/aliquotatipoimpostoprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE A.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/aliquotatipoimpostoprofessor/";		
		
		echo $AliquotaTipoImpostoProfessor->selectAliquotaTipoImpostoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Imposto</th>
            <th>De</th>
            <th>Ate</th>
            <th>Porcentagem</th>
            <th>Parcela Dedutiva</th>
            <th>Teto</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_AliquotaTipoImpostoProfessor', 'config');</script> 
</div>
