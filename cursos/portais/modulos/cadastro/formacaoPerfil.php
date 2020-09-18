<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$FormacaoPerfil = new FormacaoPerfil();

$idClientePf = $_SESSION['idClientePf_SS'];
?>
<div id="div_lista_formacaoPerfil">
<fieldset>
  <legend>Formação escolar</legend>
  <div class="menu_interno">
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/formacaoPerfilForm.php?idClientePf=$idClientePf"?>', '#centro');" />
  </div>
  <table id="tb_lista_formacaoPerfil" class="registros">
    <thead>
      <tr>
        <th>Formação</th>
        <th>Curso</th>
        <th>Instituição</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo  $FormacaoPerfil->selectFormacaoperfilTr("modulos/cadastro/", "modulos/cadastro/formacaoPerfil.php?id=".$idClientePf, "#div_lista_formacaoPerfil", " WHERE clientePf_idClientePf = ".$idClientePf);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Formação</th>
        <th>Curso</th>
        <th>Instituição</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</fieldset>
</div>
<script>// tabelaDataTable('tb_lista_formacaoPerfil', 'simples');</script> 



