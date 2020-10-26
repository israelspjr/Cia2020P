<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Funcionario = new Funcionario();
$ClientePf = new ClientePf();
$Professor = new Professor();

$Aviso = new Aviso();

$idAviso = $_GET['id'];

//QUEM ENVIA A MSG
$idFuncionario = $_SESSION['idFuncionario_SS'];

if($idAviso){
    
	$valor = $Aviso->selectAviso(" WHERE idAviso = ".$idAviso);
	//QUEM RECEBE A MSG
	$idClientePf_enviou = $valor[0]['clientePf_idClientePf_enviou'];
	$idClientePj_enviou = $valor[0]['clientePj_idClientePj_enviou'];	
	$idProfessor_enviou = $valor[0]['professor_idProfessor_enviou'];
	$idFuncionario_enviou = $valor[0]['funcionario_idFuncionario_enviou'];
	
	//DADOS
	$tituloAviso = $valor[0]['tituloAviso'];
	$aviso = $valor[0]['aviso'];
	$dataAviso = Uteis::exibirData($valor[0]['dataAviso']);
	 
	//MARCAR COMO LIDO
	$lido = $valor[0]['lido'];
	$dataVisualizacao = $valor[0]['dataVisualizacao'];
	if( !$lido || !$dataVisualizacao ){
		$Aviso->setIdAviso($idAviso);
		$Aviso->updateFieldAviso("lido", "1");   
		$Aviso->updateFieldAviso("dataVisualizacao", date('Y-m-d H:i:s'));   
	}
	
}else{
	//QUEM RECEBE A MSG
	$idClientePf_enviou = $_GET['idClientePf'];
	$idClientePj_enviou = $_GET['idClientePj'];	
	$idProfessor_enviou = $_GET['idProfessor'];
	$idFuncionario_enviou = $_GET['idFuncionario'];
		
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Avisos</legend>
    <?php if($idAviso){?>
     
        <form class="validate">
         <div class="esquerda">
         <p>
            <label>Titulo:</label>
            <?php echo $tituloAviso?> - <?php echo $dataAviso?></p>
       
          <p>
          
            <label>Mensagem:</label>
           <?php echo $aviso?>
          </p>
        </form>
     
        
        <form id="form_Aviso" class="validate" method="post" action="" onsubmit="return false" >
          
          <p><strong>Responder:</strong></p>
          <input type="hidden" name="idAviso" id="idAviso" class="required" value="<?php echo $idAviso?>" />
          
          <input type="hidden" name="idFuncionario_enviou" id="idFuncionario_enviou" value="<?php echo $idFuncionario?>" />
          
          <input type="hidden" name="idClientePf" id="idClientePf" value="<?php echo $idClientePf_enviou?>" />
          <input type="hidden" name="idClientePj" id="idClientePj" value="<?php echo $idClientePj_enviou?>" />
          <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor_enviou?>" />
          <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario_enviou?>" />

          <p>
            <label>Titulo:</label>
            <input type="text" name="titulo" id="titulo" value="" class="required"/>
            <span class="placeholder">Campo obrigatório</span></p>
          <p>
            <label>Resposta:</label>
            <textarea name="aviso_base" id="aviso_base" ></textarea>
	        	<textarea name="aviso" id="aviso" class="required" ></textarea>
            <span class="placeholder">Campo obrigatório</span></p>
          <p>
            <button class="button blue" onclick="postForm_editor('aviso', 'form_Aviso', '<?php echo CAMINHO_CAD."aviso/include/acao/aviso.php"?>');">Salvar</button>
          </p>
        </form>
      </div>
            <script>
        ativarForm();
        viraEditor('aviso');
        </script> 
    <?php }else{?>
       
      <form id="form_Aviso" class="validate" method="post" action="" onsubmit="return false" >
         <div class="esquerda">
        <p><strong>Novo aviso:</strong></p>
        
        <input type="hidden" name="idFuncionario_enviou" id="idFuncionario_enviou" value="<?php echo $idFuncionario?>" />
        
    <!--    <input type="hidden" name="idClientePf" id="idClientePf" value="<?php echo $idClientePf_enviou?>" />
        <input type="hidden" name="idClientePj" id="idClientePj" value="<?php echo $idClientePj_enviou?>" />
        <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor_enviou?>" />
        <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario_enviou?>" />-->
        <p>
          <label>Titulo:</label>
          <input type="text" name="titulo" id="titulo" value="" class="required"/>
          <span class="placeholder">Campo obrigatório</span></p>
          
             </div>
          <div class="direita">
          <p><strong>Quem Recebe:</strong></p>
          <p>
          <label>Funcionário:</label>
          <?php echo $Funcionario->selectFuncionarioSelect(); ?>
          </p>
          <p>
          <label>Aluno:</label>
          <?php echo $ClientePf->selectClientePfSelect();?>
          </p>
          <p>
          <label>Professor:</label>
          <?php echo $Professor->selectProfessorSelect();?>
          </p>
          </div>
          <div class="linha-inteira">
        <p>
          <label>Mensagem:</label>
          <textarea name="aviso_base" id="aviso_base" class="tinymce" ></textarea>
	        <textarea name="aviso" id="aviso" class="required" ></textarea>
          <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <button class="button blue" onclick="postForm_editor('aviso', 'form_Aviso', '<?php echo CAMINHO_CAD."aviso/include/acao/aviso.php"?>');">Salvar</button>
        </p>
        </div>
      </form>
      
      <script>
        ativarForm();
        viraEditor('aviso');
        </script> 
    <?php }?>
  </fieldset>
</div>
