<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtra.class.php");

$AtividadeExtra = new AtividadeExtra();

?>

<div id="cadastro_AtividadeExtra" class="">
  <fieldset>
    <legend>Atividade Extra</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/atividadeextra/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/atividadeextra/index.php";?>', '#cadastro_AtividadeExtra');" /> </div>
    <div class="lista">
      <table id="tb_lista_AtividadeExtra" class="registros">
        <thead>
          <tr>
            <th>ID</th>
            <th>Atividade Extra</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Aceita Comentário</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/atividadeextra/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/atividadeextra/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE a.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/atividadeextra/";		
		
		echo $AtividadeExtra->selectAtividadeExtraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Atividade Extra</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Aceita Comentário</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_AtividadeExtra', 'config');</script> 
</div>
