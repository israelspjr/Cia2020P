<?php
class AulaDataFixa extends Database {
    // class attributes
    var $idAulaDataFixa;
    var $planoAcaoGrupoIdPlanoAcaoGrupo;
    var $dataAula;
    var $horaInicio;
    var $horaFim;
    var $obs;
    var $dataCadastro;
    var $localAulaIdLocalAula;
    var $enderecoIdEndereco;
    var $excluido;
    var $addFrom;

    // constructor
    function __construct() {
        parent::__construct();
        $this -> idAulaDataFixa = "NULL";
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
        $this -> dataAula = "NULL";
        $this -> horaInicio = "NULL";
        $this -> horaFim = "NULL";
        $this -> obs = "NULL";
        $this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
        $this -> localAulaIdLocalAula = "NULL";
        $this -> enderecoIdEndereco = "NULL";
        $this -> addFrom = "0";
        $this -> excluido = "0";

    }

    function __destruct() {
        parent::__destruct();
    }

    // class methods
    function setIdAulaDataFixa($value) {
        $this -> idAulaDataFixa = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
        $this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setDataAula($value) {
        $this -> dataAula = ($value) ? $this -> gravarBD($value) : "NULL";
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

    function setDataCadastro($value) {
        //$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
    }

    function setLocalAulaIdLocalAula($value) {
        $this -> localAulaIdLocalAula = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setEnderecoIdEndereco($value) {
        $this -> enderecoIdEndereco = ($value) ? $this -> gravarBD($value) : "NULL";
    }

    function setExcluido($value) {
        $this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
    }
    function setAddFrom($value) {
        $this -> addFrom = ($value) ? $this -> gravarBD($value) : "0";
    }

    /**
     * addAulaDataFixa() Function
     */
    function addAulaDataFixa() {
      
        $sql = "INSERT INTO aulaDataFixa (planoAcaoGrupo_idPlanoAcaoGrupo, dataAula, horaInicio, horaFim, obs, dataCadastro, localAula_idLocalAula, endereco_idEndereco, excluido, addFrom) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->dataAula, $this->horaInicio, $this->horaFim, $this->obs, $this->dataCadastro, $this->localAulaIdLocalAula, $this->enderecoIdEndereco, $this->excluido, $this->addFrom)";
        $result = $this -> query($sql, true);
        return mysqli_insert_id($this -> connect);
    }

    function Migracao() {
      
        $sql = "INSERT INTO aulaDataFixa (idAulaDataFixa, planoAcaoGrupo_idPlanoAcaoGrupo, dataAula, horaInicio, horaFim, obs, dataCadastro, localAula_idLocalAula, endereco_idEndereco, excluido, addFrom) VALUES ($this->idAulaDataFixa, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->dataAula, $this->horaInicio, $this->horaFim, $this->obs, $this->dataCadastro, $this->localAulaIdLocalAula, $this->enderecoIdEndereco, $this->excluido, $this->addFrom)";
        $result = $this -> query($sql, true);
        return mysqli_insert_id($this -> connect);
    }
    
    /**
     * deleteAulaDataFixa() Function
     */
    function deleteAulaDataFixa() {
        $sql = "DELETE FROM aulaDataFixa WHERE idAulaDataFixa = $this->idAulaDataFixa";
        $result = $this -> query($sql);
    }

    /**
     * updateFieldAulaDataFixa() Function
     */
    function updateFieldAulaDataFixa($field, $value) {
        $value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
        $sql = "UPDATE aulaDataFixa SET " . $field . " = " . $value . " WHERE idAulaDataFixa = $this->idAulaDataFixa";
        $result = $this -> query($sql);
    }

    /**
     * updateAulaDataFixa() Function
     */
    function updateAulaDataFixa() {
        $sql = "UPDATE aulaDataFixa SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, dataAula = $this->dataAula, horaInicio = $this->horaInicio, horaFim = $this->horaFim, obs = $this->obs, localAula_idLocalAula = $this->localAulaIdLocalAula, endereco_idEndereco = $this->enderecoIdEndereco, addFrom = $this->addFrom  WHERE idAulaDataFixa = $this->idAulaDataFixa";
        $result = $this -> query($sql);
    }

    /**
     * selectAulaDataFixa() Function
     */
    function selectAulaDataFixa($where = "") {
        $sql = "SELECT SQL_CACHE idAulaDataFixa, planoAcaoGrupo_idPlanoAcaoGrupo, dataAula, horaInicio, horaFim, obs, dataCadastro, localAula_idLocalAula, endereco_idEndereco FROM aulaDataFixa WHERE excluido = 0 ".$where;
   //     echo $sql;
        //exit;
        return $this -> executeQuery($sql);
    }

    function selectAulaDataFixaTr($where = "") {
		
		$Professor = new Professor();

        $sql = "SELECT SQL_CACHE 
		idAulaDataFixa, planoAcaoGrupo_idPlanoAcaoGrupo, dataAula, horaInicio, horaFim, obs, dataCadastro, localAula_idLocalAula, endereco_idEndereco 
		FROM aulaDataFixa WHERE excluido = 0 " . $where;
        $result = $this -> query($sql);

        $html = "
		<thead>
			<tr>
				<th></th>
				<th>Dia</th>
				<th>Endereço</th>
				<th>Professor</th>
				<th>Valor hora</th>
				<th></th>
			</tr>
		</thead>
			<tbody>";

        if (mysqli_num_rows($result) > 0) {

            $totalHoras = 0;

            $Professor = new Professor();
            $BuscaProfessor = new BuscaProfessor();
            $Endereco = new Endereco();

            while ($valor = mysqli_fetch_array($result)) {

                $idAulaDataFixa = $valor['idAulaDataFixa'];
                $idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
                $idEndereco = $valor['endereco_idEndereco'];
                $totalHoras += ($valor['horaFim'] - $valor['horaInicio']);

                $caminhoAtualizar = CAMINHO_REL . "grupo/include/resourceHTML/diasDeAula_planoAcaoGrupo.php?id=" . $idPlanoAcaoGrupo;

                $html .= "<tr>";

                //COLUNA OCULTA PELO DATAABLES, APENAS PARA ORDENAR
                $html .= "<td>" . strtotime($valor['dataAula']);
                "</td>";

                $valorAulaGrupoProfessor = $this -> professorDoDia($idAulaDataFixa);

                //BUSCA
                $valorBuscaProfessor = $BuscaProfessor -> selectBuscaProfessor(" WHERE finalizada = 0 AND excluida = 0 AND aulaDataFixa_idAulaDataFixa = " . $idAulaDataFixa);
                $valorBuscaProfessor = $valorBuscaProfessor[0];

                //VER SE O DIA JA ESTA NA BUSCA
                $novaBusca = "";

                if ($valorBuscaProfessor) {
                    $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/resourceHTML/busca.php?idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo . "&idBuscaProfessor=" . $valorBuscaProfessor['idBuscaProfessor'] . "', '$caminhoAtualizar', '#diasDeAula_planoAcaoGrupo')\" ";
                    $novaBusca = "<img src=\"" . CAMINHO_IMG . "success.png\" title=\"Ja está em busca\" $onclick >&nbsp;";
                } elseif (!$valorAulaGrupoProfessor) {
                    $onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/buscaProfessor.php?idAulaDataFixa=" . $idAulaDataFixa . "&dataInicio=" . Uteis::exibirData($valor['dataAula']) . "&tipo=5', '$caminhoAtualizar', '#diasDeAula_planoAcaoGrupo')\" ";
                    $novaBusca = "<img src=\"" . CAMINHO_IMG . "pa.png\" title=\"Iniciar busca de professor\" $onclick >&nbsp;";
                }
                
                $atualizar = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/localAula.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idAulaDataFixa=" . $idAulaDataFixa ."', '$caminhoAtualizar', '#diasDeAula_planoAcaoGrupo')\" ";

                $dias = $this -> montaDias($idAulaDataFixa);

                $html .= "<td>" . $novaBusca . $dias . "</td>";

                $html .= "<td $atualizar>" . (($Endereco -> getEnderecoCompleto($idEndereco))?$Endereco->getEnderecoCompleto($idEndereco):'Endereço não encontrado')."</td>";

                $nomeProfessor = "";
				$valorHtml = "";
                if ($valorAulaGrupoProfessor) {

                    $idAulaGrupoProfessor = $valorAulaGrupoProfessor['idAulaGrupoProfessor'];
                    $idProfessor = $valorAulaGrupoProfessor['professor_idProfessor'];
					$valorPlano = $valorAulaGrupoProfessor['plano'];

                    $onclick = " onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/deleta_professor.php?acao2=AulaDataFixa', '" . $idAulaGrupoProfessor . "', '$caminhoAtualizar', '#diasDeAula_planoAcaoGrupo');\" ";
                    $onclick2 = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=".$idProfessor."', '$caminhoAtualizar', '#diasDeAula_planoAcaoGrupo');\" ";
                    
                    
                    $delete = "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"REMOVER PROFESSOR\" $onclick style=\"margin-right:1em;\">";
                    $editar = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" $onclick2 style=\"margin-right:1em;\">";

                    $nomeProfessor = $Professor -> selectProfessor(" WHERE idProfessor = " . $idProfessor);
                    $nomeProfessor = $delete . $editar . $nomeProfessor[0]['nome'];
					
					  $editarValor = "<img src=\"" . CAMINHO_IMG . "editar.png\" title=\"Editar valor hora deste professor para esta aula\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/valorHora.php?idProfessor=" . $idProfessor . "&idAulaFixa=".$idAulaDataFixa ."', '".CAMINHO_REL."grupo/include/resourceHTML/aulaDataFixa.php?id=".$idPlanoAcaoGrupo ."', '#div_aulaDataFixa')\" >";
						
						if ($valorPlano != '')  {
						$valorHtml .= "<div align=\"center\"> R$ ".Uteis::formatarMoeda($valorPlano). $editarValor."</div>";
						} else {
						$valorHtml .= "<div align=\"center\"> R$ " . Uteis::formatarMoeda($Professor->getPlanoCarreira($idProfessor, $idIdioma)) .$editarValor. "</div>";	
							
						}

                }

                $html .= "<td>" . $nomeProfessor . "</td>";
				
				$html .= "<td>" . $valorHtml. "</td>";

                $html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/aulaDataFixa.php', '" . $valor['idAulaDataFixa'] . "', '$caminhoAtualizar', '#div_aulaDataFixa');\" >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Remover dia\">" . "</td>";

                $html .= "</tr>";
            }
        }

        $html .= "<tbody>
						
			<tfoot>
        <tr>
          <th></th>
          <th>" . Uteis::exibirHoras($totalHoras) . "</th>
          <th>Endereço</th>
		  <th>Professor</th>
          <th>Valor hora</th>
          <th></th>
        </tr>
      </tfoot>
		</table>";

        return $html;
    }

    function selectAulaDataFixaTr_historico($where = "") {

        $sql = "SELECT SQL_CACHE idAulaDataFixa, dataAula, horaInicio, horaFim FROM aulaDataFixa WHERE excluido = 1 ".$where;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {

            $html = "";

            $Professor = new Professor();
            $AulaGrupoProfessor = new AulaGrupoProfessor();

            while ($valor = mysqli_fetch_array($result)) {

                $html .= "<tr>";

                //DIAS
                $dias = Uteis::exibirData($valor['dataAula']);
                $html .= "<td>" . strtotime($valor['dataAula']) . "</td>";
                $html .= "<td>" . $dias . "</td>";

                //INICIO
                $dataInicio = Uteis::exibirHoras($valor['horaInicio']);
                $html .= "<td>" . $dataInicio . "</td>";

                //SAIDA
                $dataFim = Uteis::exibirHoras($valor['horaFim']);
                $html .= "<td>" . $dataFim . "</td>";

                //HITORICO DE PROFESSORES
                $idProfessor = $this -> professorDoDia($valor['idAulaDataFixa']);
                $idProfessor = $idProfessor['professor_idProfessor'];
                $nomeProfessor = $Professor -> selectProfessor(" WHERE idProfessor = '" . $idProfessor . "'");
                $nomeProfessor = $nomeProfessor[0]['nome'];
                $html .= "<td align=\"center\" $onclick >" . $nomeProfessor . "</td>";

                $html .= "</tr>";
            }
        }
        return $html;
    }

    function selectAulaDataFixaProfTr($plano = "") {

        $sql = "SELECT idAulaDataFixa, dataAula, horaInicio, horaFim, addFrom FROM aulaDataFixa WHERE excluido = 0 AND addFrom = 1 AND planoAcaoGrupo_idPlanoAcaoGrupo = " . $plano;
        $result = $this -> query($sql);

       

        if (mysqli_num_rows($result) > 0) {


            while ($valor = mysqli_fetch_array($result)) {
                $html = "";
                $caminhoAtualizar = CAMINHO_MODULO . "resourceHTML/aulaDataFixa.php?id=".$idPlanoAcaoGrupo;
                $html .= "<tr>";
                $html .= "<td align=\"center\">".Uteis::exibirData($valor['dataAula'])."</td>";
                $html .= "<td align=\"center\">".Uteis::exibirHoras($valor['horaInicio'])."</td>";
                $html .= "<td align=\"center\">".Uteis::exibirHoras($valor['horaFim'])."</td>";
                $html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_MODULO . "acao/aulaDataFixa.php', '" . $valor['idAulaDataFixa'] . "', '$caminhoAtualizar', '#div_aulaDataFixa');\" >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Remover dia\">" . "</td>";
                $html .= "</tr>";
            }
        }
        return ($html);
    }

    function selectAulaDataFixaProfH($plano = "") {

        $sql = "SELECT idAulaDataFixa, dataAula, horaInicio, horaFim, addFrom FROM aulaDataFixa WHERE excluido = 1 AND addFrom > 0 AND planoAcaoGrupo_idPlanoAcaoGrupo = " . $plano;
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {
           
             $html = "";
            while ($valor = mysqli_fetch_array($result)) {
                $html .= "<tr>";
                //DIAS
                $dias = Uteis::exibirData($valor['dataAula']);
                $html .= "<td>" . $dias . "</td>";
                //INICIO
                $dataInicio = Uteis::exibirHoras($valor['horaInicio']);
                $html .= "<td>" . $dataInicio . "</td>";
                //SAIDA
                $dataFim = Uteis::exibirHoras($valor['horaFim']);
                $html .= "<td>" . $dataFim . "</td>";               
                $html .= "</tr>";
            }
        }
        return ($html);
    }

    /**
     * selectAulaDataFixaSelect() Function
     */
    function selectAulaDataFixaSelect($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idAulaDataFixa, planoAcaoGrupo_idPlanoAcaoGrupo, dataAula, horaInicio, horaFim, obs, dataCadastro, localAula_idLocalAula, endereco_idEndereco FROM aulaDataFixa " . $where;
        $result = $this -> query($sql);
        $html = "<select id=\"idAulaDataFixa\" name=\"idAulaDataFixa\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idAulaDataFixa'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idAulaDataFixa'] . "\">" . ($valor['idAulaDataFixa']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

    function montaDias($idAulaDataFixa) {

        $valorAulaDataFixa = $this -> selectAulaDataFixa(" AND idAulaDataFixa = " . $idAulaDataFixa);
        $dataAula = Uteis::exibirData($valorAulaDataFixa[0]['dataAula']);
        $horaInicio = Uteis::exibirHoras($valorAulaDataFixa[0]['horaInicio']);
        $horaFim = Uteis::exibirHoras($valorAulaDataFixa[0]['horaFim']);
        return "$dataAula das $horaInicio às $horaFim";
    }

    function professorDoDia($idAulaDataFixa) {
        $AulaGrupoProfessor = new AulaGrupoProfessor();
        $Professor = new Professor();

        $valorAulaGrupoProfessor = $AulaGrupoProfessor -> selectAulaGrupoProfessor(" WHERE aulaDataFixa_idAulaDataFixa = " . $idAulaDataFixa);
        return $valorAulaGrupoProfessor[0];
    }

    function ffTem_AulaDataFixa($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor = "") {

        $sql = " SELECT DISTINCT(AF.idAulaDataFixa), AF.dataAula, AF.horaInicio, AF.horaFim, AF.addFrom FROM aulaDataFixa AS AF ";
        $sql .= " INNER JOIN aulaGrupoProfessor AS AG ON AG.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa ";

        if ($idProfessor)
            $sql .= " AND AG.professor_idProfessor = " . $idProfessor;

        $sql .= " WHERE AF.excluido = 0 AND MONTH(AF.dataAula) = " . $mesRef . " AND YEAR(AF.dataAula) = " . $anoRef . " AND AF.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
        //echo $sql;
        $valor = Uteis::executarQuery($sql);
        return $valor;
    }
     function ffTem_AulaDataFixaDemonstrativo($idPlanoAcaoGrupo, $anoRef, $mesRef, $idProfessor = "") {

        $sql = " SELECT DISTINCT(AF.idAulaDataFixa), AF.dataAula, AF.horaInicio, AF.horaFim, AF.addFrom FROM aulaDataFixa AS AF ";
        $sql .= " WHERE AF.excluido = 0 AND MONTH(AF.dataAula) = " . $mesRef . " AND YEAR(AF.dataAula) = " . $anoRef . " AND AF.planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo;
        $valor = Uteis::executarQuery($sql);
        return $valor;
    }

}
?>