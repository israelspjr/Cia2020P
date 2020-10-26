<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RepresentanteIdioma.class.php");	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");	
		
	$RepresentanteIdioma = new RepresentanteIdioma();
	$Idioma = new Idioma();
		
	$idRepresentanteIdioma = $_GET['id'];
	$idRepresentante = $_GET['idRepresentante'];
	
	if($idRepresentanteIdioma != '' && $idRepresentanteIdioma  > 0){
	
		$valorRepresentanteIdioma = $RepresentanteIdioma->selectRepresentanteIdioma('WHERE idRepresentanteIdioma='.$idRepresentanteIdioma);

		$idIdioma = $valorRepresentanteIdioma[0]['idioma_idIdioma'];

	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Representante Idioma</legend>
    
      <form id="form_RepresentanteIdioma" class="validate" action="" method="post" onsubmit="return false" >

        <p>
          <label>Idioma :</label>
           
          <!--funcao retorna idioma-->
          <?php	
		  	
				$and = " AND idIdioma NOT IN ( ";
				$and .= "	SELECT idioma_idIdioma FROM representanteIdioma WHERE representante_idRepresentante =".$idRepresentante;
				$and .= ")";
			
		   echo $Idioma->selectIdiomaSelect($idIdioma, "required", $and);?>
        </p>

        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_RepresentanteIdioma', '<?php echo CAMINHO_CAD?>representante/include/acao/idioma.php?id=<?php echo $idRepresentanteIdioma?>&idRepresentante=<?php echo $idRepresentante?>');">Salvar</button>
            
          </p>
        </div>
      </form>

  </fieldset>
</div>
<script>ativarForm();</script>