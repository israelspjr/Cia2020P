<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoMedicaoResultado = new PlanoAcaoMedicaoResultado();

$idPlanoAcao = $_REQUEST['id'];
//echo "//$idPlanoAcao";

?>

<fieldset>
  <legend>Medição de resultados</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/medicaoResultado.php?idPlanoAcao=$idPlanoAcao"?>'
  	, '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/medicaoResultado.php?id=".$idPlanoAcao?>', '#div_lista_medicaoResultado');" /> </div>
  <div class="lista">
    <table id="tb_lista_PlanoAcaoMedicaoResultado" class="registros">
      <thead>
        <tr>
          <th>Medição</th>
          <th>Quantidade</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $PlanoAcaoMedicaoResultado->selectPlanoAcaoMedicaoResultadoTr(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Medição</th>
          <th>Quantidade</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_PlanoAcaoMedicaoResultado', 'simples');</script> 
