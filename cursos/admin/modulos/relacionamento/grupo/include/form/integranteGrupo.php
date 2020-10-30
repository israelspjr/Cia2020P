<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$ClientePf = new ClientePf();
$Professor = new Professor();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<fieldset>
  <legend>Novo aluno</legend>
  <form id="form_Novo_aluno" class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
    <p>
      <label>Novo aluno:</label>
      <?php 		
	$and .= " AND clientePj_idClientePj IN ("; 
	$and .= "	SELECT DISTINCT(GPJ.clientePj_idClientePj) FROM  planoAcaoGrupo AS PAG ";
	$and .= "	INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo ";
	$and .= "	INNER JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo ";
	$and .= "	WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
	$and .= ") ";
	$and .= " AND idClientepf NOT IN ("; 
	$and .= "	SELECT clientePf_idClientePf FROM integranteGrupo AS IG ";
	$and .= "	WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
	$and .= "	AND (IG.dataSaida > CURDATE() OR IG.dataSaida IS NULL OR IG.dataSaida = '') ";
	$and .= ") OR clientePj_idClientePj2 IN (SELECT DISTINCT
            (GPJ.clientePj_idClientePj)
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
                INNER JOIN
            grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
        WHERE
            PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.")";
	//IG.dataEntrada < CURDATE() AND 
	
	?>
    <div id="ativos">
	<?php
	echo $ClientePf->selectClientePfSelect("", "", $and)?>
    </div>
    
    <div id="inativos" style="display:none;">
    <span> <strong>Ao Inserir no grupo esse aluno será ativado automaticamente</strong></span><<br />
    <?php	//echo $ClientePf->selectClientePfSelect("required", "", $and, 1)?>
    
      <span class="placeholder">Campo Obrigatório</span> </p>
    </div>
       <?php 		
	$and = " AND clientePj_idClientePj IN ("; 
	$and .= "	SELECT DISTINCT(GPJ.clientePj_idClientePj) FROM  planoAcaoGrupo AS PAG ";
	$and .= "	INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo ";
	$and .= "	INNER JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo ";
	$and .= "	WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
	$and .= ") ";
/*	$and .= " AND idProfessor NOT IN ("; 
	$and .= "	SELECT professor_idProfessor FROM integranteGrupo AS IG ";
	$and .= "	WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
	$and .= "	AND (IG.dataSaida > CURDATE() OR IG.dataSaida IS NULL OR IG.dataSaida = '') ";
	$and .= ") ";	*/
	?>
    
    
    <p>
    <label>Professor Aluno</label>
    <?php echo $Professor->selectProfessorSelect("","", $and);?>
    </p>
    
       <p>
        <label>Data do vínculo:</label>
        <input type="text" name="dataEntrada" id="dataEntrada" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
          <p>
        <label>1ª PSA deverá acontecer em (dias):</label>
        <input type="text" name="envioPSA" id="envioPSA" class="required" value="90"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <button class="button blue" onclick="postForm('form_Novo_aluno', '<?php echo CAMINHO_REL."grupo/include/acao/integranteGrupo.php"?>');">
      Enviar</button>  
    </p>
  </form>
</fieldset>
</div>
<script>
ativarForm();


</script> 