<?php 
$Modulo = new Modulo();
error_reporting(E_ALL);
if( isset($_SESSION["idFuncionario_SS"]) && $_SESSION["idFuncionario_SS"] != '' ) {?>
	
	<ul>
    
	<?php $andFunc = " AND F.idFuncionario = ".$_SESSION["idFuncionario_SS"];
    
    $idModulo_ultimo = array();
    $idModulo_jaFoi = array("0");
    $idModulo_jaFoi2 = array("0");
    
    $rsModulo = $Modulo->selectModulo_permissao(" AND M.modulo_idModulo IS NULL ".$andFunc);
    if($rsModulo){
        foreach($rsModulo as $valorModulo){
            
            $idModulo_ultimo[] = $valorModulo["idModulo"];
            sort($idModulo_ultimo);
            
            for($x=1; $x>0; $x++){	
                
                $pos = count($idModulo_ultimo)-1;
                
                if( $pos >= 0 ){	
                    
                    $idModulo = $idModulo_ultimo[$pos];
                    $where = " AND M.modulo_idModulo = ".$idModulo."
					 AND M.idModulo NOT IN (".implode(",",$idModulo_jaFoi).") ".$andFunc;												
                    $rsModulo_sub = $Modulo->selectModulo_permissao($where);																	
                
                }else{					
                
                    $idModulo_jaFoi = array_merge($idModulo_jaFoi, $idModulo_jaFoi2);
                    $idModulo_jaFoi2 = array("0");
                    break;	
										
                }
                
                if($rsModulo_sub){ 
                                        
                    $idModulo_ultimo[] = $rsModulo_sub[0]["idModulo"];
                    
                    if( in_array($idModulo, $idModulo_jaFoi2) ) continue;
                                                            
                    $where = " AND M.idModulo = ".$idModulo." ".$andFunc;										
                    $rsModulo_n = $Modulo->selectModulo_permissao($where);
                    
                    $nome_menu = $rsModulo_n[0]["nome"];
                    $link_menu = $rsModulo_n[0]["link"];
                    
                   	$idModulo_jaFoi2[] = $idModulo;
                    					
                    echo "<li class=\"has-sub\">
						<a href=\"#\">
							<span>".$nome_menu."</span>
							<span class=\"has-sub-indicator\"></span>
						</a>
					<ul>";
                        
                }else{ 	
                    
                    $idModulo = $idModulo_ultimo[$pos];
                    
                   $idModulo_jaFoi[] = $idModulo;
                    unset($idModulo_ultimo[$pos]);	
                    sort($idModulo_ultimo);	
                    
                   if( in_array($idModulo, $idModulo_jaFoi2) ){
                        echo "</ul></li>";				
                        continue;	
                    }
                                            
                    $where = " AND M.idModulo = ".$idModulo." ".$andFunc;																	
                    $rsModulo_n = $Modulo->selectModulo_permissao($where);
                    
                    $nome_menu = $rsModulo_n[0]["nome"];
                    $link_menu = $rsModulo_n[0]["link"];
                    
                    $onclick = ($link_menu) ? " onclick=\"carregarModulo('".CAMINHO_MODULO.$link_menu."', '#centro')\" " : " href=\"#\" ";
                    
                    echo "<li><a $onclick >
						<span>".$nome_menu."</span></a>
					</li>";
                    
                    
                }	
                //CONTA O ITEM
				$cont++;
            }
        }
    }?>
     
	<li><a onclick="carregarModulo('<?php echo CAMINHO_MODULO?>meusAvisos/index.php', '#centro');">
    <span>Meus avisos</span></a></li>
    
	</ul>
  
<?php }?>

<div class="logoff" >
	<small><?php echo $_SESSION['nome_SS']?>&nbsp;&nbsp;</small>
	<!--<img src="<?php echo CAMINHO_IMG."dupl.png"?>" title="Duplicar guia" onclick="window.open('/cursos/admin', '_blank')"/> -->
	 <img src="<?php echo CAMINHO_IMG."sair.png"?>" title="Sair do sistema" onclick="$('#logoff').click()"/> 
</div>

<form id="login" class="validate" action="logoff.php" method="post" style="display:none;">
  <input type="submit" name="logoff" id="logoff" />
</form>
