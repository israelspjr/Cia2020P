<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Grupo = new Grupo();

$caminhoAbrir = CAMINHO_CAD."grupo/include/form/grupos.php";
$caminhoAtualizar = CAMINHO_CAD."grupo/index.php";
$onde = "tr";

if(isset($_REQUEST["tr"])){
    
    $arrayRetorno = array();
    
    $ididGrupo = $_REQUEST["idGrupo"];
    $ordem = $_REQUEST["ordem"];
    
    $saida = $Grupo->selectGrupoTr_editar($caminhoAbrir, $caminhoAtualizar, $onde, "WHERE idGrupo = $idGrupo", true);
    
    $arrayRetorno["updateTr"] = $saida;
    $arrayRetorno["tabela"] = "#tb_lista_Grupo";
    $arrayRetorno["ordem"] = $ordem;
    
    echo json_encode($arrayRetorno);
    exit;       
}

//FILTROS
//print_r($_POST);
$where = "WHERE PAG.inativo = 0 ";
$status =  $_POST['status'];
if($status != "-"){
if( $status != '' ) $where .= " AND CL.inativo = ".$status;
}

$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND CL.idClientePj = ".$IdClientePj; 
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GT.gerente_idGerente in (".$IdGerente.")"; 
}

$statusG = $_POST['statusG'];
if($statusG != "-"){
if($statusG!= "") $where .= " AND G.inativo = ".$statusG; 
}


?>
<div class="lista">
  <table id="tb_lista_Grupo" class="registros">
    <thead>
      <tr>
        <th>Grupo</th>
        <th>Cliente p. jurídica</th>
        <th>Nível</th>
        <th>Idioma</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Grupo->selectGrupoTr_editar($caminhoAbrir, $caminhoAtualizar, $onde, $where);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Grupo</th>
        <th>Cliente p. jurídica</th>
        <th>Nível</th>
        <th>Idioma</th>
        <th>Status</th>
      </tr>
    </tfoot>
  </table>
</div>

<script>
    tabelaDataTable('tb_lista_Grupo');
</script> 
