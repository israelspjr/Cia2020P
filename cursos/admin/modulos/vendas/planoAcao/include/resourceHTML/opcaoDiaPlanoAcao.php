<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
$OpcaoDia = new OpcaoDia();
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();

$idValorSimuladoPlanoAcao = $_GET['id'];
$where = "WHERE idValorSimuladoPlanoAcao=".$idValorSimuladoPlanoAcao;
$valorValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao($where);

$tipo = $valorValorSimuladoPlanoAcao[0]['tipo'];
?>

<fieldset>
  <legend>Opções de dias e horários</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/opcaoDiaPlanoAcao.php";?>?idValorSimuladoPlanoAcao=<?php echo $idValorSimuladoPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/opcaoDiaPlanoAcao.php?id=".$idValorSimuladoPlanoAcao?>', '#div_lista_OpcaoDiaPlanoAcao');" /> </div>
  <div class="lista">
    <?php if($tipo == "R"){ ?>
    <table id="tb_lista_OpcaoDiaPlanoAcao" class="registros">
      <thead>
        <tr>
          <th>Opção escolhida</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
              echo $OpcaoDia->selectOpcaoDiaTr(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);
            ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Opção escolhida</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    <script>     
    tabelaDataTable('tb_lista_OpcaoDiaPlanoAcao');
    </script>
    <?php }elseif($tipo == "T" || $tipo == "E"){ ?>
    <table id="tb_lista_OpcaoDiaPlanoAcao" class="registros">
      <thead>
        <tr>
          <th>strtotime</th>
          <th>Data</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
              echo $OpcaoDia->selectOpcaoDiaTr_T_E(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);
            ?>
      </tbody>
      <tfoot>
        <tr>
          <th>strtotime</th>
          <th>Data</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    <script> 		
			tabelaDataTable('tb_lista_OpcaoDiaPlanoAcao', 'ordenaColuna');		
		</script>
    <?php }?>
  </div>
</fieldset>
<script> 
function gravaOpcaoDia(){
	var idOpcaoDia = $('input[name=radio_opcaoDia]:checked').val();
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/opcaoDiaPlanoAcao.php',{acao:"gravaOpcaoDia", id:idOpcaoDia}, function(e){
		acaoJson(e);
	});
}
</script> 
