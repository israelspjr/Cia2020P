<?php
	
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidaticPlanoAcao.class.php");

$MaterialDidaticPlanoAcao = new MaterialDidaticPlanoAcao();
$idPlanoAcao = $_REQUEST['id'];

?>

<fieldset>
  <legend>Material didático avulso</legend>
  <div class="menu_interno"> <!--<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/materialDidaticPlanoAcao.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/materialDidaticPlanoAcao.php?id=".$idPlanoAcao?>', '#div_lista_MaterialDidaticPlanoAcao');" /> --></div>
  <div class="lista">
    <table id="tb_lista_MaterialDidaticPlanoAcao3" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Editira</th>
          <th>Tipo</th>
          <th>Preço</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $MaterialDidaticPlanoAcao->selectMaterialDidaticPlanoAcaoTr(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao,1);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Editira</th>
          <th>Tipo</th>
          <th>Preço</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_MaterialDidaticPlanoAcao3', 'simples');</script> 
