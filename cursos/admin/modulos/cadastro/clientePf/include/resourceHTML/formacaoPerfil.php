<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FormacaoPerfil = new FormacaoPerfil();

$idClientePf = $_REQUEST['id'];
?>

<fieldset>
  <legend>Formação escolar</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."formacaoPerfil/include/form/formacaoPerfil.php?idClientePf=$idClientePf"?>', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/formacaoPerfil.php?id=$idClientePf"?>', '#div_lista_formacaoPerfil');" /> </div>
  <div class="lista">
    <table id="tb_lista_formacaoPerfil" class="registros">
      <thead>
        <tr>
   
        <th>Formação</th>

        <th>Curso</th>

        <th>Instituição</th>
     <th>obs</th>
          <th>Finalizado</th>
  
        <th></th>        </tr>
      </thead>
      <tbody>
        <?php echo  $FormacaoPerfil->selectFormacaoperfilTr(CAMINHO_CAD."formacaoPerfil/include/", CAMINHO_CAD."clientePf/include/resourceHTML/formacaoPerfil.php?id=".$idClientePf, "#div_lista_formacaoPerfil", " WHERE clientePf_idClientePf = ".$idClientePf);?>
      </tbody>
      <tfoot>
        <tr>
    
        <th>Formação</th>

        <th>Curso</th>

        <th>Instituição</th>
     <th>obs</th>
          <th>Finalizado</th>
  
        <th></th>        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_formacaoPerfil', 'simples');</script> 
