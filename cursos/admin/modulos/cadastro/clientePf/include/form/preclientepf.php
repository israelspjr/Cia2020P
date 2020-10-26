 <?php
$email = "";
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Funcionario = new Funcionario();
$PreClientePf = new PreClientePf();
$ClientePj = new ClientePj();

$valor = $PreClientePf-> selectPreClientepf("Where idPreClientePf = ".$idClientePf);

$nomeExibicao = $valor[0]['nome'];
$email = $valor[0]['email'];
$idFuncionario = $valor[0]['funcionario_idFuncionario'];
$idClientePj = $valor[0]['clientePj_idClientePj'];



?>

<fieldset>
  <legend>Dados básicos</legend>  
   <form id="form_clientepf" class="validate" action="" method="post"  onsubmit="return false" >
      <div class="esquerda">
 <p>
           <label>Nome para exibição:</label>
          <input type="text" name="nomeExibicao" id="nomeExibicao" value="<?php echo $nomeExibicao?>" class="required" />
          <span class="placeholder">Campo Obrigatório</span> </p>
     <p>
          <label>Email:</label>
          <input type="text" name="email" id="email" class="required" value="<?php echo $email?>"  />
          <span class="placeholder">Campo Obrigatório</span> </p>
          
         <p>
          <label> Empresa vinculada </label>
          <?php echo $ClientePj->selectClientePjSelect($idClientePj,"required"," AND inativo = 0"); ?>
          </p>
          
        </div>
      <div class="linha-inteira">
        <p>1º 
         <button class="button blue" onclick="salvar();postForm('form_clientepf', '<?php echo CAMINHO_CAD."clientePf/include/acao/aviso.php"?>')">Avisar aluno e salvar</button>
         <div style="display:none">
          <button class="button blue" id="salvar2" onclick="postForm('form_clientepf', '<?php echo CAMINHO_CAD."clientePf/include/acao/preClientePf.php"?>')">Salvar</button>
          </div>
          
        </p>
      </div>
    </form>

</fieldset>

<script>
ativarForm();

	function rdStation() {

var nome = $("#nomeExibicao").val(); 
var email = $("#email").val(); 
var tel = "";
var site = "Novo Aluno";
//console.log(nome);
//	console.log(email);
//	console.log(tel);
		$.ajax({
  method: "POST",
  url: "https://www.companhiadeidiomas.net/cursos/integraRD.php",
  data: { nome: nome, email:email, tel:tel, fonte:site }
})
  .done(function( msg ) {
   console.log( "Data Saved: " + msg );
  });
}

function salvar() {
 rdStation();
	$('#salvar2').click();	
	
}

</script> 
