<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Pais = new Pais();
$Uf = new Uf();	
$Cidade = new Cidade();

$idUf = ID_UF;	
$cidadeIdCidade = ID_CIDADE;
$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();
	
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idBuscaProfessor = $_GET['idBuscaProfessor'];
$lucro = BuscaProfessor::margemLucroAulas();

$lucroIdeal = $luco - 3; 	
?>

<fieldset>
  <legend>Pesquisar professor</legend>
  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  
  <div class="agrupa" id="div_form_Grupos">
  
    <form id="form_professor" class="validate" method="post" action="" onsubmit="return false">
      <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <input name="idBuscaProfessor" type="hidden" value="<?php echo $idBuscaProfessor ?>" />
      <div class="esquerda">
        <p>
          <label>Nome:</label>
          <input type="text" name="nome" id="nome" class=""/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Sexo:</label>
          <select name="sexo" id="sexo" class="">
            <option value="">Selecione</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>País de origem:</label>
          <?php echo $Pais->selectPaisSelect("", "");?> <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <div class="direita" >
        <p>
          <label>Data de contratação:</label>
          de
          <input type="text" name="dataContratacao" id="dataContratacao" class="data" value="" />
          à
          <input type="text" name="dataContratacao2" id="dataContratacao2" class="data" value="" />
          <span class="placeholder"></span></p>
        <p>
        <p>
          <label for="otimaPerformance">
            <input type="checkbox" name="otimaPerformance" id="otimaPerformance" value="1"/>
            Ótima performance</label>
        </p>
        <p>
          <label for="altaPerformance">
            <input type="checkbox" name="altaPerformance" id="altaPerformance" value="1" />
            Alta performance</label>
        </p>
        <label >Nível Linguístico</label>
        <p>
          <?php 
				$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
				echo $NivelLinguisticoIdioma->selectNivelLinguisticoIdiomaSelect("", "", " n1.idioma_idIdioma = ".$idIdioma);
			?>
        </p>
      </div>
      <div class="esquerda">
         <input type="checkbox" name="local" id="local" value="1" >Usar filtro local de aula:
        <label>Estado:</label>
         <?php echo $Uf->selectUfSelect("required", $idUf);?>           
          
        </p>
        
        <div id="div-cidade"></div>
        
            <div id="div-zona"> </div>
            
                      Pesquisar por Bairro / Cidade moradia do professor:
          <?php
		  $sql = "SELECT distinct(E.bairro),  C.cidade, C.idCidade, P.idProfessor, P.inativo FROM endereco as E
INNER JOIN cidade AS C on E.cidade_idCidade = C.idCidade
LEFT JOIN professor as P on E.professor_idProfessor = P.idProfessor
WHERE bairro is not null AND P.inativo = 0 AND P.inativo is not null
ORDER BY bairro";
		$result = Uteis::executarQuery($sql);
		
	//	Uteis::pr($result);
		
	echo "<select name=\"bairro\" id=\"bairro\">";
	echo "<option value=\"-\">Selecione uma opção</option>";
		foreach ($result as $valor) {
	echo "<option value=\"".$valor['idCidade'].",".$valor['bairro']."\">".$valor['bairro']." / ".$valor['cidade']."</option>";	
		
		}
	echo "</select>";		
		  
		  
		  ?>  
            
  
        <!--   <p>
        <label for="zona">
          <input type="checkbox" name="zona" id="zona" value="1" />
          Zonas de atendimento</label>
      </p>
      
      <p>
        <label for="cidade">
          <input type="checkbox" name="cidade" id="cidade" value="1" />
          Atende na mesma cidade</label>
      </p>
      <p>
        <label for="perfil">
          <input type="checkbox" name="perfil" id="perfil" value="1" />
          Perfil do professor</label>
      </p>-->
      </div>
      <div class="direita">
      <p>
        <label for="presencial">
          <input type="checkbox" name="presencial" id="presencial" value="1" />
          Presencial</label>
      </p>
   <!--   <p>
        <label for="distancia">
          <input type="checkbox" name="distancia" id="distancia" value="1" />
          a Distância</label>
      </p>-->
       <p>
				<label for="skype">Capacitado p/ aulas online</label>
				<input type="checkbox" name="skype" id="skype" value="1" />
				</p>
                 <p>
				<label for="skype">Experiência prévia c/ aulas online</label>
				<input type="checkbox" name="expSkype" id="expSkype" value="1" />
				</p>
      <p>
        <label for="lucro">
<!--          <input type="checkbox" name="lucro" id="lucro" value="1" checked/>
          Valor hora grupo <strong>x</strong> Valor hora professor <strong>x</strong> Margem de lucro (<?php echo $lucro?>%)</label>
      </p>
          <p>
              <label for="menor5grupos">
                  <input type="checkbox" name="menor5grupos" id="menor5grupos" value="1" checked />
                  Não mostrar professor com mais de 5 grupos</label>
          </p>-->
      </div>
      <div class="linha-inteira" >
        <p>
          <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_professor', '<?php echo CAMINHO_REL."busca/vendas/include/resourceHTML/retornoProfessor.php"?>', '', '#buscaProfessor')">Pesquisar</button>
          
          <button class="button blue desabilitado" id="bt_busca" 
          onclick="postForm('form_professor', '<?php echo CAMINHO_REL."busca/vendas/include/resourceHTML/retornoProfessor.php"?>', '', '#buscaProfessor')"></button>
        </p>
      </div>
    </form>
    
  </div>
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="buscaProfessor" class="lista"> </div>
</fieldset>

<script>
	var $zona = $('#div-zona');
	var $cidade = $('#div-cidade');

  function atualizaCidade(idUf, idCidade){
	  if(idCidade == '' || idCidade == undefined) idCidade = '';
		$.post('<?php echo CAMINHO_CAD?>endereco/include/acao/endereco.php', { acao:"cidade", idUf:idUf, idCidade:idCidade}, function(e){
			$cidade.html(e);
			//$zona.html('');
			atualizaZonaPorCidade(idCidade);
		});
	}
  
  function atualizaZonaPorCidade(idCidade, idZona){
	  if(idZona == '' || idZona == undefined) idZona = '';
	$.post('<?php echo CAMINHO_CAD?>endereco/include/acao/endereco.php', { acao:"zonaCidade", idCidade:idCidade, idZona:idZona, idProfessor:'<?php echo $idProfessor?>'}, function(e){
		$zona.html(e);
	});
  }
  
  		<?php if($cidadeIdCidade!='' && $idUf!='' ){?>
			atualizaCidade('<?php echo $idUf?>', '<?php echo $cidadeIdCidade?>');
		<?php }?>
	ativarForm();
</script> 