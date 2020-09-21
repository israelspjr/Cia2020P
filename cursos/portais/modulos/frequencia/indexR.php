<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$GrupoClientePj = new GrupoClientePj();
$ClientePf = new ClientePf();

$mes = date('m');
$ano = date('Y');

$IdClientePj = $_SESSION['idClientePj_SS'];

$valor = $ClientePj->selectClientePj("where idClientePj = ".$_SESSION['idClientePj_SS']);
$FME = $valor[0]['frequenciaMinimaExigida'];

?>

<fieldset>
  <legend>Relatório de frequência</legend>
<span id="texto1"> Abrir/Fechar Filtros </span>  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    <legend>Filtros</legend>
      <p><strong>Tipo de relatório</strong></p>
      <div class="linha-inteira">
      <div class="esquerda">
        <p>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_porAula" value="porAula" />
            Frequência por aula</label>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_mensal" value="mensal" checked="checked" />
            Frequência mensal </label>
        </p>
         <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
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
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
          <label>Tipo de resultado:</label><br>
          <input type="radio" name="tipoR" value="0" checked="">Detalhado<br>
          <input type="radio" name="tipoR" value="1" id="resumido">Resumido<br>
          <br>
          <input type="checkbox" name="alunosN" value="1" onclick="toggleCheckbox(this)"> Não mostrar alunos.
          </p>
            
      </div>
       <div class="direita">
       <p>
            <label>Empresa:</label>
            <?php echo $ClientePj->getNome($IdClientePj);?>
          </p>
        
          <p>
            <label>Grupo:</label>
            <?php echo $Grupo->selectGrupoSelectMult("",""," inner join grupoClientePj as GC on G.idGrupo = GC.grupo_idGrupo where GC.clientePj_idClientePj = ".$IdClientePj." AND G.inativo = 0")?></p>
             <p>
            <label>Alunos:</label><br />
            <?php echo $ClientePf->selectAlunosEmpresa("= ".$IdClientePj)?></p>
            <p>
            <label>Frequência: </label><br />
            <input name="frequencia" type="radio" value="-" checked="checked" selected>Todos</input><br />
            <input type="radio"  name="frequencia" value="1">Abaixo de <?php echo $FME?>%</input><br />
            <input type="radio" name="frequencia" value="2">Somente 100%</input><br />
          
        </div>
      </div>
      
    
        <div class="esquerda">
        <input type="hidden" id="rh" name="rh" value="1"/>
        </div>
       
      
      <div class="linha-inteira" >
        <button class="bBlue" id="geraRel" onclick="fecharMenu(0);abrirFormulario('menu_area', 'img_form_Menu');postForm_relatorio('img_form_Grupos', 'tipoRel', 'form_rel_pf', 'modulos/frequencia/frequenciaR.php', 'res_rel');">Gerar relatório</button>        
      </div>
    </form>
  </div>
  
</fieldset>


  <legend>Resultado da pesquisa</legend>
  <!--class="lista"-->
  <div id="res_rel"  ></div>

<script> 
function toggleCheckbox(element) {
     $('#resumido').attr('checked', "checked");	
}

//ativarForm();

</script> 