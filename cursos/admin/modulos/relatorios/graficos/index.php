<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$Professor = new Professor();

$mes = date('m');
$ano = date('Y');
?>

<fieldset>
  <legend>Gráficos</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_graf_pf" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Tipo de Gráfico</strong></p>
      <div class="linha-inteira">
        <p>
          <label>
            <input type="radio" name="tipoGraf" id="tipoGraf_PSA" value="PSA" checked="checked" />
            Pesquisa de Satisfação</label>
          <label>
            <input type="radio" name="tipoGraf" id="tipoGraf_Freq" value="Freq" />
            Frequência</label>
          
        </p>     
      </div>
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
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
        </div>
        <div class="direita">
          <p>
            <label>Empresa:</label>
            <?php echo $ClientePj->selectClientePjSelectMult("", "", " AND inativo = 0")?></p>
          <p>
            <label>Grupo:</label>
            <?php echo $Grupo->selectGrupoSelectMult("", "", " WHERE inativo = 0")?></p>           
          <p>
            <label>Professor:</label>
            <?php echo $Professor->selectProfessorSelectMult("", "", " AND vetado = 0 AND indisponivel = 0 AND excluido = 0 ")?></p>
            
        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraGraf" onclick="postForm_relatorio('img_form_Grupos', 'tipoGraf', 'form_graf_pf', '<?php echo CAMINHO_RELAT."graficos/include/resourceHTML/graficos.php"?>', '#res_graf')">Gerar Gráfico</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> ativarForm();</script> 