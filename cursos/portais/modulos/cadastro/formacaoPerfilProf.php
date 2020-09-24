<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FormacaoPerfil = new FormacaoPerfil();

$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
  <legend>Formação escolar (Inclua também os seus cursos incompletos)</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/formacaoPerfilForm.php?idProfessor=$idProfessor"?>',  '#centro');" /> </div>
  <div class="lista">
    <table id="tb_lista_formacaoPerfil" class="registros">
      <thead>
        <tr>
          <th>Formação</th>
          <th>Curso</th>
          <th>Instituição</th>
          <th>obs</th>
          <th>Finalizado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $FormacaoPerfil->selectFormacaoperfilTr("modulos/cadastro/", "modulos/cadastro/resourceHTML/formacaoPerfil.php?id=".$idProfessor, "#centro", " WHERE professor_idProfessor = ".$idProfessor,1);?>
      </tbody>
     </table>
  </div>
</fieldset>
<script> //tabelaDataTable('tb_lista_formacaoPerfil', 'simples');</script> 
<p>&nbsp;</p>
  <div id="div_lista_certificacoes">
          <?php require_once 'certificacoes.php';?>
        </div>
        <p>&nbsp;</p>
  <div id="div_lista_meioLocomocaoProfessor">
          <?php require_once 'meioLocomocaoProfessor.php';?>
        </div>
              <p>&nbsp;</p>
  <div id="div_lista_LocalAula">
          <?php require_once 'localAulaProfessor.php';?>
        </div>
<p>&nbsp;</p>        
         <div id="div_lista_vivenciaProfessor">
          <?php require_once 'vivenciaProfessor.php';?>
        </div>
<p>&nbsp;</p>        
        <div id="div_lista_experienciaProfissional">
          <?php require_once 'experienciaProfissional.php';?>
        </div>
<p>&nbsp;</p>  
      
         <div id="div_lista_opcaoHabilidadesProfessor">
      <?php require_once 'opcaoAtividadeExtraProfessor.php';?>
      </div>