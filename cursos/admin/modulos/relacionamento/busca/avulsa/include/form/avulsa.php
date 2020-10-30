<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();
$ClientePj = new ClientePj();
$Idioma = new Idioma();
$Endereco = new Endereco();
$Grupo = new Grupo();
$Gerente = new Gerente();

$idBuscaAvulsa = $_REQUEST["idBuscaAvulsa"];

if ($idBuscaAvulsa) {

	$rsBuscaAvulsa = $BuscaAvulsa -> selectBuscaAvulsa(" WHERE idBuscaAvulsa = $idBuscaAvulsa");

	$idClientePj = $rsBuscaAvulsa[0]['clientePj_idClientePj'];
    $dataAlunoObs = $rsBuscaAvulsa[0]['alunoobs'];
	$idIdioma = $rsBuscaAvulsa[0]['idioma_idIdioma'];
	$idEndereco = $rsBuscaAvulsa[0]['endereco_idEndereco'];
	$dataApartir = Uteis::exibirData($rsBuscaAvulsa[0]['dataApartir']);
	$urgente = $rsBuscaAvulsa[0]['urgente'];
	$obs = $rsBuscaAvulsa[0]['obs'];
	$idGrupo = $rsBuscaAvulsa[0]['grupo_idGrupo'];
	$portalP = $rsBuscaAvulsa[0]['portalP'];
	$idGerente = $rsBuscaAvulsa[0]['gerente_idGerente'];
	$valorHoraAluno = $rsBuscaAvulsa[0]['valorHoraAluno'];
	
	if ($idClientePj > 0) {
	$whereG = " INNER JOIN grupoClientePj AS GCP ON GCP.grupo_idGrupo = G.idGrupo where GCP.clientePj_idClientePj = ".$idClientePj. " AND G.inativo =0";	
		
	}

}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
    <legend>Busca avulsa</legend>
    <form id="form_avulsa" class="validate" method="post" action="" onsubmit="return false">
      <input name="idBuscaAvulsa" type="hidden" value="<?php echo $idBuscaAvulsa ?>" />
      <input name="idEndereco" type="hidden" value="<?php echo $idEndereco ?>" />
      <div class="esquerda">
      <p>
        <label>Aulas partir de:</label>
        <input type="text" name="dataApartir" id="dataApartir" class="data required" value="<?php echo $dataApartir?>"  />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Empresa:</label>
        <?php echo $ClientePj -> selectClientePjSelect($idClientePj, "", " AND inativo = 0 "); ?> </p>
      <p>
       <p>
            <label>Grupos:</label>
          <?php if ($idClientePj > 0) {
			 echo $Grupo->selectGrupoSelect("", $idGrupo, $whereG);
			  
		  } else { ?><select id="idGrupo" name="idGrupo">
                 <option value="-">Selecione</option>  
            </select>
            <?php  } ?>
           
           
        </p>
        <p>
            <label>Observação visível ao Adm (Informações importante - Aluno, Obs, motivo):</label>
            <textarea name="alunoobs" id="alunoobs" class="", cols="40" rows="4"> <?php echo $dataAlunoObs; ?></textarea>
        </p>
        <p>
        <label>Idioma:</label>
        <?php
					echo $Idioma -> selectIdiomaSelect("required", $idIdioma, " AND disponivelAula = 1 ");
				?>
        <span class="placeholder">Campo Obrigatório</span></p>
      <p>
        <label>Observação visível ao professor:</label>
        <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <p>
        <label>Urgente</label>
        <input type="checkbox" name="urgente" id="urgente" <?php if($urgente != 0){ ?> checked="checked" <?php } ?> value="1" />
      </p>
       <p>
        <label>Mostrar no portal do Professor:</label>
        <input type="checkbox" name="portalP" id="portalP" <?php if($portalP != 0){ ?> checked="checked" <?php } ?> value="1" />
      </p>
      </div>
      <div class="direita">
      <p>
      <label>Coordenador:</label>
      <?php echo $Gerente->selectGerenteSimples("", $idGerente);?>
      </p>
      <p>
      <label>Valor hora Aluno:</label>
      <input type="text" name="valorHoraAluno" id="valorHoraAluno" value="<?php echo Uteis::exibirMoeda($valorHoraAluno);?>" />
      </p>
      </div>
      <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_avulsa', '<?php echo CAMINHO_REL."busca/avulsa/include/acao/avulsa.php?idBuscaAvulsa=$idBuscaAvulsa"?>');"> Enviar</button>
      </p>
      </div>
    </form>
    <?php if( $idBuscaAvulsa){?>
    <br />
    <div id="div_cadastro_enderecoAvulsa" >
      <p>
        <button class="button gray" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."busca/avulsa/include/form/endereco.php?idEndereco=$idEndereco&idBuscaAvulsa=$idBuscaAvulsa"?>', '<?php echo CAMINHO_REL."busca/avulsa/include/form/avulsa.php?id=$idBuscaAvulsa"?>', '')" > <?php echo ( !$idEndereco ? "Cadastrar endereço" : "Editar endereço")?> </button>
        <p><strong><?php echo $idEndereco ? $Endereco->getEnderecoCompleto($idEndereco) : "" ?></strong></p>
      </p>
    </div>
    <?php } ?>
  </fieldset>
</div>
<script>
    ativarForm();
function grupos(){
  var status, clientePj, retorno;
  $("#idGrupo").empty();
  $("#idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#idGrupo" ).append( html );
  });
  
}
$('#clientePj_idClientePj').attr('onchange','grupos()');
//grupos();
</script>