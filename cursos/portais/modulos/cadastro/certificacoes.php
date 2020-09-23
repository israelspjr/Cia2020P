<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Certificacoes = new Certificacoes();

$idProfessor = $_SESSION['idProfessor_SS'];
?>

<fieldset>
  <legend>Certificações</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo "modulos/cadastro/certificacoesForm.php?idProfessor=$idProfessor"?>', '<?php echo "modulos/cadastro/certificacoes.php?id=$idProfessor"?>', '#div_lista_Certificacoes');" /> </div>
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
      <?php echo $Certificacoes->selectCertificacoesTr("modulos/cadastro/", "modulos/cadastro/certificacoes.php?id=".$idProfessor, "#div_lista_Certificacoes", " WHERE professor_idProfessor = ".$idProfessor);?>
    </tbody>
  </table>
</fieldset>
<script> //tabelaDataTable('tb_lista_Certificacoes', 'simples');</script> 