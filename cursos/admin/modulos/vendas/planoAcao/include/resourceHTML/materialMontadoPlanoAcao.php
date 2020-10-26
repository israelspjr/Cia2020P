<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();

$idPlanoAcao = $_REQUEST['id'];

?>

<fieldset>
  <legend>Material montado/personalizado</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/materialMontadoPlanoAcao.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/materialMontadoPlanoAcao.php?id=".$idPlanoAcao?>', '#div_lista_materialMontadoPlanoAcao');" /> </div>
  <div class="lista">
    <table id="tb_lista_MaterialMontadoPlanoAcao" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Preço</th>
          <th>Informações</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $MaterialMontadoPlanoAcao->selectMaterialMontadoPlanoAcaoTr(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Preço</th>
          <th>Informações</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_MaterialMontadoPlanoAcao', 'simples');</script> 
