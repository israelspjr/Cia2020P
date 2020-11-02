<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();

$idPlanoAcao = $_REQUEST['id'];	
?>

<fieldset>
  <legend>Valores simulados </legend>
  <div class="menu_interno"> <!--<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/valorSimulado.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/valorSimuladoPlanoAcao.php?id=".$idPlanoAcao?>', '#div_lista_valorSimuladoPlanoAcao');" /> --></div>
  <div class="lista">
    <table id="tb_lista_ValorSimuladoPlanoAcao" class="registros">
      <thead>
        <tr>
          <th>Valor</th>
          <th>Horas</th>
          <th>Frequencia semanal</th>
          <th>Adicionais (por dia)</th>
          <th>Adicionais (por hora)</th>
          <th>Tipo</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcaoTr(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao,1);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Valor</th>
          <th>Horas</th>
          <th>Frequencia semanal</th>
          <th>Adicionais (por dia)</th>
          <th>Adicionais (por hora)</th>
          <th>Tipo</th>
          <th>Total</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_ValorSimuladoPlanoAcao', 'simples');</script> 