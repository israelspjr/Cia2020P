<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$IdiomaBackgroundPerfil = new IdiomaBackgroundPerfil();

$idClientePf = $_REQUEST['id'];
?>

<fieldset>
  <legend>Idioma de background</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/form/idiomaBackgroundPerfil.php";?>?idClientePf=<?php echo $idClientePf?>', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/idiomaBackgroundPerfil.php?id=".$idClientePf?>', '#div_lista_idiomaBackgroundPerfil');" /> </div>
  <div class="lista">
    <table id="tb_lista_idiomaBackgroundPerfil" class="registros">
      <thead>
        <tr>
          <th>Idioma</th>
          <th>Escola</th>
          <th>Obs</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo  $IdiomaBackgroundPerfil->selectIdiomabackgroundperfilTr(CAMINHO_CAD."clientePf/include/form/idiomaBackgroundPerfil.php", CAMINHO_CAD."clientePf/include/resourceHTML/idiomaBackgroundPerfil.php?id=".$idClientePf, "#div_lista_idiomaBackgroundPerfil", "WHERE clientePf_idClientePf = ".$idClientePf, "&idClientePf=".$idClientePf);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Idioma</th>
          <th>Escola</th>
          <th>Obs</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    </tfoot>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_idiomaBackgroundPerfil', 'simples');</script> 