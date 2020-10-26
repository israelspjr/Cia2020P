<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Certificacoes = new Certificacoes();

$idProfessor = $_REQUEST['id'];
?>

<fieldset>
  <legend>Certificações</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."certificacoes/include/form/certificacoes.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/certificacoes.php?id=$idProfessor"?>', '#div_lista_certificacoes');" /> </div>
  <table id="tb_lista_Certificacoes" class="registros">
    <thead>
      <tr>
        <th>Certificado</th>
        <th>Ano</th>
        <th>Tipo</th>
        <th>Idioma</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Certificacoes->selectCertificacoesTr(CAMINHO_CAD."certificacoes/include/", CAMINHO_CAD."professor/include/resourceHTML/certificacoes.php?id=".$idProfessor, "#div_lista_certificacoes", " WHERE professor_idProfessor = ".$idProfessor);?>
    </tbody>
    <tfoot>
        <tr>
        <th>Certificado</th>
        <th>Ano</th>
        <th>Tipo</th>
        <th>Idioma</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</fieldset>
<script> tabelaDataTable('tb_lista_Certificacoes', 'simples');</script> 