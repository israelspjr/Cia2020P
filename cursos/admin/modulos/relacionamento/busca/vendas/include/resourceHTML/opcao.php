<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Professor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");
	
	$Professor = new Professor();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();	
		
	$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
	
	$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
?>

<fieldset>
  <legend>Professores escolhidos </legend>
  <div class="lista">
    <form name="form_opcao_professores" >
      <table id="tb_opcao_professores" class="registros">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Valor Hora</th>
            <th>Escolhido</th>
            <th>Aceitou</th>
            <th>Recusou</th>
            <th>Remover Professor</th>
          </tr>
        </thead>
        <tbody>
          <?php 	
	           echo $Professor->selectProfessorContratadoTr_opcaoBuscaProfessorSelecionada("", $idIdioma, $idBuscaProfessor, $idPlanoAcaoGrupo);
	       ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>Valor Hora</th>
            <th>Escolhido</th>
            <th>Aceito</th>
            <th>Recusou</th>
           <th>Remover Professor</th>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</fieldset>
<script> 
tabelaDataTable('tb_opcao_professores', 'simples');
</script> 
