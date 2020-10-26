<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();
$mes = date("m");
$ano = date("Y");
?>

<fieldset>
  <legend>Filtros</legend>
  
	<div class="menu_interno"> 
		<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/candidato/cadastro.php";?>', 'click', '#bt');" /> 
	</div>
	  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
	onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
	
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
     
      <div class="esquerda">
          <p>
                    Nome do Candidato:<input type="text" name="nome" id="nome" list="nomeList">
                    <datalist id="nomeList">
                    </datalist>    
                </p>
     		<p>
            <label>Idioma:</label>
            <?php
			    echo $Idioma->selectIdiomaSelect("", 0, "");
			
			?></p>
              <p>
              <label>Data da realização da prova:</label>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo (11 == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y'); $x >= 2019; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo (2019 == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2019; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
      </div>
      
      <div class="direita">
       <p>
          <label>Status :</label>
          <select size="3" name="status" id="status">
          	<option value=""  >Todos</option>
            <option value="0" selected="selected">Ativo</option>
	          <option value="1" >Inativo</option>
          </select>
        </p>
        <p>
        <label><input type="checkbox" name="prova" id="prova" value="1" checked="checked">
         Somente Candidatos que fizeram prova</label>
         </p>
          <p>
        <label><input type="checkbox" name="contratado" id="contratado" value="1">
         Professores contratado também!</label>
         </p>
          <p>
        <label><input type="checkbox" name="naoUsar" id="naoUsar" value="1" checked="checked">
         Clique aqui para não usar o filtro de data</label>
         </p>
      </div>
      
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="enviar()" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Professor candidato</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>

<script>

function enviar() {
	
	//var comboNome = document.getElementById("idIdioma");
    //    if (comboNome.options[comboNome.selectedIndex].value == "" ){
     //           alert("Selecione um Idioma antes de prosseguir");
     //   } else {
	
			filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."professor/candidato/index.php"?>', '', 'lista_res')
	
//		}
}


    $(function(){
       $("input[name=nome]").keyup(function(){
           var nome = $(this).val();
           if(nome != ""){
              var dados = {
                  tabela:'professor',
                  nome:nome,
                  campo:'nome',
                  where: 'candidato = 1 AND '
               }
               $.post('<?php echo CAMINHO_CAD."professor/include/busca_nome.php";?>', dados, function(retorno){
                   $("#nomeList").html($.parseJSON(retorno));
               });
           }
        });   
           
   });  
ativarForm();
//$('#bt').click();
</script> 
