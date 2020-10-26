<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
        
$Permissao = new PermProfessor();
$Grupo = new Grupo(); 
$idPermissao = $_GET['permissao'];
$idProfessor = $_GET['idProfessor'];  


if($idPermissao!=''){
    $valor = $Permissao->selectPerm("WHERE idperProfGroup =".$idPermissao);
    $permId = $valor[0]['idperProfGroup'];   
    $idProfessor = $valor[0]['professor_idProfessor'];         
    $grupo_idGrupo = $valor[0]['grupo_IdGrupo'];                              
    $perAtivo = $valor[0]['perAtivo']; 
    }       
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Permissão de Cadastro de Aula Livre/Avulsa</legend>
      <form id="form_Permissao" class="validate" method="post" action="" onsubmit="return false" >
       <input type="hidden" name="id" id="id" value="<?php echo $idPermissao;?>" />
        <div class="esquerda">
          <p id="grupo">
            <label>Grupo:</label>
            <?php 
          if($idPermissao==""){
                  
              echo $Permissao->selectPermGrupoSelect("required", $idProfessor);
              echo "<span class=\"placeholder\">Campo Obrigatório</span> ";
          
          }else{
                    
            
               $grupoSelecionando =  $Grupo->selectGrupo(" WHERE idGrupo = ".$grupo_idGrupo);
               echo "<strong>".$grupoSelecionando[0]['nome']."</strong>";
               echo "<input type=\"hidden\" name=\"idGrupo\" id=\"idGrupo\" value=\"".$grupo_idGrupo."\" />";
          }
         ?>
          </p>
         </div>
        <div class="direita">
           <label for="permissao">Permissao:</label>
            <input type="checkbox" name="permissao" id="permissao" value="1" <?php echo $perAtivo == 1 ? "checked" : "" ;?>  />
          </p>
        </div>
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_Permissao', '<?php echo CAMINHO_CAD?>professor/contratado/include/acao/PermissaoAula.php?idProfessor=<?php echo $idProfessor?>');" >Salvar</button>
            
          </p>
        </div>
      </form>  
  </fieldset>
</div>
<script>
ativarForm();
</script>
