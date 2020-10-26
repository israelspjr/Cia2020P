<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$ConectarProfTeste = new ConectarProfTeste();

$idProfessor = $_GET['idProfessor'];

$valor = $Professor->selectProfessor(" WHERE idProfessor = ".$idProfessor);
$cpf = $valor[0]['documentoUnico'];
$a = array(".", "-");
$cpfLimpo = str_replace($a,"", $cpf); 

$valor = $ConectarProfTeste->conectarProf($cpfLimpo);


?>

<div id="cadastro_Grupo" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
  <!--  <div id="aba_div_principais" divExibir="div_principais" class="aba_interna ativa"></div>-->
    </div>
     <div id="modulos_Grupo" class="conteudo_nivel">
 
 
 <div id="relatorio_psa">
<fieldset>
  <legend>Resultado da pesquisa</legend>
</fieldset>

<iframe src="http://www.companhiadeidiomas.com.br/profteste/pt/candidato/login?emailProfessor=<?php echo $valor[0] ?>&senhaProfessor=<?php echo $valor[1]?>" width="100%" height="600px"></iframe> 
</div>
</div>
</div>