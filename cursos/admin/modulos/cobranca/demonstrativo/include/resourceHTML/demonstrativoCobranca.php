<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DemonstrativoCobranca = new DemonstrativoCobranca();
$RegistroDeAnotacoes = new RegistroDeAnotacoes();

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

$mesF = $_REQUEST['mesF'];
if ($mesF < 10) {
	$mesF = "0".$mesF;
}

$anoF = $_REQUEST['anoF'];

$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
/*if($IdClientePj!= "")*/ $clientePj = $IdClientePj; 
}



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

//if(is_numeric($_REQUEST['idGerente'])):
//echo $_REQUEST['idGerente'];
$gerente = implode(',',$_REQUEST['idGerente']);
if ($gerente != "-") {
    
$where .=" AND G.idGrupo in (select grupo_idGrupo from grupoClientePj where clientePj_idClientePj in (select clientePj_idClientePj  from gerenteTem where gerente_idGerente in($gerente) AND dataExclusao is null))";
//endif;
}

$statusGrupo = $_REQUEST['statusG'];
if($statusGrupo!="-")
$where .=" AND G.inativo =".$statusGrupo;

$caminhoAtualizar = CAMINHO_COBRANCA . "demonstrativo/include/resourceHTML/demonstrativoCobranca.php";
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

?>
<?php if($clientePj !=""):?>
<p style="float: left;"><strong>Observações sobre cobrança: </strong><br />

<?php 

$valorRegistroDeAnotacoes = $RegistroDeAnotacoes->selectRegistroDeAnotacoes('WHERE  financeiro = 1 AND clientePj_idClientePj='.$clientePj);
$texto = "";
foreach($valorRegistroDeAnotacoes as $valor) {
$texto .= "Titulo:".$valor['titulo']."<br>Anotação: ".$valor['anotacao']."<br>Data:".Uteis::exibirData($valor['dataCadastro'])."<br>";	
}
echo $texto;
?>


</p>
<br /><br />
<p align="right"><img src="<?php echo CAMINHO_IMG?>email.png" title="Enviar Demonstrativo Por Empresa" 
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_COBRANCA?>demonstrativo/include/resourceHTML/disparoEmailRH.php?idClientePj=<?php echo $clientePj?>&mes=<?php echo $mes?>&ano=<?php echo $ano?>', '<?php echo $caminhoAtualizar?>')" />
    <img src="<?php echo CAMINHO_IMG?>pa.png" title="Gerar PDFs de Demonstrativos Por Empresa" style="    width: 28px;"
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_COBRANCA?>demonstrativo/include/resourceHTML/gerarPdf.php?idClientePj=<?php echo $clientePj?>&mes=<?php echo $mes?>&ano=<?php echo $ano?>', '<?php echo $caminhoAtualizar?>')" /></p>
<?php endif;?>
<p><strong><?php echo $mes."/".$ano?> <!--a <?php echo $mesF."/".$anoF?>--></strong></p>
<style>
.registros td {
	padding:0;	
}
.validate {
	margin:0;	
}
.destacaLinha {
	margin-bottom: 0px; 
    padding: 0px; 
    min-height: 0px;	
}
img {
	padding-top: 13px;	
}
</style>

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
		echo $DemonstrativoCobranca->selectDemonstrativoCobrancaTr($mes, $ano, $caminhoAtualizar, $onde, $where, "", "", "", "", $mesF, $anoF);
  ?>
  </tbody>
  <tfoot>
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
  </tfoot>
</table>

<script>
	tabelaDataTable('tb_lista_DemonstrativoCobranca', 'simples');
	eventDestacar(1); 
</script> 


