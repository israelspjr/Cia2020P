<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
			
$Batismo = new Batismo();
$Proposta = new Proposta();
$PlanoAcao = new PlanoAcao();	
$GrupoClientePj = new GrupoClientePj();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Grupo = new Grupo();
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
$IntegrantePlanoAcao = new IntegrantePlanoAcao();
$SubvencaoCursoPlanoAcao = new SubvencaoCursoPlanoAcao();
$SubvencaoMaterialPlanoAcao = new SubvencaoMaterialPlanoAcao();
$ClientePf = new ClientePf();


$idPlanoAcao = $_GET['id'];
	
$valorPlanoAcao = $PlanoAcao->selectPlanoAcao('WHERE idPlanoAcao='.$idPlanoAcao);	
$proposta_idProposta = $valorPlanoAcao[0]['proposta_idProposta'];
$tipoContrato = $valorPlanoAcao[0]['tipoContrato'];	

if ($tipoContrato == 0) {
    $nomeContrato = "Prazo indeterminado";
} elseif($tipoContrato == 1) {
	$nomeContrato = "Pacote de horas ";
} elseif($tipoContrato == 2) {
	$nomeContrato = "Prazo Determinado (Verificar Contrato)";
	
}
										

//SELECIONA TODOS OS GRUPOS DO MEMSO CLIENTE	
$idClientePj = $Proposta->selectProposta(" WHERE idProposta = ".$proposta_idProposta);
$idClientePj = $idClientePj[0]['clientePj_idClientePj']!='' ? $idClientePj[0]['clientePj_idClientePj'] : "0";

$valorGrupoClientePj = $GrupoClientePj->selectGrupoClientePj(" WHERE clientePj_idClientePj = ".$idClientePj);
$valorGrupoClientePj = implode(",", Uteis::arrayCampoEspecifico($valorGrupoClientePj, "grupo_idGrupo"));	
$valorGrupoClientePj = $valorGrupoClientePj!='' ? $valorGrupoClientePj : "0";

$valorGrupo = $Grupo->selectGrupo(" WHERE idGrupo IN (".$valorGrupoClientePj.")");
$valorGrupo = Uteis::arrayCampoEspecifico($valorGrupo, "nome");
$valorGrupo = $valorGrupo!="" ? $valorGrupo : "";

?>

