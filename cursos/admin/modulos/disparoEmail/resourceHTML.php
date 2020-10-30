<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisparoEmail = new DisparoEmail();
if($idProposta!="")
$param = "idProposta=$idProposta";
if($idPlanoAcao!="")
$param = "idPlanoAcao=$idPlanoAcao";
if($idIntegranteGrupo!="")
$param = "idIntegranteGrupo=$idIntegranteGrupo";
if($idIntegranteGrupoPsa!="")
$param = "idIntegranteGrupoPsa=$idIntegranteGrupoPsa";
if($idAcompanhamentoCurso!="")
$param = "idAcompanhamentoCurso=$idAcompanhamentoCurso";
if($idPlanoAcaoGrupo!=""){
$param = "idPlanoAcaoGrupo=$idPlanoAcaoGrupo";
if($mes!="")
$param .="&mes=$mes";
if($ano!="")
$param .="&ano=$ano";
}
if($idClientePj!=""){
$param = "idClientePj=$idClientePj";
if($mes!="")
$param .="&mes=$mes";
if($ano!="")
$param .="&ano=$ano";
}
if($IntegranteGrupo_id!="")
$param = "IntegranteGrupo_id=$IntegranteGrupo_id";

 //CERTIFICADO

?>

<fieldset>
  <legend>Disparo de e-mails</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."?".$param?>', '<?php echo $caminhoAtualizar?>', '<?php echo $onde?>')" /> </div>
  <div class="lista">
    <table id="tb_lista_DisparoEmail" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Data</th>
          <th>Destino</th>
          <th>Assunto</th>
        </tr>
      </thead>
      <tbody>
        <?php 	
 		echo $DisparoEmail->selectDisparoEmailTr($caminhoAbrir, $caminhoAtualizar, $onde, $where);
		?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Data</th>
          <th>Destino</th>
          <th>Assunto</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_DisparoEmail', 'ordenaColuna');</script> 
