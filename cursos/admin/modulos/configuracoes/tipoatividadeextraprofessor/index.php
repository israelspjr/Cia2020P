<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();

?>

<div id="cadastro_TipoAtividadeExtraProfessor" class="">
  <fieldset>
    <legend>Tipo perfil de professor</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipoatividadeextraprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipoatividadeextraprofessor/index.php";?>', '#cadastro_TipoAtividadeExtraProfessor');" /> </div>
    <div class="lista">
      <table id="tb_lista_TipoAtividadeExtraProfessor" class="registros">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipoatividadeextraprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipoatividadeextraprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipoatividadeextraprofessor/";		
		
		echo $TipoAtividadeExtraProfessor->selectTipoAtividadeExtraProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoAtividadeExtraProfessor');</script> 
</div>