<form id="form_batismo" class="validate" action="" method="post" onsubmit="return false" >
  
  <input type="hidden" name="idClientePj" id="idClientePj" value="<?php echo $idClientePj ?>" />
  
  <div class="linha-inteira"> <img src="<?php echo CAMINHO_IMG."mais.png"?>" title="ABRIR/FECHAR LISTA DE GRUPOS" id="img_PlanoAcao" 
    onclick="abrirFormulario('div_listaGrupos', 'img_PlanoAcao');" /><strong>Grupos existentes para este cliente.</strong>
    <div class="agrupa" id="div_listaGrupos" style="display:none;padding:1em;">
      <?php 
    if( $valorGrupo!="" ){
			foreach($valorGrupo as $nomeGrupo) echo $nomeGrupo."<br />";
    }else{
    	echo "Ainda não existem grupos.";
    }
    ?>
    </div>
  </div>
  
  <div class="linha-inteira"> <img src="<?php echo CAMINHO_IMG."mais.png"?>" title="ABRIR/FECHAR LISTA DE GRUPOS" id="img_valores" 
    onclick="abrirFormulario('div_valores', 'img_valores');" /><strong>Valores/dias.</strong>
    <div class="agrupa" id="div_valores" style="display:none;padding:1em;">
      <?php 
    $ValorSimuladoPlanoAcao->setPlanoAcaoIdPlanoAcao($idPlanoAcao);
    echo $ValorSimuladoPlanoAcao->listaValorSimuladoPlanoAcao();
    ?>
    </div>
  </div>
  
  <div>
  <?php
   echo "Plano Professor:<img src=\"".CAMINHO_IMG."ver16.png\" 
                    onclick=\"window.open('".CAMINHO_PA."index.php?p=".Uteis::base64_url_encode($idPlanoAcao)."&a=".Uteis::base64_url_encode(2)."');\">";    
					$PlanoAcao->setIdPlanoAcao($idPlanoAcao);
				//	echo $PlanoAcao->ImprimePlanoAcao("1");
  
  ?>
  
  </div>
  
  <div class="linha-inteira">
    <div class="esquerda">
      <p>
        <label>Nome do grupo:</label>
        <input type="text" name="nomeGrupo" id="nomeGrupo" class="required" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Ínicio do estágio:</label>
        <input type="text" name="dataInicioEstagio" id="dataInicioEstagio" class="required data" value="" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Previsão de término do estágio:</label>
        <img src="<?php echo CAMINHO_IMG?>/carrega.png" title="Calcular data de término prevista" onclick="carregaDataFinal()" />
        <input type="text" name="dataPrevisaoTerminoEstagio" id="dataPrevisaoTerminoEstagio" class="data" value="" />
      </p>
      <p>
      <label>Tipo de contrato: <?php echo $nomeContrato?></label>
      
    </div>
     <div class="direita">
        <p>
        <label>Categoria:</label>
        <input type="checkbox" id="sem_estrela" <?php echo ($cat[0] = 0) ? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela_branco.gif"?>"> Grupro sem nehuma estrela<br>
        <input type="checkbox" name="categoria[]" id="estrela_1" value="1" <?php echo ($cat[0] = 1)? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela.gif"?>"> é aluno há mais de 3 anos(Lealdade)<br>
        <input type="checkbox" name="categoria[]" id="estrela_2" value="2" <?php echo ($cat[1] = 2)? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela.gif"?>"> ele ou alguém de seu grupo indica alunos (registrar quem indica) ou é RH (PROMOTOR)<br>
        <input type="checkbox" name="categoria[]" id="estrela_3" value="3" <?php echo ($cat[2] = 3)? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela.gif"?>"> há um mínimo de três grupos nessa empresa (PROPAGAÇÃO DA MARCA)<br>
        <input type="checkbox" name="categoria[]" id="estrela_4" value="4" <?php echo ($cat[3] = 4)? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela.gif"?>"> paga valor máximo atual e/ou realiza mais de três horas semanais (LUCRO)<br>
        <input type="checkbox" name="categoria[]" id="estrela_5" value="5" <?php echo ($cat[4] = 5)? "checked" : ""?> /><img src="<?php echo CAMINHO_IMG."/estrela.gif"?>"> tem aulas individuais (ALUNO É FORMADOR DE OPINIÃO,TEM PODER)<br>
      </p>
    </div>
  </div>
  
  <?php 
	$valorIntegrantePlanoAcao = $IntegrantePlanoAcao->selectIntegrantePlanoAcao(" WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao);
	
	for($row=0; $row<count($valorIntegrantePlanoAcao,0); $row++){
	
		$IntegrantePlanoAcao->setClientePfIdClientePf( $valorIntegrantePlanoAcao[$row]['clientePf_idClientePf'] );
		$nomeIntegrante = $IntegrantePlanoAcao->nomeIntegrantePlanoAcao();
		$idIntegrantePlanoAcao = $valorIntegrantePlanoAcao[$row]['idIntegrantePlanoAcao'];	
		$idClientePf = $valorIntegrantePlanoAcao[$row]['clientePf_idClientePf'];
		
	//	$valorCPF = $ClientePf->selectClientePf(" WHERE idClientePf = ".$idClientePf);
		
	//	$tipoCliente = $valorCPF[0]['tipoCliente_idTipoCliente'];	
		
		$where = " WHERE integrantePlanoAcao_idIntegrantePlanoAcao = ".$idIntegrantePlanoAcao;
		
		$valorSubvencaoCursoPlanoAcao = $SubvencaoCursoPlanoAcao->selectSubvencaoCursoPlanoAcao($where);
		
		$subvencao_curso = $valorSubvencaoCursoPlanoAcao[0]['subvencao'];
		$teto_curso = Uteis::formatarMoeda($valorSubvencaoCursoPlanoAcao[0]['teto']);
		$quemPaga_curso = $valorSubvencaoCursoPlanoAcao[0]['quemPaga'];
				
		$valorSubvencaoMaterialPlanoAcao = $SubvencaoMaterialPlanoAcao->selectSubvencaoMaterialPlanoAcao($where);
		
		$subvencao_material = $valorSubvencaoMaterialPlanoAcao[0]['subvencao'];
		$teto_material = Uteis::formatarMoeda($valorSubvencaoMaterialPlanoAcao[0]['teto']);
		$quemPaga_material = $valorSubvencaoMaterialPlanoAcao[0]['quemPaga'];
		
		
		?>
    
    <br /><br />
    
    <fieldset>
      <legend>
			<img src="<?php echo CAMINHO_IMG."cad.png"?>" title="Cadastro do aluno" 
      onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/cadastro.php?id=$idClientePf"?>', '', '')" >
			<?php echo $nomeIntegrante?></legend>
      <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR/FECHAR LISTA DE GRUPOS" id="img_PlanoAcao_<?php echo $idIntegrantePlanoAcao?>" 
        onclick="abrirFormulario('div_IntegrantePlanoAcao_<?php echo $idIntegrantePlanoAcao?>', 'img_PlanoAcao_<?php echo $idIntegrantePlanoAcao?>');" />
      <div class="agrupa" id="div_IntegrantePlanoAcao_<?php echo $idIntegrantePlanoAcao?>" style="display:">
        <div class="linha-inteira">
          <p>
            <label>Frequencia de envio da pesquisa de satisfação <small>(0 não enviará)</small>:</label>
            <input type="text" name="envioPsa_<?php echo $idIntegrantePlanoAcao?>" id="envioPsa_<?php echo $idIntegrantePlanoAcao?>" 
          value="" class="required numeric" />
            <span class="placeholder">Em dias</span> </p>
        </div>
        <div class="linha-inteira">
          <div id="sub_curso_<?php echo $idIntegrantePlanoAcao?>" class="esquerda">
            <p>
              <label><strong>Subvenção para curso:</strong></label>
            </p>
            <p>
              <label>Valor da subvenção(%):</label>
              <input type="text" name="subvencao_curso_<?php echo $idIntegrantePlanoAcao?>" id="subvencao_curso_<?php echo $idIntegrantePlanoAcao?>" value="<?php echo $subvencao_curso?>" class="required numeric" />
              <span class="placeholder">Campo obrigatório</span></p>
            <p>
              <label>Valor teto(R$):</label>
              <input type="text" name="teto_curso_<?php echo $idIntegrantePlanoAcao?>" id="teto_curso_<?php echo $idIntegrantePlanoAcao?>" value="<?php echo $teto_curso?>" class="numeric" />
              <span class="placeholder"></span></p>
            <p>
              <label>Quem pagará a subvenção acima:</label>
              <select name="quemPaga_curso_<?php echo $idIntegrantePlanoAcao?>" id="quemPaga_curso_<?php echo $idIntegrantePlanoAcao?>" class="required">
                <option value="">Selecione</option>
                <option value="E" <?php echo $quemPaga_curso=='E' ? "selected" : ""?> >Cliente Pessoa Jurídica</option>
                <option value="A" <?php echo $quemPaga_curso=='A' ? "selected" : ""?> >Cliente Pessoa Física</option>
              </select>
              <span class="placeholder">Campo obrigatório</span> </p>
            <p>
              <label>Observação:</label>
              <textarea name="obs_curso_<?php echo $idIntegrantePlanoAcao?>" id="obs_curso_<?php echo $idIntegrantePlanoAcao?>" cols="60" rows="4" ></textarea>
            </p>
          </div>
          <div id="sub_material_<?php echo $idIntegrantePlanoAcao?>" class="direita">
            <p>
              <label><strong>Subvenção para material:</strong></label>
            </p>
            <p>
              <label>Valor da subvenção(%):</label>
              <input type="text" name="subvencao_material_<?php echo $idIntegrantePlanoAcao?>" id="subvencao_material_<?php echo $idIntegrantePlanoAcao?>" value="<?php echo $subvencao_material?>" class="required numeric" />
              <span class="placeholder">Campo obrigatório</span></p>
            <p>
              <label>Valor teto(R$):</label>
              <input type="text" name="teto_material_<?php echo $idIntegrantePlanoAcao?>" id="teto_material_<?php echo $idIntegrantePlanoAcao?>" value="<?php echo $teto_material?>" class="numeric" />
              <span class="placeholder"></span></p>
            <p>
              <label>Quem pagará a subvenção acima:</label>
              <select name="quemPaga_material_<?php echo $idIntegrantePlanoAcao?>" id="quemPaga_material_<?php echo $idIntegrantePlanoAcao?>" class="required">
                <option value="">Selecione</option>
                <option value="E" <?php echo $quemPaga_material=='E' ? "selected" : ""?> >Cliente Pessoa Jurídica</option>
                <option value="A" <?php echo $quemPaga_material=='A' ? "selected" : ""?> >Cliente Pessoa Física</option>
              </select>
              <span class="placeholder">Campo obrigatório</span> </p>
            <p>
              <label>Observação:</label>
              <textarea name="obs_material_<?php echo $idIntegrantePlanoAcao?>" id="obs_material_<?php echo $idIntegrantePlanoAcao?>" cols="60" rows="4" ></textarea>
            </p>
          </div>
        </div>
        
      </div>
    </fieldset>
    
  <?php }?>
  
  <p>
    <button class="button blue" onclick="postForm('form_batismo', '<?php echo CAMINHO_REL."batismo/include/acao/batismo.php?id=".$idPlanoAcao?>');">Batizar o grupo</button>
  </p>

</form>

<script>

function ativaOutrosCampos( obj ){
  var value = $(obj).attr('from');

  if( $(obj).attr('checked') == 'checked' ){
    $('#parcelas_'+value).attr('disabled', false).addClass('required');
    $('#dataPrimeiraCobranca_'+value).attr('disabled', false).addClass('required');
    $('#dataPrevisaoEntregaMaterial_'+value).attr('disabled', false);
	$('#valor_'+value).attr('disabled', false);
  }else{
    $('#parcelas_'+value).attr('disabled', true).removeClass('invalid required');
    $('#dataPrimeiraCobranca_'+value).attr('disabled', true).removeClass('invalid required');
    $('#dataPrevisaoEntregaMaterial_'+value).attr('disabled', true);
	$('#valor_'+value).attr('disabled', true);
  }
} 

ativarForm();

function carregaDataFinal(){
	postForm('', '<?php echo CAMINHO_REL."batismo/include/acao/dataPrevisaoTerminoEstagio.php?id=$idPlanoAcao"?>', 'dataInicioEstagio='+ $('#dataInicioEstagio').val() );
}
$(document).ready(function() {
    $('#sem_estrela').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('#estrela_1').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_2').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_3').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_4').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
            $('#estrela_5').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_1').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_2').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_3').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_4').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
    $('#estrela_5').click(function(event) {
        if(this.checked) {
            $('#sem_estrela').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });
        }
    });
});
</script>