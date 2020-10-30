<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DiasBuscaAvulsaProfessor = new DiasBuscaAvulsaProfessor();
$idDiasBuscaAvulsaProfessor = $_REQUEST['id'];
$idDiasBuscaAvulsa = $_REQUEST['idDiasBuscaAvulsa'];
$idProfessor = $_REQUEST['professorSelecionado'];
$escolhido = $_POST["escolhido"];
$arrayRetorno = array();
if($_POST['acao']=='deletar'){
    $DiasBuscaAvulsaProfessor->setIdDiasBuscaAvulsaProfessor($idDiasBuscaAvulsaProfessor);
    $DiasBuscaAvulsaProfessor->deleteDiasBuscaAvulsaProfessor($idDiasBuscaAvulsaProfessor);
    $arrayRetorno['mensagem'] = "Professor removido com sucesso.";
}else{
    if($escolhido==1){
     $sql = "UPDATE diasBuscaAvulsaProfessor SET escolhido = 2 WHERE diasBuscaAvulsa_idDiasBuscaAvulsa = $idDiasBuscaAvulsa AND escolhido = 1";
     $result = $DiasBuscaAvulsaProfessor->query($sql);
	 
	 $arrayRetorno['pagina'] =  CAMINHO_REL."busca/vendas/index.php";
    }

    $DiasBuscaAvulsaProfessor->setIdDiasBuscaAvulsaProfessor($idDiasBuscaAvulsaProfessor);
    $DiasBuscaAvulsaProfessor->updateFieldDiasBuscaAvulsaProfessor("escolhido", $escolhido);

    $valajax = "";
    if($escolhido==2){
        $valajax = "<img height=\"30px;\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo:\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/motivo.php?aceito=2&idProfessor=" . $idProfessor . "&id=".$idDiasBuscaAvulsaProfessor."&idBuscaAvulsa=".$idDiasBuscaAvulsa."', '', '')\" >";
    }else{
        $valajax = "<img height=\"30px;\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Motivo Rejeição:\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/avulsa/include/form/motivo.php?aceito=3&idProfessor=" . $idProfessor . "&id=".$idDiasBuscaAvulsaProfessor."&idBuscaAvulsa=".$idDiasBuscaAvulsa."', '', '')\" >";
    }
    $arrayRetorno['elementoAtualizar'][0] = "#motivo".$escolhido."_".$idDiasBuscaAvulsaProfessor;
    $arrayRetorno['valor2'][0] = $valajax;
    $arrayRetorno['mensagem'] = "Opção de professor escolhida com sucesso.";
}
echo json_encode($arrayRetorno);