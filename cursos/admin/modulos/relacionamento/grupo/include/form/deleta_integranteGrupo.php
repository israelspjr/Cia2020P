<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntengranteGrupo = new IntegranteGrupo();
$ClientePf = new ClientePf();
$Configuracoes = new Configuracoes();
ini_set("display_errors", 1);

$config = $Configuracoes->selectConfig();

$idIntegranteGrupo = $_REQUEST['id'];

$idClientePf = $IntengranteGrupo->getIdClientePf($idIntegranteGrupo);

$grupos = $ClientePf->gruposClientePf(" AND CPF.idClientePf = ".$idClientePf." AND G.inativo = 0");

$qtd = 0;
	$html = "Esse aluno pertence à esses grupos:<br>";
foreach ($grupos AS $value) {
	$qtd++;
	$html .= $value['nome']."<br>";
}

$nome = $ClientePf->getNome($idClientePf);
$email = $ClientePf->getEmail($idClientePf);

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Desvincular integrante</legend>
    <form id="form_finalizar" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="acao" id="acao" value="deletar"/>
        <div class="direita">
      <p>
      <?php if ($qtd > 1) {
		  echo $html;
	  } ?>
      </p>
       <p><label>Excluir definitavamente do grupo</label>
       <input type="checkbox" name="deletar" id="deletar" value="1" onclick="deletarIntegrante()"/><p style="color:#cc0000"><strong>Procedimento só funciona no caso do aluno não tenha iniciado as aulas no grupo</strong></p>
       </p>

      </div>

     
      <p>
        <label>Data de saida do grupo:</label>
        <input type="text" name="dataSaida" id="dataSaida" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      
      <p>
        <label>Data de saida do demonstrativo:<br>
            <font color="#cc0000"><strong>Preencher com a data que esta pessoa não participará mais do rateio do curso</strong></font></label>        
            <input type="text" name="dataSaidaDemonstrativo" id="dataSaidaDemonstrativo" class="required data"/>
            <span class="placeholder">Campo Obrigatório</span> 
      </p>      
      <p>
        <label>Motivo da saída do grupo:<br></label> 
            <textarea name="motivo" id="motivo" class="required"></textarea> 
            <span class="placeholder">Campo Obrigatório</span>                 
      </p>
       <p>
        <label>Data para retorno:</label>
        <input type="text" name="dataRetorno" id="dataRetorno" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      
      <p>
      
      <label> <input type="checkbox" name="inativar" id="inativar" value="1" onclick="rdStation();"/> Desejo inativar esse aluno</label>
      </p>
      <p>
      <label>Qual área deve entrar em contato?</label>
      <input type="radio" name="area" id="area" value="0" checked/>Comercial
      <input type="radio" name="area" id="area" value="1" />Coordenação
      </p>
        <button class="button blue" 
        onclick="postForm('form_finalizar', '<?php echo CAMINHO_REL."grupo/include/acao/integranteGrupo.php?id=".$idIntegranteGrupo?>')">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();

	function rdStation() {

var nome = '<?php echo $nome;?>'; 
var email = '<?php echo $email;?>'; 
var tel = "";
var site = "Aluno inativado";
//console.log(nome);
//	console.log(email);
//	console.log(tel);
		$.ajax({
  method: "POST",
  url: "<?php echo 'https://'.$config[0]['site'];?>/cursos/integraRD.php",
  data: { nome: nome, email:email, tel:tel, fonte:site }
})
  .done(function( msg ) {
   console.log( "Data Saved: " + msg );
  });
}

function deletarIntegrante() {
	if (confirm("Esse procedimento é irreversível, tem certeza que deseja continuar ? ") ) {
	postForm('', '/cursos/admin/modulos/relacionamento/grupo/include/acao/integranteGrupo.php?id=<?php echo $idIntegranteGrupo?>&acao=deletarF');	
	}
	
}
</script> 
