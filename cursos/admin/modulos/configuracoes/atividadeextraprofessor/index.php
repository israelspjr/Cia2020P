<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AtividadeExtraProfessor = new AtividadeExtraProfessor();

?>
<div id="cadastro_AtividadeExtraProfessor" class="">

<fieldset>
  <legend>Perfil de Professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO CADASTRO" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/atividadeextraprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/atividadeextraprofessor/index.php";?>', '#cadastro_AtividadeExtraProfessor');" /> </div>
<div class="lista"><table id="tb_lista_AtividadeExtraProfessor" class="registros">
    <thead>
      <tr>
	  <th>idPerfilProfessor</th><th>Tipo de perfil</th><th>Nome</th><th>Status</th><th>Aceita Comentário</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/atividadeextraprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/atividadeextraprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE a.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/atividadeextraprofessor/";		
		
		echo $AtividadeExtraProfessor->selectAtividadeExtraProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idPerfilProfessor</th><th>Tipo de perfil</th><th>Nome</th><th>Status</th><th>Aceita Comentário</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_AtividadeExtraProfessor', 'config');</script> 
</div>