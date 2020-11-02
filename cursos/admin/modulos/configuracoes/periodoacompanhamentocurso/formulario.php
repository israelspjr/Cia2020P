<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PeriodoAcompanhamentoCurso.class.php");
	
	
	$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
		
$idPeriodoAcompanhamentoCurso = $_REQUEST['id'];

if($idPeriodoAcompanhamentoCurso != '' && $idPeriodoAcompanhamentoCurso  > 0){

	$valor = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso('WHERE idPeriodoAcompanhamentoCurso='.$idPeriodoAcompanhamentoCurso);
	
	$idPeriodoAcompanhamentoCurso = $valor[0]['idPeriodoAcompanhamentoCurso'];
		 $mes = $valor[0]['mes'];
		 $ano = $valor[0]['ano'];
		 $excluido = $valor[0]['excluido'];
		 
	
}else{
	$mes = date('m');
	$ano = date('Y');
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de Período Acompanhamento Curso</legend>
    <form id="form_PeriodoAcompanhamentoCurso" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idPeriodoAcompanhamentoCurso ?>" />		
                
                
 <p> 
 <label>Mês:</label>              
   <select name="mes" id="mes" class="required">
	<?php for($x=1; $x <= 12; $x++){ ?>
    	<option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> >
		    <?php echo Uteis::retornaNomeMes($x);?>
	    </option>    
    <?php }?>
  </select>
<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
                <label>Ano:</label>
  <select name="ano" id="ano" class="required">
    <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
        <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>>
            <?php echo $x?>
        </option>
    <?php } ?>
  </select>
	<span class="placeholder">Campo Obrigatório</span>
				</p> 			
	  
        <button class="button blue" onclick="postForm('form_PeriodoAcompanhamentoCurso', '<?php echo CAMINHO_MODULO?>configuracoes/periodoacompanhamentocurso/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

