<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Relatorio = new Relatorio();	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$CalendarioProva = new CalendarioProva();
$PlanoAcao = new PlanoAcao();
$ProvaOn = new ProvaOn();
$ProvaOnQuestoes = new ProvaOnQuestoes();
$Questao = new Questao();

$idClientePf = $_SESSION['idClientePf_SS'];

$idCalendarioProva = $_REQUEST['idCalendarioProva'];

$where = " WHERE idCalendarioProva = ".$idCalendarioProva;

$valorProva = $CalendarioProva->selectCalendarioProva($where);

$idPlanoAcaoGrupo = $valorProva[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);

$idFoco = $PlanoAcaoGrupo->getIdFoco($idPlanoAcaoGrupo);

$idIdioma = $PlanoAcao->getIdIdioma($idPlanoAcao);

$nivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);

$valorProvaOn = $ProvaOn->selectProvaOn(" WHERE focoCurso_idFocoCurso =".$idFoco." AND nivelEstudo_idNivelEstudo = ".$nivel." AND idioma_IdIdioma = ".$idIdioma);

$valorQuestoes = $ProvaOnQuestoes->selectProvaOnQuestoes(" WHERE provaOn_idProvaOn = ".$valorProvaOn[0]['idProvaOn']." ORDER BY id ASC");

$dataAtual = date("Y-m-t");
$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($idClientePf, $idPlanoAcaoGrupo, $dataAtual);

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <fieldset>
  <p>Prova: <strong><?php echo $valorProvaOn[0]['nome']?></strong></p>
  
    <legend>Questões:</legend>
    
 <?php
 $x = 1;
 foreach ($valorQuestoes AS $valor) {
	 $titulo = $Questao->getTitulo($valor['questao_idQuestao']);
	 $enunciado = $Questao->getEnunciado($valor['questao_idQuestao']);	
	 $imagem = $Questao->getImagem($valor['questao_idQuestao']);
	 $audio = $Questao->getAudio($valor['questao_idQuestao']);
	$audio2 = $Questao->getAudio2($valor['questao_idQuestao']);
	$audio3 = $Questao->getAudio3($valor['questao_idQuestao']);
	$audio4 = $Questao->getAudio4($valor['questao_idQuestao']);
	
	
	 $html .= "<hr>";
	 $html .= "<p>Questão número: ".$x."</p>";
	 $html .=  "<form id=\"form_".$x."\" class=\"validate\" action=\"\" method=\"post\" onsubmit=\"return false\">";
     $html .= "<input type=\"hidden\" id=\"idCalendarioProva\" value=\"".$idCalendarioProva."\" name=\"idCalendarioProva\"/>";
	 $html .=  "<input type=\"hidden\" id=\"idQuestao\" value=\"".$valor['questao_idQuestao']."\" name=\"idQuestao\"/>";
     $html .=  "<input type=\"hidden\" id=\"idIntegranteGrupo\" value=\"".$idIntegranteGrupo."\" name=\"idIntegranteGrupo\"/>";
	 $html .=  "<input type=\"hidden\" id=\"questao\" value=\"".$x."\" name=\"questao\"/>";
 
	 
	 if ($imagem != '') {
		$html .= "<p><img src=\"".CAMINHO_UP."imagem/questoes/".$imagem."\" width=\"300px\" />";
	 }
	 
	 if ($audio != '') {
		$html .= "<p><video controls=\"\" style=\"height: 20px;width: 100%;\" name=\"media\" <source=\"\" src=\"/cursos/upload/imagem/questoes/".$audio."\" type=\"audio/mpeg\"></video></p>"; 
		 
	 }
	 
	  if ($audio2 != '') {
		$html .= "<p><video controls=\"\" style=\"height: 20px;width: 100%;\" name=\"media\" <source=\"\" src=\"/cursos/upload/imagem/questoes/".$audio2."\" type=\"audio/mpeg\"></video></p>"; 
		 
	 }
	 
	  if ($audio3 != '') {
		$html .= "<p><video controls=\"\" style=\"height: 20px;width: 100%;\" name=\"media\" <source=\"\" src=\"/cursos/upload/imagem/questoes/".$audio3."\" type=\"audio/mpeg\"></video></p>"; 
		 
	 }
	 
	  if ($audio4 != '') {
		$html .= "<p><video controls=\"\" style=\"height: 20px;width: 100%;\" name=\"media\" <source=\"\" src=\"/cursos/upload/imagem/questoes/".$audio4."\" type=\"audio/mpeg\"></video></p>"; 
		 
	 }
	 
	 $html .= "<p>".$titulo."</p>";
	 $html .= "<p>".$enunciado."</p>";	 
     $html .= "<p> <textarea name=\"questao_".$x."\" id=\"questao_".$x."\" rows=\"10\" cols=\"70\" class=\"\"></textarea></p>";
	 $html .= "<p> <button class=\"Bblue\" id=\"btn".$$x."\" onclick=\"gravarQuestao('form_".$x."', ".$x.");\" >Salvar</button></p></form>";
	 $html .= "<div id=\"resultadoF".$x."\"></div>";
	 
	 
	 
	 $x++;
 }
 
 echo $html;
 
 
 ?>

    
  </fieldset>  
    
 
</div>
<button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/provas/index.php', '#centro');">Fechar</button>
<button class="Bblue" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/provas/acao/gravarQuestao.php?finalizar=1', '#centro');">Finalizar Prova</button>
<script>
tabelaDataTable('tb_lista_res', 'simples');

function gravarQuestao(form, x){
	$('#resultadoF'+x).html("Gravado com sucesso!");
	postForm(form, '/cursos/portais/modulos/provas/acao/gravarQuestao.php');
}
</script>