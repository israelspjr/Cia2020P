<?php
class AulaPermanenteGrupo extends Database {

    // class attributes
    var $idAulaPermanenteGrupo;
    var $planoAcaoGrupoIdPlanoAcaoGrupo;
    var $diaSemana;
    var $horaInicio;
    var $horaFim;
    var $inativo;
    var $obs;
    var $dataInicio;
    var $dataFim;
    var $dataCadastro;
    var $localAulaIdLocalAula;
    var $enderecoIdEndereco;

    // constructor
    function __construct() {
        parent::__construct();
        $this -> idAulaPermanenteGrupo = "NULL";
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
        $this -> diaSemana = "NULL";
        $this -> horaInicio = "NULL";
        $this -> horaFim = "NULL";
        $this -> inativo = "0";
        $this -> obs = "NULL";
        $this -> dataInicio = "NULL";
        $this -> dataFim = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
        $this -> localAulaIdLocalAula = "NULL";
        $this -> enderecoIdEndereco = "NULL";

    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdAulaPermanenteGrupo($value) {
        $this -> idAulaPermanenteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setexibirDiaSemana($value) {
        $this -> diaSemana = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setHoraInicio($value) {
        $this -> horaInicio = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setHoraFim($value) {
        $this -> horaFim = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setObs($value) {
        $this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataInicio($value) {
        $this -> dataInicio = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataFim($value) {
        $this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setLocalAulaIdLocalAula($value) {
        $this -> localAulaIdLocalAula = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setEnderecoIdEndereco($value) {
        $this -> enderecoIdEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
    }
   
    function setInativo($value) {
    $this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
   }
   

    /**
     * addAulaPermanenteGrupo() Function
     */
    function addAulaPermanenteGrupo() {
        $sql = "INSERT INTO aulaPermanenteGrupo (planoAcaoGrupo_idPlanoAcaoGrupo, diaSemana, horaInicio, horaFim, obs, dataInicio, dataFim, dataCadastro, localAula_idLocalAula, endereco_idEndereco, inativo) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->diaSemana, $this->horaInicio, $this->horaFim, $this->obs, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->localAulaIdLocalAula, $this->enderecoIdEndereco, $this->inativo)";
//		echo $sql;
        $result = $this -> query($sql, true);
        return mysqli_insert_id($this -> connect);
    }

 function Migracao() {
    $sql = "INSERT INTO aulaPermanenteGrupo (idAulaPermanenteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, diaSemana, horaInicio, horaFim, obs, dataInicio, dataFim, dataCadastro, localAula_idLocalAula, endereco_idEndereco, inativo) VALUES ($this->idAulaPermanenteGrupo, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->diaSemana, $this->horaInicio, $this->horaFim, $this->obs, $this->dataInicio, $this->dataFim, $this->dataCadastro, $this->localAulaIdLocalAula, $this->enderecoIdEndereco, $this->inativo)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }

    /**
     * deleteAulaPermanenteGrupo() Function
     */
    function deleteAulaPermanenteGrupo() {
        $sql = "DELETE FROM aulaPermanenteGrupo WHERE idAulaPermanenteGrupo = $this->idAulaPermanenteGrupo";
	//	echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * updateFieldAulaPermanenteGrupo() Function
     */
    function updateFieldAulaPermanenteGrupo($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE aulaPermanenteGrupo SET " . $field . " = " . $value . " WHERE idAulaPermanenteGrupo = $this->idAulaPermanenteGrupo";
	//	echo $sql;
        $result = $this -> query($sql, true);
    }

    /**
     * updateAulaPermanenteGrupo() Function
     */
    function updateAulaPermanenteGrupo() {
        $sql = "UPDATE aulaPermanenteGrupo SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, diaSemana = $this->diaSemana, horaInicio = $this->horaInicio, horaFim = $this->horaFim, obs = $this->obs, dataInicio = $this->dataInicio, dataFim = $this->dataFim, localAula_idLocalAula = $this->localAulaIdLocalAula, endereco_idEndereco = $this->enderecoIdEndereco WHERE idAulaPermanenteGrupo = $this->idAulaPermanenteGrupo";
        $result = $this -> query($sql, true);
    }

    /**
     * selectAulaPermanenteGrupo() Function
     */
    function selectAulaPermanenteGrupo($where = "WHERE 1") {
        $sql = "SELECT SQL_CACHE idAulaPermanenteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, diaSemana, horaInicio, horaFim, obs, dataInicio, dataFim, dataCadastro, localAula_idLocalAula, endereco_idEndereco FROM aulaPermanenteGrupo " . $where;
	//	echo $sql;
        return $this -> executeQuery($sql);
    }

    /**
     * selectAulaPermanenteGrupoTr() Function
     */
    function selectAulaPermanenteGrupoTr($where = "") {

        $Professor = new Professor();
        $AulaGrupoProfessor = new AulaGrupoProfessor();
		$ValorHoraGrupo = new ValorHoraGrupo();
        $BuscaProfessor = new BuscaProfessor();
        $Endereco = new Endereco();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();

        $sql = "SELECT SQL_CACHE idAulaPermanenteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, diaSemana, horaInicio, horaFim, obs, dataInicio, dataFim, dataCadastro, localAula_idLocalAula, endereco_idEndereco, inativo FROM aulaPermanenteGrupo " . $where;
	//	echo $sql;
        $result = $this -> query($sql);

        $html = "
            <thead>
        <tr>
          <th>Dia</th>
          <th>Endereço</th>
          <th>Professor</th>
		  <th>Valor hora </th>
          <th>Histórico professores</th>
          <th></th>
        </tr>
      </thead>
            
      <tbody>";

        if (mysqli_num_rows($result) > 0) {

            $totalHoras = 0;

           

            while ($valor = mysqli_fetch_array($result)) {

                $idAulaPermanenteGrupo = $valor['idAulaPermanenteGrupo'];
                $idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
                $idEndereco = $valor['endereco_idEndereco'];
				
				$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);

                $totalHoras += ($valor['horaFim'] - $valor['horaInicio']) * 4;

                $caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/aulaPermanenteGrupo.php?id=" . $idPlanoAcaoGrupo;
				
				$dataAtual = date("Y-m-d");
				
				$valorHG = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND ((dataFim is null) OR (dataFim >= '".$dataAtual."')) AND cargaHorariaFixaMensal is not null");

				if ($valorHG[0]['cargaHorariaFixaMensal'] > 1 ) {
				
				$carga = "Carga horária Fixa: ".Uteis::exibirHoras($valorHG[0]['cargaHorariaFixaMensal']);
				
				}

                $html .= "<tr>";

                $dataInicio = $valor['dataInicio'];
                $dataFim = $valor['dataFim'];
				
				$atualizarD = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/novaAula.php?tipoAula=AP&atualizar=1&id=".$idPlanoAcaoGrupo."&idAulaPermanenteGrupo=" . $idAulaPermanenteGrupo ."', '$caminhoAtualizar', '#div_aulaPermanenteGrupo')\" ";
				

                $dias = "<a $atualizarD title=\"inico em " . Uteis::exibirData($dataInicio) . "\">" . $this -> montaDias($idAulaPermanenteGrupo) . "</a>";

                $valorAulaGrupoProfessor = $this -> professorDoDia($valor['idAulaPermanenteGrupo']);

                //BUSCA
                $valorBuscaProfessor = $BuscaProfessor -> selectBuscaProfessor(" WHERE finalizada = 0 AND excluida = 0 AND aulaPermanenteGrupo_idAulaPermanenteGrupo = " . $idAulaPermanenteGrupo);
			//	Uteis::pr($valorBuscaProfessor);
				
				$caminhoAtualizarB = CAMINHO_REL."grupo/include/resourceHTML/busca.php?id=" . $idPlanoAcaoGrupo."&idBuscaProfessor=" . $valorBuscaProfessor[0]['idBuscaProfessor'];
                //VER SE O DIA JA ESTA NA BUSCA
                if ($valorBuscaProfessor) {
					
                    $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/busca.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idBuscaProfessor=" . $valorBuscaProfessor[0]['idBuscaProfessor'] . "', '$caminhoAtualizarB', '#buscaRelacimento')\" ";
                    $novaBusca = "<img src=\"" . CAMINHO_IMG . "success.png\" title=\"Ja está em busca\" $onclick >&nbsp;";
                } else {

                    //VER SE HA PROFESSOR COM SAIDA PROGRAMADA
                    $where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = " . $idAulaPermanenteGrupo . " AND (dataFim = '' OR dataFim IS NULL)";
                    //" AND (dataInicio > '".$dataInicio."' ".($dataFim ? "OR dataFim < '".$dataFim."'" : "").") ";
                    //echo "<br>$where";
                    $valorAulaGrupoProfessor2 = $AulaGrupoProfessor -> selectAulaGrupoProfessor($where);

                    $novaBusca = "";
                    //echo "<br>".count($valorAulaGrupoProfessor)." || ".count($valorAulaGrupoProfessor2);
                    if (!$valorAulaGrupoProfessor2) {
                        $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/buscaProfessor.php?idAulaPermanenteGrupo=" . $idAulaPermanenteGrupo . "&tipo=5', '$caminhoAtualizarB', '#buscaRelacimento')\" ";
                        $novaBusca = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Iniciar busca de professor\" $onclick >&nbsp;";
                    }
                }
                $atualizar = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/localAula.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idAulaPermanenteGrupo=" . $idAulaPermanenteGrupo ."', '$caminhoAtualizar', '#div_aulaPermanenteGrupo')\" ";
                //DIAS
                $inicio = $valor['dataInicio'] > date('Y-m-d') ? " - <font color=\"#009900;\"> iniciará em " . Uteis::exibirData($valor['dataInicio']) . "</font>" : "";
                $fim = $valor['dataFim'] ? " - <font color=\"#FF0000\">sairá em " . Uteis::exibirData($valor['dataFim']) . "</font>" : "";

                $html .= "<td>" . $novaBusca . $dias . $inicio . $fim . "</td>";

                $html .= "<td $atualizar>" . (($Endereco -> getEnderecoCompleto($idEndereco))?$Endereco->getEnderecoCompleto($idEndereco):'Endereço não encontrado ou não informado!')."</td>";
                
                $html .= "<td>";

					$valorHtml = "";
                //PROFESSORES ATUAIS
                if ($valorAulaGrupoProfessor) {
					
                    foreach ($valorAulaGrupoProfessor as $valor2) {

                        $idProfessor = $valor2['professor_idProfessor'];
                        $idAulaGrupoProfessor = $valor2['idAulaGrupoProfessor'];

                        $dataFim = $valor2['dataFim'];
                        $dataInicio = $valor2['dataInicio'];

                        $dataEntrada = $dataInicio > date('Y-m-d') ? " - <font color=\"#009900;\">iniciará em " . Uteis::exibirData($dataInicio) . "</font>" : "";
                        $dataFim = $dataFim ? " - <font color=\"#FF0000\">sairá em " . Uteis::exibirData($dataFim) . "</font>" : "";
                        
                        $editar = $editar = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=".$idProfessor."', '$caminhoAtualizar', '#div_aulaPermanenteGrupo');\" style=\"margin-right:1em;\">";
                        
                        $delete = "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"REMOVER PROFESSOR\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/deleta_professor.php?id=" . $idAulaGrupoProfessor . "', '$caminhoAtualizar', '#div_aulaPermanenteGrupo');\" style=\"margin-right:1em;\">";

                        $nomeProfessor = "<a title=\"inico em " . Uteis::exibirData($dataInicio) . "\">" . $Professor -> getNome($idProfessor) . "</a>";
						$html .= $delete . $editar . $nomeProfessor . $dataEntrada . $dataFim . "<br>";
					
                         $editarValor = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar valor hora deste professor para esta aula\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/valorHora.php?idProfessor=" . $idProfessor . "&idAulaPermanenteGrupo=".$idAulaPermanenteGrupo ."&id=" . $idAulaGrupoProfessor . "', '".CAMINHO_REL."grupo/include/resourceHTML/aulaPermanenteGrupo.php?id=".$idPlanoAcaoGrupo ."', '#div_aulaPermanenteGrupo')\" >";
						
						if ($valor2['plano'] != '')  {
						$valorHtml .= "<div align=\"center\" style=\"color:green;font-weight:800;\" title=\"Valor negociado\"> R$ ".Uteis::formatarMoeda($valor2['plano']). $editarValor."</div>";
						} else {
						$valorHtml .= "<div align=\"center\"  title=\"Valor plano de carreira professor\"> R$ " . Uteis::formatarMoeda($Professor->getPlanoCarreira($idProfessor, $idIdioma)) .$editarValor. "</div>";	
							
						}
                    }
                }
                $html .= "</td>";
				
				$html .= "<td>".$valorHtml."</td>";

                //HITORICO DE PROFESSORES
                $html .= "<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/resourceHTML/aulaGrupoProfessor_historico.php?idAulaPermanenteGrupo=" . $idAulaPermanenteGrupo . "', '$caminhoAtualizar', '#div_aulaPermanenteGrupo');\" >
                    <img src=\"" . CAMINHO_IMG . "pasta16.png\" title=\"HITORICO DE PROFESSORES\">
                </td>";

                //EXCLUIR
                $html .= "<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/aulaPermanenteGrupo_desvinculo.php?idAulaPermanenteGrupo=" . $idAulaPermanenteGrupo . "', '$caminhoAtualizar', '#div_aulaPermanenteGrupo');\" >
                    <img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Remover dia\">
                </td>";

                $html .= "</tr>";
            }
        }

        $html .= "
            </tbody>
      <tfoot>
        <tr>
          <th>";
		  if ($valorHG[0]['cargaHorariaFixaMensal'] > 1 ) {
			  
			  $html .= $carga;
			  
		  } else {
		  
		  
		  $html .= Uteis::exibirHoras($totalHoras) . " [ mês comercial cheio ]</th>";
		  }
		  
		  $html .= "</td>
          <th>Endereço</th>
          <th>Professor</th>
		  <th>Valor hora </th>
          <th>Histórico professores</th>
          <th></th>
        </tr>
      </tfoot>
    </table>";

        return $html;
    }

    function selectAulaPermanenteGrupoTr_historico($where = "") {

        $sql = "SELECT SQL_CACHE idAulaPermanenteGrupo, dataInicio, dataFim, planoAcaoGrupo_idPlanoAcaoGrupo 
        FROM aulaPermanenteGrupo WHERE dataFim < CURDATE() " . $where;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            $Professor = new Professor();
            $AulaGrupoProfessor = new AulaGrupoProfessor();

            while ($valor = mysqli_fetch_array($result)) {

                $html .= "<tr>";

                //DIAS
                $dias = $this -> montaDias($valor['idAulaPermanenteGrupo']);
                $html .= "<td>" . $dias . "</td>";

                //INICIO
                $dataInicio = Uteis::exibirData($valor['dataInicio']);
                $html .= "<td>" . $dataInicio . "</td>";

                //SAIDA
                $dataFim = Uteis::exibirData($valor['dataFim']);
                $html .= "<td>" . $dataFim . "
                    <img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Alterar data de saída retroativamente\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/aulaPermanenteGrupo_desvinculo.php?idAulaPermanenteGrupo=" . $valor['idAulaPermanenteGrupo'] . "', '" . CAMINHO_REL . "grupo/include/resourceHTML/aulaPermanenteGrupo_historico.php?id=" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'] . "', '');\">
                </td>";

                //HITORICO DE PROFESSORES
                $html .= "<td align=\"center\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/resourceHTML/aulaGrupoProfessor_historico.php?idAulaPermanenteGrupo=" . $valor['idAulaPermanenteGrupo'] . "', '" . CAMINHO_REL . "grupo/include/resourceHTML/aulaPermanenteGrupo_historico.php?id=" . $valor['planoAcaoGrupo_idPlanoAcaoGrupo'] . "', '')\" >
                    <img src=\"" . CAMINHO_IMG . "pasta16.png\" title=\"HITORICO DE PROFESSORES\">
                </td>";
                
                $html .= "</tr>";
            }
        }
        return $html;
    }

    /**
     * selectAulaPermanenteGrupoSelect() Function
     */
    function selectAulaPermanenteGrupoSelect($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idAulaPermanenteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, diaSemana, horaInicio, horaFim, obs, dataInicio, dataFim, dataCadastro, localAula_idLocalAula, endereco_idEndereco FROM aulaPermanenteGrupo " . $where;
	//	echo $sql;
        $result = $this -> query($sql);
        $html = "<select id=\"idAulaPermanenteGrupo\" name=\"idAulaPermanenteGrupo\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idAulaPermanenteGrupo'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idAulaPermanenteGrupo'] . "\">" . ($valor['idAulaPermanenteGrupo']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    function montaDias($idAulaPermanenteGrupo) {

        $valorAulaPermanenteGrupo = $this -> selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = " . $idAulaPermanenteGrupo);
        $diaSemana = Uteis::exibirDiaSemana($valorAulaPermanenteGrupo[0]['diaSemana']);
        $horaInicio = Uteis::exibirHoras($valorAulaPermanenteGrupo[0]['horaInicio']);
        $horaFim = Uteis::exibirHoras($valorAulaPermanenteGrupo[0]['horaFim']);
		if ($diaSemana != "") {
        return "$diaSemana das $horaInicio às $horaFim";
		}
    }
	
		

    function professorDoDia($idAulaPermanenteGrupo, $and = "") {

        $AulaGrupoProfessor = new AulaGrupoProfessor();

        $where = " WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo = " . $idAulaPermanenteGrupo . " AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '') ORDER BY dataInicio ";
        $rs = $AulaGrupoProfessor -> selectAulaGrupoProfessor($where);
        return $rs;
    }

    //VERIFICA DIAS DA FF
    function ffTem_AulaPermanenteGrupo($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor = "") {
    $diasNoMes = Uteis::totalDiasMes($mesRef, $anoRef);

        $sql = " SELECT AP.idAulaPermanenteGrupo, AP.diaSemana, AP.horaInicio, AP.horaFim, AG.dataInicio, AG.dataFim FROM aulaPermanenteGrupo AS AP ";
        $sql .= "INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo ";

        if ($idProfessor){
            $idProfessor = " AND AG.professor_idProfessor = " . $idProfessor;
    }
        $sql .= " WHERE (AG.dataFim > '" . $anoRef . "-" . $mesRef . "-01' OR AG.dataFim IS NULL OR AG.dataFim = '') AND AG.dataInicio <= '" . $anoRef . "-" . $mesRef . "-" . $diasNoMes . "'";
        $sql .= " AND AP.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo." AND AP.inativo = 0".$idProfessor;
//        echo $sql;
        $valor = Uteis::executarQuery($sql);
        return $valor;
    }


    function ffTem_AulaPermanenteGrupoDemonstrativo($idPlanoAcaoGrupo, $anoRef, $mesRef) {
    $diasNoMes = Uteis::totalDiasMes($mesRef, $anoRef);

        $sql = " SELECT AP.idAulaPermanenteGrupo, AP.diaSemana, AP.horaInicio, AP.horaFim, AP.dataInicio, AP.dataFim FROM aulaPermanenteGrupo AS AP ";
        $sql .= " WHERE (AP.dataFim > '" . $anoRef . "-" . $mesRef . "-01'";
		//AND AP.dataFim != AP.dataInicio 
		$sql .= " OR AP.dataFim IS NULL OR AP.dataFim = '') AND AP.dataInicio <= '" . $anoRef . "-" . $mesRef . "-" . $diasNoMes . "'";
        $sql .= " AND AP.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo." AND AP.inativo = 0";
 //       echo $sql;
        $valor = Uteis::executarQuery($sql);
        return $valor;
    }
	
	 function getPlanoAcaoGrupo($value) {
		   $valor = $this->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$value);
	//	   Uteis::pr($valor);
		   $rs = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		   return $rs;
	   
   }

}
?>