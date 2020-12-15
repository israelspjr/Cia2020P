<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idClientePf = $_GET['idClientePf'];
$idClientePj = $_GET['idClientePj'];
$idGrupo = $_GET['idPlanoAcaoGrupo'];
$idProfessor = $_GET['idProfessor'];
$idFuncionario = $_REQUEST['idFuncionario'];


$idContrato = $_GET['id'];

$Contrato = new Contrato();
if($idContrato != '' && is_numeric($idContrato)){
	$valor = $Contrato->selectContrato("WHERE idContrato =".$idContrato);
	$contrato =$valor[0]['contrato'];
	$obs =$valor[0]['obs'];
}


?>
<script>
	function aguardarCarregamento(){		
		if( $('#visualizar_contrato[status=esperando]').length > 0 ){
			alerta('Aguarde o final do carregamento do contrato');
		}else{
			postForm('form_contrato', '<?php echo CAMINHO_CAD?>contrato/include/acao/contrato.php?id=<?php echo $idContrato?>');
		}
	}
</script>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Boletos / Contrato / Geral</legend>
    <form id="formulario_upload_contrato" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD?>contrato/include/acao/contrato.php" style="display:none;">
      <input type="hidden" id="acao" name="acao" value="file" />
      <input type="hidden" id="acao" name="idClientePf" value="<?php echo $idClientePf?>" />
      <input type="hidden" id="acao" name="idClientePj" value="<?php echo $idClientePj?>" />
      <input type="hidden" id="acao" name="idGrupo" value="<?php echo $idGrupo?>" />
      <input type="hidden" id="acao" name="idProfessor" value="<?php echo $idProfessor?>" />
      <input type="hidden" id="acao" name="idFuncionario" value="<?php echo $idFuncionario?>" />

      
      <input type="file" id="add_file_contrato" onchange="enviaArquivo();" name="file" />
    </form>
    <script>
        //$(document).ready(function(){
         /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
		 function enviaArquivo(){
            $('#visualizar_contrato').attr({'status':'esperando'}).html('Carregando arquivo...')
            $('#formulario_upload_contrato').ajaxForm({
                target:'#visualizar_contrato', // o callback será no elemento com o id #visualizar	
				success: function() {
					$('#visualizar_contrato').removeAttr('status');
					alert('Arquivo carregado');
				}
             }).submit();
		 }
     //})
    </script>
    <form id="form_contrato" class="validate" method="post" action="" onsubmit="return false" >
     <input type="hidden" id="acao" name="idClientePf" value="<?php echo $idClientePf?>" />
     <input type="hidden" id="acao" name="idClientePj" value="<?php echo $idClientePj?>" />
     <input type="hidden" id="acao" name="idGrupo" value="<?php echo $idGrupo?>" />
     <input type="hidden" id="acao" name="idProfessor" value="<?php echo $idProfessor?>" />
      <p>
      <label>Nome:</label>
      <input type="text" name="obs" id="obs" value="<?php echo $obs?>" class="required" />
      <span class="placeholder">Campo obrigatório</span>
      </p>
      <p>
      <label>Não mostrar para o aluno</label>
      <input type="checkbox" name="naoMostrar" id="naoMostrar" value="1" />
      
      </p>
      <p>
        <label>Contrato:</label>
        
        <img style="float:left;" src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file_contrato').click();" title="Anexar novo"/>
        
        <div id="visualizar_contrato" >
         <p><input type="text" name="file_oculto_contrato" readonly="readonly" value="<?php echo $contrato?>" class="required"/>
         <span class="placeholder">Insira um arquivo</span></p>
        </div>
        
      </p>
      
      <p>
        <button class="button blue" onclick="aguardarCarregamento()">Salvar</button>
      
        
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();</script> 
