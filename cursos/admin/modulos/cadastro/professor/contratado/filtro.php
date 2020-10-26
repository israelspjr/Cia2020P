<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Professor = new Professor();
$Uf = new Uf();	
$Cidade = new Cidade();
$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();
$Pais = new Pais();


$idUf = ID_UF;	
$cidadeIdCidade = ID_CIDADE;
?>

<fieldset>
	<legend>
		Filtros
	</legend>
	<div class="menu_interno">
		<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/contratado/cadastro.php";?>', 'click', '#bt');" /> </div>
	</div>
	<img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos"
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	<div class="agrupa" id="div_form_Grupos">
		<form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >

			<div class="esquerda">
			    <p>
			        Nome do Professor:<input type="text" name="nome" id="nome" list="nomeList" style="width:400px"><span id="nomeEmail" style="display:none"><-Selecione o nome ao lado</span>
			        <datalist id="nomeList">
			        </datalist>    
			    </p>
                <p>
                    Email:<input type="text" name="email" id="email" list="nomeListEmail">
                </p>
                
                 <p>
                    CPF:<input type="text" name="cpfP" id="cpfP" list="nomeListCpf" maxlength="14" class="cpf" onkeyup="nomeCpf()">
                 </p>
                <p>
                    Telefone (xxxx-xxxx):<input type="text" name="tel" id="tel" list="" maxlength="14" onkeyup="telefone()" >
                 </p>
	
				<p>
					<label>Status :</label>
					<select size="3" name="status" id="status">
						<option value=""  selected="selected">Todos</option>
						<option value="0" >Ativo</option>
						<option value="1" >Inativo</option>
					</select>
				</p>
                <p>
                <label><input type="checkbox" value="1" id="excluido" name="excluido"/>Somente excluido</label>
				<p>
                <p>
                <label><input type="checkbox" value="1" id="terceiro" name="terceiro"/>Somente professores terceirizados</label>
				<p>
          <label>Sexo:</label>
          <select size="3" name="sexo" id="sexo">
            <option value="" selected="selected" >Todos</option>
            <option value="F" >Feminino</option>
            <option value="M" >Masculino</option>
          </select>
        </p>
         <p>
          <label>Idioma:</label>
         <?php
          $idioma = new Idioma();
          echo $idioma->selectIdiomaSelect("", 0, "");
         ?>          
        </p>
        <p>
          	<label>Nível do Idioma: </label>
          		<select name="nivelF" id="nivelF">
                	<option value="" >Selecione</option>
          			<option value="1" >Fluente</option>
          			<option value="2" >Nativo</option>
          			<option value="3" >Avançado</option>
          			<option value="4" >Intermediário</option>
          			<option value="5" >Básico</option>
          		</select>
          </p>
         <p>
          <label>Nivel Linguistico:</label>
           <?php
          $nivel = new NivelLinguistico();
          echo $nivel->selectNivelLinguisticoSelectMult("", 0);
         ?>  
        </p>
         <label >Sotaque:</label>
				<p>
				<select id="idSotaqueIdiomaProfessor" name="idSotaqueIdiomaProfessor">	
                <option value="-">Selecione o Idioma primeiro</option>  
                </select>
				</p>
        <p>
            <input type="radio" name="comGrupo" id="comGrupo" value = "1">  Com Grupo           
            <input type="radio" name="comGrupo" id="comGrupo" value = "2">  Sem Grupo          
            <input type="radio" name="comGrupo" id="comGrupo" value = "3" checked="checked">Ambos           
        </p>
        <p>
        <input type="checkbox" name="local" id="local" value="1" >Usar filtro local de aula:
        <label>Estado:</label>
         <?php echo $Uf->selectUfSelect("required", $idUf);?><span class="placeholder">Campo Obrigatório</span>           
          
        </p>
        <div id="div-cidade"></div>
                <p>
                    <label for="menor5grupos">
                        <input type="checkbox" name="menor5grupos" id="menor5grupos" value="1" />
                        Não mostrar professor com mais de 5 grupos</label>
                </p>
              
   
       	</div>
            
			<div class="direita">
            <p>
            <label>Pais de origem: </label>
            <?php echo $Pais->selectPaisSelect() ?>
            </p>
            
            <p>
            <Label>Cidade de origem: </Label>
            <?php
			$sql3 = "SELECT distinct(cidadeOrigem) AS valor FROM professor where cidadeOrigem IS NOT NULL";
			$resultado = Uteis::executarQuery($sql3);
			echo '<select name="cidadeOrigem" id="cidadeOrigem">';
			echo '<option value="">Selecione</option>';

			for ($x = 0;$x<count($resultado);$x++) {
			echo '<option value="'.$resultado[$x]['valor'].'">'.$resultado[$x]['valor'].'</option>';	
				
			}
			
            echo '</select>';

