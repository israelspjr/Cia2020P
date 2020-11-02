<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtra.class.php");

$NewsProfessor = new NewsProfessor();

?>

<div id="cadastro_AtividadeExtra" class="">
  <fieldset>
    <legend>Links Portais</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/newsProfessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/newsProfessor/index.php";?>', '#cadastro_AtividadeExtra');" /> </div>
    <div class="lista">
      <table id="tb_lista_AtividadeExtra" class="registros">
        <thead>
          <tr>
            <th>ID</th>
            <th>News</th>
            <th>Portal</th>
            <th>Com grupo</th>
            <th>Status</th>
    		<th>Data Cadastro</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/newsProfessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/newsProfessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE 1"; // a.portal = 1";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/newsProfessor/";		
		
		echo $NewsProfessor->selectNewsProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
            <tr>
            <th>ID</th>
            <th>News</th>
            <th>Portal</th>
            <th>Com grupo</th>
            <th>Status</th>
        		<th>Data Cadastro</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_AtividadeExtra', 'config');</script> 
</div>
