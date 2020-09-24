<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ExperienciaProfissional = new ExperienciaProfissional();

$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
  <legend>Experiência profissional </legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/experienciaProfissionalForm.php?idProfessor=$idProfessor"?>',  '#centro');" /> </div>
  <div class="lista">
    <table id="tb_lista_experienciaProfissional" class="registros">
      <thead>
        <tr>
          <th>Empresa</th>
          <th>Função</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ExperienciaProfissional->selectExperienciaProfissionalTr("modulos/cadastro/", "modulos/cadastro/experienciaProfissional.php?id=".$idProfessor, "#div_lista_experienciaProfissional", " WHERE professor_idProfessor = ".$idProfessor,1);?>
      </tbody>
     
    </table>
  </div>
</fieldset>
<script> //tabelaDataTable('tb_lista_experienciaProfissional', 'simples');</script> 
