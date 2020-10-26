<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Representante.class.php");

$Representante = new Representante();
?>

<fieldset>
  <legend>Cadastro de representante</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."representante/cadastro.php";?>', '<?php echo CAMINHO_CAD."representante/index.php";?>', '#centro');" /> </div>
  <div id="lista_representante" class="lista">
    <table id="tb_lista_representante" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Idiomas</th>
          <th>Ativo</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Representante->selectRepresentanteTr();?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Idiomas</th>
          <th>Ativo</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>tabelaDataTable('tb_lista_representante');
eventDestacar(1);
</script> 