?>            
			   <p>
          <label>Indisponivel:</label>
          <select name="disp" id="disp">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Disponível</option>
            <option value="1" >Indisponível</option>
          </select>
        </p>
			 <p>
          <label>Ótima Performance:</label>
          <select name="otima" id="otima">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
        <p>
          <label>Alta Performance:</label>
          <select name="alta" id="alta">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
        <p>
          <label>Vetado:</label>
          <select name="vet" id="vet">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
          	 <p>
          <label>Presencial:</label>
          <select name="presencial" id="presencial">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
        <p>
          <label>Online:</label>
          <select name="online" id="online">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
        <p>
          <label>Tradutor:</label>
          <select name="tradutor" id="tradutor">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
        <p>
          <label>Consultor:</label>
          <select name="consultor" id="consultor">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        </p>
          <p>
				<label for="skype"><input type="checkbox" name="skype" id="skype" value="1" /> Capacitado p/ aulas online</label>
				</p>
                 <p>
				<label for="skype"><input type="checkbox" name="expSkype" id="expSkype" value="1" /> Experiência prévia c/ aulas online	</label>
				</p>
        
     <!--     <p>
          <label>Aula Skype:</label>
          <select name="skype" id="skype">
            <option value="" selected="selected" >Todos</option>
            <option value="0" >Não</option>
            <option value="1" >Sim</option>
          </select>
        <-/p>-->
        
         <p>
        <label>Data contratação de:</label>
        <input type="text" class="data" id="dataContratacao1" name="dataContratacao1"  />
        
          <label>Data contratação até:</label>
        <input type="text" class="data" id="dataContratacao2" name="dataContratacao2"  />
        </p>		  
			</div>

			<div class="linha-inteira">
				<button class="button blue" id="bt" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."professor/contratado/index.php"?>', '', '#lista_res')" >
					Buscar
				</button>
			</div>
		</form>
	</div>
</fieldset>
<fieldset>
	<legend>
		Professor contratado
	</legend>
	<div id="lista_res" class="lista"></div>
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

	$(function(){
       $("input[name=nome]").keyup(function(){
           var nome = $(this).val();
           if(nome != ""){
              var dados = {
                  tabela:'professor',
                  nome:nome,
                  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."professor/include/busca_nome.php";?>', dados, function(retorno){
                   $("#nomeList").html($.parseJSON(retorno));
               });
           }
        });   
           
   });	
   
   $(function(){
       $("input[name=email]").keyup(function(){
           var email = $(this).val();
           if(nome != ""){
              var dados = {
             //     tabela:'professor',
                  email:email,
             //     campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."professor/include/busca_nome_email.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
			//	   $('#nomeEmail').show();
               });
           }
        });   
           
   });	
   
   function nomeCpf() {
	var cpf = $("#cpfP").val();
	if(cpf != ""){
              var dados = {
                 // tabela:'clientePf',
                  cpf:cpf,
                //  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."professor/include/busca_professor_cpf.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
//				   $('#nomeEmail').show();
               });
		}
	   
   }
   
    function telefone() {
	var telefone = $("#tel").val();
	if(telefone != ""){
              var dados = {
                 // tabela:'clientePf',
                  telefone:telefone,
                //  campo:'nome',
               }
               $.post('<?php echo CAMINHO_CAD."professor/include/busca_professor_telefone.php";?>', dados, function(retorno){
                   $("#nome").val($.parseJSON(retorno));
//				   $('#nomeEmail').show();
               });
		}
	   
   }
   
   
   
   tabelaDataTable('tb_lista_professor');
	//$('#bt').click();
    eventDestacar(1);
	
function sotaque(){
  var ididioma, retorno;
  $("#idSotaqueIdiomaProfessor").empty();
  $("#idSotaqueIdiomaProfessor").append("<option value='-'>Selecione</option>");
//  status = $("#statusG:checked").val();
  ididioma = $( "#idIdioma" ).val();
 // gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_sotaque.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{ididioma:ididioma}   
  });
  retorno.done(function( html ) {
    $( "#idSotaqueIdiomaProfessor" ).append( html );
  });
  
}

$('#idIdioma').attr('onchange', 'sotaque()');
</script>
