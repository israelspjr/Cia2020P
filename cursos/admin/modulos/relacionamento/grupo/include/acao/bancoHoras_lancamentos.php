<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DiaAulaFF = new DiaAulaFF();
$FolhaFrequencia = new FolhaFrequencia();
$banco = new BancoHoras();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$arrayRetorno = array();
    $dc = $_POST['credeb'];
    $idBanco = $_POST['idBanco'];
    $idFolhaFrequencia = $_POST['idFolhaFrequencia'];
    $idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
	$dataCadastro = $_POST['dataCadastro'];
	
	$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);
	
	$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}

$valorx2 = implode(', ',$valorX);

 if($idFolhaFrequencia=="") {    
 
 
 	$Data = $dataCadastro;
		$ex = explode("/", $dataCadastro);
		$dia = $ex[0];
		$mes = $ex[1];
		$ano = $ex[2];
	/*	echo "mes: ".$mes;
		echo "ano :".$ano;
		echo "dia :".$dia;
		*/
		$data = $ano."-".$mes."-01";
//		echo $data;
 
     
       $ff = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND dataReferencia = '".$data."'");        
       if(!$ff[0]['idFolhaFrequencia']) {
         $arrayRetorno['mensagem'] = "Nenhuma Folha de Frequência Gerada. Ela é necessária para este procedimento" ;   
	   } else {
         $idFolhaFrequencia = $ff[0]['idFolhaFrequencia'];  
	   }
 }
 
		 
	
    $idDiaAulaFF = $_POST['idDiaAulaFF'];
    $idOcorrenciaFF = $_POST['idOcorrenciaFF'];
    $horas = Uteis::gravarHoras($_POST['horasPrograma']);
	
    if($dc==0){
      $horas = $horas;
    }else{
      $horas = $horas;
      $idOcorrenciaFF = 7; 
    }     
    /*$dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    
    if($dia!="" && $mes!="" && $ano!="")
        $data = $ano."-".$mes."-".$dia; */
	
/*	
	$ex = explode("/", $dataCadastro);
	*/	
	if($dataCadastro !="") {	
	$data = Uteis::gravarData($dataCadastro);
	//	$Data = $dataCadastro;
//		$ex = explode("/", $dataCadastro);
//		$dia = $ex[0];
//		$mes = $ex[1];
//		$ano = $ex[2];
	/*	echo "mes: ".$mes;
		echo "ano :".$ano;
		echo "dia :".$dia;
		*/
/*		$data = $ano."-".$mes."-".$dia;*/
	}else {
        $data = $_POST['dataInteira'];
	}
    
    $obs = $_POST['obs'];
    $dataExpira = Uteis::gravarData($_POST['dataExpiracao']);
    
if ($_POST['acao']=="cadastrar"): 
   
         $DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);    
         $DiaAulaFF->setHoraRealizada($horas);
         $DiaAulaFF->setBanco(1);
         $DiaAulaFF->setOcorrenciaFFIdOcorrenciaFF($idOcorrenciaFF);
         $DiaAulaFF->setDataAula($data);
         $DiaAulaFF->setObs($obs);
         $rs = $DiaAulaFF->addDiaAulaFF();
         if($rs ):/*&& $dc == 0):  */
             $banco->setDiaAulaFFIdDiaAulaFF($rs);
             $banco->setHoras($horas);
             $banco->setDataExpira($dataExpira);
             $banco->setObs($obs);
			 $banco->setCredDeb(1);
             $rb = $banco->addBancoHoras();
              if($rs):      
                    $arrayRetorno['mensagem'] = MSG_CADATU;
                    $arrayRetorno['fecharNivel'] = true; 
              else:
                  $arrayRetorno['mensagem'] = "Não foi possível adicionar ao Banco";
              endif;
                                       
              elseif($rs && $dc == 1):
                    $arrayRetorno['mensagem'] = MSG_CADATU;
                    $arrayRetorno['fecharNivel'] = true; 
              else:               
                    $arrayRetorno['mensagem'] = "Não foi possível adicionar / Verifique se existe FF no período";    
           endif;
  //         endif;     
 //      endif;        
   
elseif($_POST['acao']=="deletar"):
    
        $arrayRetorno['mensagem'] = MSG_CADDEL;
        $idDiaAulaFF = $_POST['id'];
        $idBanco = $banco->selectBancoHoras("WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF);
        if($idBanco!=""){
            $banco->setIdBancoHoras($idBanco[0]['idBancoHoras']);
            $rb = $banco->deleteBancoHoras();
        }
        $DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);
        $rs = $DiaAulaFF->deleteDiaAulaFF();  
        
        if($rs):
               
             $arrayRetorno['mensagem'] = "Cadastro deletado com sucesso.$rs";
  //           $arrayRetorno['fecharNivel'] = true;
        endif;
           
else:
        //dia aula
        $DiaAulaFF->setIdDiaAulaFF($idDiaAulaFF);
        $DiaAulaFF->setFolhaFrequenciaIdFolhaFrequencia($idFolhaFrequencia);    
        $DiaAulaFF->setHoraRealizada($horas);
        $DiaAulaFF->setBanco(1);
        $DiaAulaFF->setOcorrenciaFFIdOcorrenciaFF($idOcorrenciaFF);
        $DiaAulaFF->setDataAula($data);
        $DiaAulaFF->setObs($obs);
        $DiaAulaFF->updateDiaAulaFF(); 
     
		$rs = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$idDiaAulaFF);
	 
	    if($rs){   
            $banco->setDiaAulaFFIdDiaAulaFF($idDiaAulaFF);
            $banco->setHoras($horas);
            $banco->setDataExpira($dataExpira);
            $banco->setObs($obs);
			$banco->setCredDeb(1);
       if($idBanco!=""){
            $banco->setIdBancoHoras($idBanco);
            $rb = $banco->updateBancoHoras();
			$arrayRetorno['mensagem'] = MSG_CADATU;
            $arrayRetorno['fecharNivel'] = true;      
        }else{
              $rb = $banco->addBancoHoras();
        }
           if($rb){            
            $arrayRetorno['mensagem'] = MSG_CADATU;
            $arrayRetorno['fecharNivel'] = true; 
		   }
        /*    }else{
              $arrayRetorno['mensagem'] = "Não foi possível atualizar";    
            }*/
        }
endif;   
echo json_encode($arrayRetorno);