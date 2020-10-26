<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$EnderecoVirtual = new EnderecoVirtual();
$ClientePf = new ClientePf();

$clientePfIdClientePf = $_GET['idClientePf'];
$contatoAdicionalIdContatoAdicional = $_GET['idContatoAdicional'];
$funcionarioIdFuncionario = $_GET['idFuncionario'];
$professorIdProfessor = $_GET['idProfessor'];

$idEnderecoVirtual = $_GET['id'];

if ($idEnderecoVirtual != '') {

  $valorEnderecoVirtual = $EnderecoVirtual -> selectEnderecovirtual("WHERE idEnderecoVirtual=" . $idEnderecoVirtual);

  //CHAVES ESTRANGEIRAS
  $clientePfIdClientePf = $valorEnderecoVirtual[0]['clientePf_idClientePf'];
  $contatoAdicionalIdContatoAdicional = $valorEnderecoVirtual[0]['contatoAdicional_idContatoAdicional'];
  $funcionarioIdFuncionario = $valorEnderecoVirtual[0]['funcionario_idFuncionario'];
  $professorIdProfessor = $valorEnderecoVirtual[0]['professor_idProfessor'];
  //
  $tipoEnderecoVirtual_idTipoEnderecoVirtual = $valorEnderecoVirtual[0]['tipoEnderecoVirtual_idTipoEnderecoVirtual'];
  $valor = $valorEnderecoVirtual[0]['valor'];
  $ePrinc = $valorEnderecoVirtual[0]['ePrinc'];
  //print_r($valorEnderecoVirtual);
}

if ($clientePfIdClientePf > 0 ) {
	 $valorEnderecoVirtualC = $EnderecoVirtual -> selectEnderecovirtual("WHERE clientePf_idClientePf=" . $clientePfIdClientePf);
	 
	 $ePrinc2 = $valorEnderecoVirtualC[0]['ePrinc'];

}

if (($ePrinc == 0) && ($ePrinc2 == 0)) {
	$ePrinc = 1;
}

$nome = $ClientePf->getNome($clientePfIdClientePf);
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Endereços Virtuais
		</legend>
		<form id="form_enderecoVirtual" class="validate" method="post" onsubmit="return false" >
			<input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
            <input name="nomeCliente" id="nomeCliente" type="hidden" value="<?php echo $nome;?>" />
			<input name="contatoAdicional_IdContatoAdicional" type="hidden" value="<?php echo $contatoAdicionalIdContatoAdicional?>" />
			<input name="funcionario_idFuncionario" type="hidden" value="<?php echo $funcionarioIdFuncionario?>" />
			<input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
			<p>
				<label>Tipo do endereço virtual:</label>
				<?php echo $TipoEnderecoVirtual -> selectTipoenderecovirtualSelect("required", $tipoEnderecoVirtual_idTipoEnderecoVirtual); ?>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Endereco:</label>
				<input type="text" name="valor" id="valor" class="required" value="<?php echo $valor?>"/>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
			<p id="princ" sytle="display:none;">
            <?php if($ePrinc2==1) {
				echo "<p style=\"color:red;\">Atenção já existe um email principal</p>"; 
			}?>
				<label>
					<input type="checkbox" id="princ" name="princ" value="1" <?php if($ePrinc==1){?>Checked<?php } ?>>
					receber emails do sistema por este endereço</label>
			</p>
			<p>
			<p>
				<button class="button blue" onclick="enviar();">
					Salvar
				</button>

			</p>
		</form>
	</fieldset>
</div>
<script>

	function enviar() {
			rdStation();
			postForm('form_enderecoVirtual', '<?php echo CAMINHO_CAD?>enderecoVirtual/include/acao/enderecoVirtual.php?id=<?php echo $idEnderecoVirtual?>');
		
	}
	
	function rdStation() {

var nome = $('#nomeCliente').val();
var email = $('#valor').val();
var tel = "00000000";
var site = 'Novo Aluno cadastro feito pelo admin';
//console.log(nome);
//	console.log(email);
//	console.log(tel);
		$.ajax({
  method: "POST",
  url: "https://www.companhiadeidiomas.net/cursos/integraRD.php",
  data: { nome: nome, email:email, tel:tel, fonte:site }
})
 // .done(function( msg ) {
 //  console.log( "Data Saved: " + msg );
//  });
	}

	var $idTipo = $('#form_enderecoVirtual #idTipo');

	function verificaEmail() {

		var $valor = $('#form_enderecoVirtual #valor');

		if ($idTipo.val() == 1) {
			$valor.addClass('email');
			$("#princ").show();
		} else {

			$valor.removeClass('email');
			$("#princ").hide();
		}
	}


	$idTipo.attr('onchange', 'verificaEmail()');

	ativarForm();

</script>
