<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Log = new Log();



//FILTROS
if($_POST["ativo"]==1){
    $inativo = 0;    
}else{
   $inativo = 1; 
}
switch ($_POST['usuario']) {
	case 0:
	   $where .= "LEFT JOIN professor AS P ON L.professor_idProfessor = P.idProfessor  AND P.inativo = $inativo LEFT JOIN clientePf AS PF ON L.clientePf_idClientePf = PF.idClientePf AND PF.inativo = $inativo LEFT JOIN clientePj AS PJ ON L.clientePj_idClientePj = PJ.idClientePj  AND PJ.inativo = $inativo LEFT JOIN funcionario AS F ON L.funcionario_idFuncionario = F.idFuncionario AND F.inativo = $inativo";	
	break;
    
    case 1:
       $where .= " INNER JOIN professor AS P ON P.idProfessor = L.professor_idProfessor AND P.inativo = $inativo";  
    break;
    
    case 2:
       $where .= " INNER JOIN clientePf AS PF ON PF.idClientePf = L.clientePf_idClientePf AND PF.inativo = $inativo";  
    break;
    
    case 3:
       $where .= " INNER JOIN clientePj AS PJ ON PJ.idClientePj = L.clientePj_idClientePj AND PJ.inativo = $inativo";  
    break;
	
	case 4:
       $where .= " INNER JOIN funcionario AS F ON F.idFuncionario = L.funcionario_idFuncionario AND F.inativo = $inativo";  
    break;
    
	default:
		
		break;
}
//Uteis::pr($_POST);
$dataIni = $_POST['dataIni'];
$dataFim = $_POST['dataFim'];

if($dataIni == ""){
    $where .= "WHERE DATE(L.dataLog) <= ".Uteis::gravarData($dataFim);
}else{
  $where .= " WHERE DATE(L.dataLog) BETWEEN '".Uteis::gravarData($dataIni)."' AND '".Uteis::gravarData($dataFim)."' ";  
}
$acao = implode(",", $_POST['acaoexecutada']);
 
//echo $where;
?>

<table id="tb_lista_Log" class="registros">
	<thead>
		<tr>
			<th></th>
			<th>Data/hora</th>
			<th>IP</th>
			<th>Tipo</th>
			<th>Nome</th>
			<th>Ação</th>
			<th>Mensagem</th>
			<th>Sucesso/Falha</th>			
		</tr>
	</thead>
	<tbody>
		<?php echo $Log -> selectLogTr($where); ?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th>Data/hora</th>
            <th>IP</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Ação</th>
            <th>Mensagem</th>
            <th>Sucesso/Falha</th>
		</tr>
	</tfoot>
</table>

<script>tabelaDataTable('tb_lista_Log', 'ordenaColuna');</script>
