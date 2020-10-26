<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$arrayRetorno = array();

$inscricao = new WorkshopPresenca();

$idProfessor = $_POST['idProfessor'];
$dataEvento = $_POST['dataEvento'];
$inicio = $_POST['inicio'];
$termino = $_POST['termino'];
$finalizado = $_POST['finalizado'];
$idWordkshop = $_POST['evento'];
$duracao = Uteis::gravarHoras($_POST['duracao']);
$idPresenca = $_POST['idPresenca'];
$aprovado = ( $_POST['aprovado'] == "1" ? 1 : 0);


if($_POST['acao']=="deletar"){
    
    $arrayRetorno['mensagem'] = MSG_CADDEL;   
	$inscricao->setIdPresenca($_POST['id']);
    $inscricao->deletePresenca();

    echo json_encode($arrayRetorno);
    
}else{

 $inscricao->setWorkshop_idWorkshop($idWordkshop);
 $inscricao->setProfessor_idProfessor($idProfessor);
 $inscricao->setDataInscricao($dataEvento);
 $inscricao->setDuracao($duracao);
 $inscricao->setAprovado($aprovado);
 $inscricao->setProfessor_idProfessor($idProfessor);
 
 if ($idPresenca == '') {
 
 $inscricao->addPresenca();
 
 } else {
$inscricao->setIdPresenca($idPresenca);
$inscricao->updatePresenca();	 
	 
 }



$arrayRetorno['mensagem'] = "Dados cadastrados com sucesso";
$arrayRetorno['fecharNivel'] = true;
echo json_encode($arrayRetorno);

}
?>