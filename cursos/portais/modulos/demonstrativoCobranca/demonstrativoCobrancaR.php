<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$DemonstrativoCobranca = new DemonstrativoCobranca();

if ($_POST['nome']!=""){
    $nome = $_POST['nome'];
    $cliente = new ClientePf();
    $rsGruposList = $cliente->gruposClientePf(" AND CPF.nome like '%$nome%'");
    $GruposListArr = '';
    foreach($rsGruposList as $k => $v){
        $GruposListArr .= $v['idGrupo'].',';
    }
    $GruposList = substr($GruposListArr,0,-1);


    //$rsEmpresas = $cliente->em();
}

$mes = $_REQUEST['mes'];
if ($mes < 10) {
	$mes = "0".$mes;
}

$ano = $_REQUEST['ano'];


$IdClientePj = $_SESSION['idClientePj_SS']; //$_POST['clientePj_idClientePj'];
//if($IdClientePj != "-"){
/*if($IdClientePj!= "")*/ $clientePj = $IdClientePj; 
//}



$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
 //   if($grupo_idGrupo!= "")
        $where .= " AND G.idgrupo in (". $grupo_idGrupo.")";
		$grupo = 1;
	
}elseif(isset($GruposList)){
    $where .= " AND G.idgrupo in (". $GruposList.")";
    $grupo = 1;
}


if($clientePj !="" ):
    if($grupo==""):
        $where = " AND G.idGrupo in (select grupo_idGrupo from grupoClientePj where clientePj_idClientePj in ( select idClientePj from clientePj where idClientePj = $clientePj))";
    else:
        $where = " AND G.idGrupo in ($grupo_idGrupo)";
    endif;
endif;    

$statusGrupo = $_REQUEST['statusG'];
if($statusGrupo!="-")
$where .=" AND G.inativo =".$statusGrupo;

$caminhoAtualizar = "modulos/demonstrativoCobranca/demonstrativoCobrancaR.php";
 $onde = "tr";

//echo $where;


if (isset($_REQUEST["tr"])) {

	$arrayRetorno = array();

	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST['ordem'];
    $mes = $_REQUEST['mes'];
    $ano = $_REQUEST['ano'];

	$saida = $DemonstrativoCobranca -> selectDemonstrativoCobrancaTr($mes, $ano, $caminhoAtualizar, $onde, " AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo ",true, "",$ordem);
    $arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_DemonstrativoCobranca";
	$arrayRetorno["ordem"] = $ordem;
	echo json_encode($arrayRetorno);
	exit ;
	
}

 if($clientePj !=""):?>
<p align="right"><img src="<?php echo CAMINHO_IMG?>email.png" title="Enviar Demonstrativo Por Empresa" 
    onclick="zerarCentro();carregarModulo('modulos/demonstrativoCobranca/disparoEmailRH.php?idClientePj=<?php echo $clientePj?>&mes=<?php echo $mes?>&ano=<?php echo $ano?>', '#centro')" />
    <img src="<?php echo CAMINHO_IMG?>pa.png" title="Gerar PDFs de Demonstrativos Por Empresa" style="    width: 28px;"
    onclick="zerarCentro();carregarModulo('modulos/demonstrativoCobranca/gerarPdf.php?idClientePj=<?php echo $clientePj?>&mes=<?php echo $mes?>&ano=<?php echo $ano?>', '#centro')" /></p>
<?php endif;?>
<p><strong><?php echo $mes."/".$ano?></strong></p>
<table id="tb_lista_DemonstrativoCobranca" class="registros">
  
  <thead>
    <tr>
      <th>Empresa</th>
      <th>Grupo</th>
      <th>Carga Horária Fixa</th>
      <th>Observações</th>
      <th>Demostrativo</th>           
      <th>Status</th>
      <th>Data de Vencimento</th> 
      <th>Enviar Demonstrativo</th>
    </tr>
  </thead>
  <tbody>
  <?php
		echo $DemonstrativoCobranca->selectDemonstrativoCobrancaTr($mes, $ano, $caminhoAtualizar, $onde, $where, "", "", "", 1);
  ?>
  </tbody>

</table>

<script>
//	tabelaDataTable('tb_lista_DemonstrativoCobranca');
//	eventDestacar(1); 
</script> 


