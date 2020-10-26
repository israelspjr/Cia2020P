<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RepresentanteIdioma.class.php");

	$RepresentanteIdioma = new RepresentanteIdioma();
	
	$idRepresentante = $_GET['id'];
?>
<fieldset>
  <legend>Representante Idioma</legend>
       
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."representante/include/form/idioma.php";?>?idRepresentante=<?php echo $idRepresentante?>', '<?php echo CAMINHO_CAD."representante/include/resourceHTML/idioma.php?id=".$idRepresentante?>', '#div_cadastro_idioma');" /> </div>

<table id="tb_idioma" class="registros">
  <thead>
    <tr>
      <th>Idioma</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $RepresentanteIdioma->selectRepresentanteIdiomaTr(" WHERE Representante_idRepresentante = ".$idRepresentante);?>
  </tbody>
  <tfoot>
    <tr>
       <th>Idioma</th>
       <th></th>
    </tr>
  </tfoot>
</table>
</fieldset>
<script> tabelaDataTable('tb_idioma');</script> 
