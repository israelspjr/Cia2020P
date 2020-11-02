<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$mes = date('m');
$ano = date('Y');

$Funcionario = new Funcionario();
?>

<fieldset>
  <legend>Filtros</legend>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_permissao" 
  onclick="abrirFormulario('div_form_permissao', 'img_form_permissao');" />
  
  <div class="agrupa" id="div_form_permissao">
    <form id="form_chamados"  class="validate" method="post" action="" onsubmit="return false" >
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
          <label>Status :</label>
          <select size="3" name="status" id="status">
            <option value="" >Todos</option>
            <option value="0" selected="selected" >Aberto</option>
            <option value="1" >Fechado</option>
            <option value="2"> Descartado</option>
          </select>
        </p>
            <p>
          <label for="Funcionario">Funcionário : </label>
        <?php echo $Funcionario->selectFuncionarioSelect(); ?>
        </p>
        <p>
           <label for="sistema">Sistema :</label>
      <select name="sistema" id="sistema">
      <option value="-" >Selecione</option>
      <option value="1" >Cursos</option>
      <option value="2" >Consultoria</option>
      <option value="3" >Site Principal</option>
      <option value="4" >Profcerto</option>
      <option value="5" >Outros Sites</option>
      <option value="6" >Hardware</option>
      <option value="7" >Servidores</option>
      <option value="8" >Emails</option>
      </select>
      </div>     
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_permissao', 'form_chamados', '<?php echo CAMINHO_MODULO . "configuracoes/chamados/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Cadastro de chamados do sistema</legend>
  <div id="lista_res" class="lista"></div>
</fieldset>

<script>
ativarForm();
eventDestacar(1);
</script>
