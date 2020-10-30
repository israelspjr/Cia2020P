<?php
//echo "ok";exit;
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();

$idDiasBuscaAvulsa = $_REQUEST['idDiasBuscaAvulsa'];
$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];
$idIdioma = $_REQUEST['idIdioma'];

?>
<fieldset>
  <legend>Professores escolhidos </legend>
  <div class="lista">
    <table id="tb_opcao_professores" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Valor Hora</th>
          <th>Escolhido</th>
          <th>Aceitou</th>
          <th>Recusou</th>
          <th>Obs</th>
          <th>Ordem Prospecção</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Professor->selectProfessorContratadoTr_diasBuscaAvulsaProfessor("", $idIdioma, $idDiasBuscaAvulsa, $idBuscaAvulsa);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Valor Hora</th>
          <th>Escolhido</th>
          <th>Aceitou</th>
          <th>Recusou</th>
          <th>Obs</th>
          <th>Ordem Prospecção</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> 
tabelaDataTable('tb_opcao_professores', 'simples');
function abre(cid,prof){
    jQuery("#motivo"+cid+"_"+prof).html("");
    if (cid==3){
        jQuery('.motivoimg'+prof).html('<img src="/cursos/images/confirma.png" title="Aceitou a Vaga">');
    }else{
        jQuery('.motivoimg'+prof).html('<img src="/cursos/images/error.png" title="Rejeitou a Vaga">');
    }
}
</script> 
