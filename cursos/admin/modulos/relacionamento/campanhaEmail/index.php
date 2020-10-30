<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$CampanhaEmail = new CampanhaEmail();

$where .= " WHERE 1";
$ativo = $_POST['status'];


if ($ativo != '-') {
$where .= " AND inativo =" .$ativo;	

}

/*
$idSegmento = $_POST['segmento_idSegmento'];
if ($idSegmento != '-') {
$where .= " AND segmento_idSegmento = ".$idSegmento;	
	
}
*/
$nomeTb = "tb_lista_campanhaEmail";

$caminhoAbrir = CAMINHO_REL."campanhaEmail/formulario.php";
$caminhoAtualizar = CAMINHO_REL."campanhaEmail/filtro.php";
$ondeAtualiza = "#centro";
?>



  <div class="lista">
    <table id="emailsTB" class="registros">
      <thead>
        <tr>
         <th>ID</th>
          <th>Titulo</th>
          <th>ClientePj</th>
          <th>ClientePf</th>
          <th>Data Cadastro</th>
          <th>Data de Envio</th>
          <th>Hora de Envio</th>
          <th>Nome Envio</th>
          <th>Status</th>
		  <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $CampanhaEmail->selectCampanhaEmailTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, "", "");?>
      </tbody>
      <tfoot>
        <tr>
   		  <th>ID</th>
          <th>Titulo</th>
          <th>ClientePj</th>
          <th>ClientePf</th>
          <th>Data Cadastro</th>
          <th>Data de Envio</th>
          <th>Hora de Envio</th>
          <th>Nome Envio</th>
          <th>Status</th>
		  <th></th>
        </tr>
      </tfoot>
    </table>
  </div>

<script> tabelaDataTable('emailsTB', 'simples');</script> 
