<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProvaOn = new ProvaOn();

?>

<div id="cadastro_Prova" class="">
  <fieldset>
    <legend>Prova</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."provas/formulario.php";?>', '<?php echo CAMINHO_REL."provas/index.php";?>', '#cadastro_Prova');" /> </div>
    <div class="lista">
      <table id="tb_lista_Prova" class="registros">
        <thead>
          <tr>
            <th>idProva</th>
            <th>Nome</th>
            <th>Idioma</th>
            <th>Nível</th>
            <th>Foco</th>
            <th>Kit</th>
           <th>Observações</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_REL."provas/formulario.php";
		$caminhoAtualizar= CAMINHO_REL."provas/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_REL."provas/";		
		
		echo $ProvaOn->selectProvaOnTrLista($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idProva</th>
            <th>Nome</th>
            <th>Idioma</th>
           <th>Nível</th>
            <th>Foco</th>
            <th>Kit</th>
            <th>Observações</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Prova', 'config');</script> 
</div>
