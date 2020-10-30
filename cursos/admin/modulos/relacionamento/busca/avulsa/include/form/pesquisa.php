<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();
$DiasBuscaAvulsa = new DiasBuscaAvulsa();
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$Uf = new Uf();	
$Cidade = new Cidade();
$Endereco = new Endereco();
$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();

$idUf = ID_UF;	
$cidadeIdCidade = ID_CIDADE;
$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();

$idDiasBuscaAvulsa = $_GET['idDiasBuscaAvulsa'];
$idBuscaAvulsa = $_GET['idBuscaAvulsa'];

$rsBuscaAvulsa = $BuscaAvulsa -> selectBuscaAvulsa(" WHERE idBuscaAvulsa = $idBuscaAvulsa");
$idIdioma = $rsBuscaAvulsa[0]['idioma_idIdioma'];
$rsDias = $DiasBuscaAvulsa->selectDiasBuscaAvulsa(" WHERE buscaAvulsa_idBuscaAvulsa = $idBuscaAvulsa");
$lucro = BuscaProfessor::margemLucroAulas();
foreach($rsDias as $val)
$diaAula = array(
    "horaInicio"=>$val['horaInicio'], 
    "horaFim"=>$val['horaFim'], 
    "dataAula"=>$val['dataAula'], 
    "diaSemanaAula"=>$val['diaSemanaAula']
);
$serialize = base64_encode(serialize($diaAula));
?>

<fieldset>
	<legend>
		Pesquisar professor
	</legend>
	<div>
	<div class="agrupa" id="div_form_professor">
		<form id="form_professor" class="validate" method="post" action="" onsubmit="return false">
			<input name="idDiasBuscaAvulsa" type="hidden" value="<?php echo $idDiasBuscaAvulsa ?>" />
			<input name="diaAula" type="hidden" value="<?php echo $serialize; ?>" />
			<input name="idDiasBuscaAvulsa" type="hidden" value="<?php echo $idDiasBuscaAvulsa ?>" />
			<input name="idBuscaAvulsa" type="hidden" value="<?php echo $idBuscaAvulsa ?>" />
			<input name="idIdioma" type="hidden" value="<?php echo $idIdioma ?>" />
			<div class="esquerda">
				<p>
					<label>Nome:</label>
					<input type="text" name="nome" id="nome" class=""/>
					<span class="placeholder">Campo Obrigatório</span>
				</p>
				<p>
					<label>Sexo:</label>
					<select name="sexo" id="sexo" class="">
						<option value="">Selecione</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
					</select>
					<span class="placeholder">Campo Obrigatório</span>
				</p>
				<p>
					<label>País de origem:</label>
					<?php echo $Pais -> selectPaisSelect("", ""); ?>
					<span class="placeholder">Campo Obrigatório</span>
				</p>
				<p>
				<label for="otimaPerformance">Ótima performance</label>
				<input type="checkbox" name="otimaPerformance" id="otimaPerformance" value="1"/>
				</p> <p>
				<label for="altaPerformance">Alta performance</label>
				<input type="checkbox" name="altaPerformance" id="altaPerformance" value="1" />
				</p>
				<p>
                <label for="indisponivel">Somente disponível</label>
                <input type="radio" name="indisponivel" id="indisponivel" value="1" />
                </p>
                <p>
                <label for="indisponivel">Somente indisponível</label>
                <input type="radio" name="indisponivel" id="indisponivel" value="2" />
                </p>
                <p>
                <label for="indisponivel">Ambos</label>
                <input type="radio" name="indisponivel" id="indisponivel" value="3" />
                </p>
                <p>
				<label for="skype">Capacitado p/ aulas online</label>
				<input type="checkbox" name="skype" id="skype" value="1" />
				</p>
                 <p>
				<label for="skype">Experiência prévia c/ aulas online</label>
				<input type="checkbox" name="expSkype" id="expSkype" value="1" />
				</p>
                <p>
                    <label for="menor5grupos">Somente professores com menos de 5 grupos</label>
                    <input type="checkbox" name="menor5grupos" id="menor5grupos" value="1" checked="checked"/>
                </p>
                <p>
				<label for="terceiros">Tercerizado</label>
				<input type="checkbox" name="terceiro" id="terceiro" value="1" />
				</p>
                <p>
       			<label>Data contratação de:</label>
        		<input type="text" class="data" id="dataContratacao1" name="dataContratacao1"  />
        
          		<label>Data contratação até:</label>
        		<input type="text" class="data" id="dataContratacao2" name="dataContratacao2"  />
        		</p>		 
                </div>
                <div  class="direita">
                <p>
                <label for="presencial">Presencial</label>
                <input type="checkbox" name="presencial" id="presencial" value="1"/>
                </p>
             <!--   <p>
                <label for="online">Online(Skype)</label>
                <input type="checkbox" name="online" id="online" value="1"/>
                </p>-->
                <p>
                <label for="tradutor">Tradutor</label>
                <input type="checkbox" name="tradutor" id="tradutor" value="1"/>
                </p>
                <p>
                <label for="consultor">Consultor</label>
                <input type="checkbox" name="consultor" id="consultor" value="1"/>
                </p>
                <p>
                <label for="imersao">Imersão</label>
                <input type="checkbox" name="imersao" id="imersao" value="1"/>
                </p>
                 <p>
          <label>Idioma:</label>
         <?php
          $idioma = new Idioma();
          echo $idioma->selectIdiomaSelect("Required", $idIdioma, "");
         ?>          
        </p>
               	<label >Nível Linguístico</label>
				<p>
					<?php //echo $NivelLinguisticoIdioma->selectNivelLinguisticoIdiomaSelect("", "", " n1.idioma_idIdioma = ".$idIdioma)
					echo $NivelLinguisticoIdioma->selectNivelLinguisticoIdiomaSelectMulti("","","n1.idioma_idIdioma = ".$idIdioma);
					?>
				</p>
                <label >Sotaque:</label>
				<p>
					<?php echo $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessorSelect('',''," idioma_idIdioma = ".$idIdioma);
					?>
				</p>
             <!--    <p>
                <label for="disponibilidade">Verificar disponibilidade no Dia</label>
                <input type="checkbox" name="disponibilidade" id="disponibilidade" value="1"/>
                </p>
				-->
                      <p>
        <input type="checkbox" name="local" id="local" value="1" >Usar filtro local de aula:
        <label>Estado:</label>
         <?php echo $Uf->selectUfSelect("required", $idUf);?><span class="placeholder">Campo Obrigatório</span>           
          
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
            
            
       	</div>
          <p>
            <label for="lucro">
              <input type="checkbox" name="lucro" id="lucro" value="<?php echo $lucro?>" checked="checked" />
              Valor hora grupo <strong>x</strong> Valor hora professor <strong>x</strong> Margem de lucro (<?php echo $lucro?>%)</label>
          </p>			    
	 </div>
			<div class="linha-inteira" >
				<p>
					<button id="btBuscaAvulsa" class="button blue" onclick="postForm('form_professor', '<?php echo CAMINHO_REL."busca/avulsa/include/resourceHTML/retornoProfessor.php"?>', '', '#buscaProfessor')">
						Pesquisar
					</button>
				</p>
			</div>
		</form>
	</div>
</fieldset>
<br />

<div id="buscaProfessor"></div>
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
