<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ProvaOn = new ProvaOn();
$ProvaOnQuestoes = new ProvaOnQuestoes();


if ($idProva == '') {
$idProva = $_REQUEST['idProva'];
$AND .= " AND provaOn_idProvaOn = ".$idProva;

} else {
	
$AND .= " AND provaOn_idProvaOn = ".$idProva;	
}
if ($idIdioma == '') {
$idIdioma = $_REQUEST['idIdioma'];
}
?>

<div id="cadastro_Prova" class="">
  <fieldset>
    <legend>Questões</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."provas/filtro.php?idProva=".$idProva."&idIdioma=".$idIdioma;?>', '<?php echo CAMINHO_REL."provas/questoes.php?idProva=".$idProva."&idIdioma=".$idIdioma;?>', '#cadastro_Prova');" /> </div>
    <div class="lista">
      <table id="tb_lista_Prova" class="registros">
        <thead>
          <tr>
            <th>Ordem</th>
           <th>Titulo</th>
            <th>Enunciado</th>
             <th>Status</th>
            <th>Ação</th>
          
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_REL."provas/formulario.php";
		$caminhoAtualizar= CAMINHO_REL."provas/questoes.php?idProva=".$idProva."&idIdioma=".$idIdioma;
		$ondeAtualiza= "#cadastro_Prova";
		$where = " WHERE excluido = 0".$AND;
		$idPai = "";
		$caminhoModulo = CAMINHO_REL."provas/";		
		
		echo $ProvaOnQuestoes->selectProvaOnQuestoesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
         <th>Ordem</th>
           <th>Titulo</th>
	      <th>Enunciado</th>
            <th>Status</th>
             <th>Ação</th>
         
             </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Prova', 'simples');</script> 
</div>
