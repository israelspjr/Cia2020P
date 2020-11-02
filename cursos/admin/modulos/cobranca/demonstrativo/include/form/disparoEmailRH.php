<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
				
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Grupo_PJ = new GrupoClientePj();
$contato = new ContatoAdicional();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DemonstrativoCobranca = new DemonstrativoCobranca();
$StatusCobranca = new PlanoAcaoGrupoStatusCobranca();

$tipo = "contatoCobranca";

$TextoEmailPadrao = new TextoEmailPadrao();
      
$idDisparoEmail = $_GET['id'];      
$idClientePj = $_GET['idClientePj'];
$mes = $_GET['mes'];
/*
if($mes<10)
$mes = "0".$mes;
else
$mes = $mes;
*/
$ano = $_GET['ano'];

$assunto = "Demonstrativo de cobrança Geral - não responder a esse email"; 

$gpj = $Grupo_PJ->selectGrupoClientePj("WHERE clientePj_idClientePj = ".$idClientePj." AND (dataFim is null or dataFim <='$ano-$mes-01')");
foreach($gpj as $k => $valor):
    $pg = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE inativo = 0 AND grupo_idGrupo = ".$valor['grupo_idGrupo']);
    $demonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca("WHERE planoAcaoGrupo_idPlanoAcaoGrupo =".$pg[0]['idPlanoAcaoGrupo']." AND mes = $mes AND ano = $ano");
    if($demonstrativo[0]['idDemonstrativoCobranca']):
        $status = $StatusCobranca->selectPlanoAcaoGrupoStatusCobranca("WHERE planoAcaoGrupo_idPlanoAcaoGrupo =".$pg[0]['idPlanoAcaoGrupo']." AND mes = $mes AND ano = $ano order by dataCadastro DESC");
        if($status[0]['statusCobranca_idStatusCobranca']==5):
            $grupo[] = $valor['grupo_idGrupo'];
        endif;
    endif;    
endforeach;
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Disparo de e-mail</legend>
    <form id="form_disparoEmailRH" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idClientePj" value="<?php echo $idClientePj;?>" />
      <input type="hidden" name="mes" value="<?php echo $mes;?>" />
      <input type="hidden" name="ano" value="<?php echo $ano;?>" />
      <input type="hidden" name="grupos" value="<?php echo implode(',', $grupo);?>" />
      <div class="esquerda">
        <p>
          <label>Assunto</label>
          <input type="text" name="assunto" id="assunto" value="<?php echo $assunto;?>" class="required" />
        </p>
        <p>        
      </div>       
         <div class="esquerda">
          <label><strong>Contato(s) Empresa:</strong></label>
          <?php echo $contato->selectContatoAdcionalCheck($idClientePj, $tipo);?> 
        </p>
      </div>
       <div class="linha-inteira" >
        <p>
          <label>Cópia</label>
          <img id="copiaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA" />
          <input type="text" name="copiaAux" id="copiaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA" />
        <select multiple="multiple" name="copia[]" id="copia" >
        </select>
        </p>
        <p>
          <label>Cópia oculta</label>
          <img id="copiaOcultaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA CÓPIA OCULTA" />
          <input type="text" name="copiaOcultaAux" id="copiaOcultaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaOcultaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA OCULTA" />
        <select multiple="multiple" name="copiaOculta[]" id="copiaOculta"  >
        </select>
        </p>
       
      </div> 
      <div class="linha-inteira">
      <p>      
          <button class="button blue" onclick="dispara()">Enviar</button>
          
        </p>
      </div>
    </form>
  
  </fieldset>
</div>
<script src="<?php echo CAMINHO_CFG."js/email.js"?>" type="text/javascript" ></script>
<script>
function dispara(){
	$('#copia').find('option').attr('selected', true);
	$('#copiaOculta').find('option').attr('selected', true);
	postForm('form_disparoEmailRH', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/acao/disparoEmailRH.php?idClientePj=".$idClientePj?>');	
}
ativarForm(); 
</script>