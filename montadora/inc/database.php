<?php
//Dados do banco de dados
define("DB_HOST", "localhost");
define("DB_NAME", "gestor_evento");
define("DB_USER", "root");
define("DB_PASS", "Blaster631xd");

//Conexao com Banco de Dados
return new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USER, DB_PASS);



mysqli_report(MYSQLI_REPORT_STRICT);
function open_database() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}
function close_database($conn) {
    try {
        mysqli_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 *  Pesquisa Todos os Registros de uma Tabela
 */
function find_all( $table ) {
    return find($table);
}


function pesquisa_like( $tabela = null, $coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $condition = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($valor1) {
            $sql = "SELECT * FROM ".$tabela." WHERE ".$coluna1."  like '%".$valor1."%'  AND ".$coluna2." = '".$valor2."' ".$condition."";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

function pesquisaJoinLike( $id = null, $pesquisa = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
        
            $sql = "SELECT * FROM grupo_produto 
            INNER JOIN empresas ON grupo_produto.id_empresa = empresas.id 
            INNER JOIN contatos ON empresas.id = contatos.id_empresa
            WHERE (grupo_produto.nome like '%".$pesquisa."%'  OR empresas.nome_fantasia like '%".$pesquisa."%' OR contatos.nome like '%".$pesquisa."%' AND grupo_produto.id_pai = '".$id."'  AND grupo_produto.deleted = '0')";	
            
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA COTA��O RELACIONADA COM PRODUTOS
function pesquisa_cotacao_produto( $id = null, $id2 = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM cotacao
			INNER JOIN produto ON produto.id = cotacao.id_produto
			WHERE 
            cotacao.cotacao_finalizada = 0
            and cotacao.id_pai = ".$id."
            and cotacao.id_grupo_produto = ".$id2." 
            and cotacao.deleted = 0 
            and cotacao.cotacao_finalizada = 0 
			and produto.deleted = 0
			ORDER BY cotacao.id_cotacao ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA 2 TABELAS RELACIONADAS
function pesquisa_duas_tabelas( $id = null, $id_edicao = null, $id_usuario = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM equipe
			INNER JOIN usuarios ON usuarios.id = equipe.id_usuario
			WHERE usuarios.id_pai = ".$id."  
			and usuarios.modulo = 5 
			and equipe.deleted = 0 
			and usuarios.deleted = 0 
			ORDER BY usuarios.nome_usuario ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA 3 TABELAS RELACIONADAS
function pesquisa_tabelas($id = null, $id_user = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM briefing
			INNER JOIN grupo_produto ON briefing.id_negocio = grupo_produto.id
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN evento_edicao ON evento_edicao.id = grupo_produto.id_edicao WHERE briefing.id_usuario = ".$id_user."  and briefing.status = 0 and briefing.id = '".$id."'  AND grupo_produto.deleted = '0' ";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA 3 TABELAS RELACIONADAS
function pesquisa_tres_tabelas($id = null, $id_user = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN briefing ON briefing.id_grupo_produto = grupo_produto.id WHERE briefing.id_usuario = ".$id_user."  and briefing.status = 0 and grupo_produto.id_pai = '".$id."'  AND grupo_produto.deleted = '0' 
			ORDER BY briefing.id ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA 3 TABELAS RELACIONADAS
function pesquisa_temporaria( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_user = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN agenda ON agenda.id_negocio = grupo_produto.id WHERE grupo_produto.id_negocio = 0  and agenda.status = 0 and grupo_produto.id_pai = '".$id."'  
			AND agenda.posicao_agenda > '0' ";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA 3 TABELAS RELACIONADAS
function pesquisa_relacional_tres( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_user = null) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN agenda ON agenda.id_negocio = grupo_produto.id WHERE agenda.id_usuario = ".$id_user."  and agenda.status = 0 and grupo_produto.id_pai = '".$id."'  AND grupo_produto.deleted = '0' 
			AND agenda.posicao_agenda > '0' ORDER BY agenda.proxima_data ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

// PESQUISA DISTINTA 
function pesquisa_distinta ( $table = null, $coluna = null, $coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null  ) {

    $database = open_database();
    $found = null;
    try {
        if ($valor1) {
            $sql = "SELECT DISTINCT ".$coluna." FROM ".$table." WHERE ".$coluna1." = '".$valor1."'  AND ".$coluna2." = '".$valor2."' AND ".$coluna3." = '".$valor3."' '".$condicao."'";
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
				 $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
        }       
    }	
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);
    return $found;
}




// PESQUISA TRÊS COLUNAS 
function pesquisa_tres_colunas ( $table = null, $coluna1 = null, $valor1 = null, $coluna2 = null, $valor2 = null, $coluna3 = null, $valor3 = null, $condicao = null  ) {

    $database = open_database();
    $found = null;
    try {
        if ($valor1) {
            $sql = "SELECT * FROM ".$table." WHERE ".$coluna1." = '".$valor1."'  AND ".$coluna2." = '".$valor2."' AND ".$coluna3." = '".$valor3."' '".$condicao."'";
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
				 $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
        }       
    }	
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);
    return $found;
}




/**
 *  Pesquisa um Registro pelo ID em uma Tabela e Ordem
 */
function find_order( $table = null, $id = null  ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id_pai = " . $id. " AND deleted = '0' ORDER BY id DESC LIMIT 1 ";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function pesquisa_relacional( $id_pai = null, $id_user = null) {
    $database = open_database();
    $data_hoje = date ("Y-m-d H:i:s"); 
    $found = null;
    try {
        if ($id_pai) {
			$sql = "SELECT * FROM evento_edicao
			INNER JOIN equipe ON equipe.id_edicao = evento_edicao.id
			WHERE equipe.id_pai = ".$id_pai." 
			AND equipe.id_edicao = evento_edicao.id
			AND equipe.id_usuario = ".$id_user."  
            AND equipe.deleted = '0' 
            AND evento_edicao.fim_evento >= '".$data_hoje."'
			ORDER BY evento_edicao.inicio_evento ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function pesquisa_empresa( $id_pai = null, $id_user = null, $id_edicao = null ) {
    $database = open_database();
    $found = null;
    try {
        if ($id_pai) {
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			WHERE grupo_produto.id_pai = ".$id_pai." 
			AND grupo_produto.id_usuario = ".$id_user." 
			AND grupo_produto.id_edicao = ".$id_edicao." 
			AND grupo_produto.deleted = '0' 
			AND grupo_produto.posicao = '0' 
			ORDER BY empresas.nome_fantasia ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_atendimento( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_user = null, $id_edicao = null ) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN agenda ON agenda.id_negocio = grupo_produto.id WHERE grupo_produto.id_edicao = ".$id_edicao."  and agenda.id_usuario = ".$id_user."  and agenda.status = 0 and grupo_produto.id_pai = '".$id."'  AND grupo_produto.deleted = '0' 
			AND agenda.posicao_agenda > '0' ORDER BY agenda.proxima_data ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}


	function find_atendimento2( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_user = null, $id_edicao = null ) {
    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT DISTINCT empresas.nome_fantasia, empresas.fone,contatos.nome,contatos.email,contatos.fone2,contatos.celular,grupo_produto.posicao,agenda.created,grupo_produto.id_edicao FROM grupo_produto INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa INNER JOIN contatos ON contatos.id_empresa = grupo_produto.id_empresa INNER JOIN agenda ON agenda.id_negocio = grupo_produto.id WHERE agenda.status = '0' AND grupo_produto.id_usuario = '".$_REQUEST['id_salesman']."' AND grupo_produto.deleted = '0' GROUP BY nome_fantasia ASC";
			$result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_atendimento_id( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_user = null, $id_edicao = null, $id_negocio = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
            
			$sql = "SELECT * FROM grupo_produto
			INNER JOIN empresas ON empresas.id = grupo_produto.id_empresa
			INNER JOIN agenda ON agenda.id_negocio = grupo_produto.id WHERE grupo_produto.id = ".$id_negocio."  and grupo_produto.id_pai = '".$id."'  AND grupo_produto.deleted = '0'  ORDER BY agenda.created DESC";
			
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function findLeftEvento( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
        
			$sql =  "select * from 
			tbl_servicos_extra se
 where not exists (select 1
                     from tbl_servicos_extra_eventos see
                     join tbl_eventos ev
                       on ev.id_evento = see.id_evento
                    where see.id_servico_extra = se.id_servico_extra
                      and ev.data = :param_data)";

					  
					  
			$sql = "SELECT * FROM empresas 
LEFT JOIN eventos ON empresas.id_evento = eventos.id 
LEFT JOIN controle_pagina ON eventos.id = controle_pagina.id_evento
WHERE (empresas.id_pai = '".$id."'  AND empresas.deleted = '0' )";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_eventos( $table = null, $id1 = null, $table2 = null, $id2 = null, $id = null, $id_fair = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
			$sql = "SELECT * FROM evento_edicao LEFT JOIN eventos "."ON evento_edicao.id_evento = eventos.id WHERE evento_edicao.id_pai = ".$id."  AND evento_edicao.deleted = '0' ORDER BY evento_edicao.inicio_evento ASC" ;
			
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
    return $found;
}

/**
 *  Pesquisa 
 */
function find_two_columns ( $table = null, $columns = null, $values = null, $columns2 = null, $values2 = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($values) {
            $sql = "SELECT * FROM ".$table." WHERE ".$columns." = '".$values."'  AND ".$columns2." = '".$values2."' AND deleted = '0'  ";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_columns_field ( $table = null, $field = null,$columns = null, $values = null, $condition = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($values) {
            $sql = "SELECT ".$field." FROM ".$table." WHERE ".$columns." = '".$values."'  AND deleted = '0'  ".$condition."";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_columns( $table = null, $columns = null, $values = null, $condition = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($values) {
            $sql = "SELECT * FROM ".$table." WHERE ".$columns." = '".$values."'  AND deleted = '0'  ".$condition."";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_columns_like( $table = null, $columns = null, $values = null, $condition = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($values) {
            $sql = "SELECT * FROM ".$table." WHERE ".$columns."  like '%".$values."%'  AND deleted = '0' ".$condition."";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}





/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_account( $table = null, $id = null, $id_evento = null, $order = null, $id_user = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id_evento = ".$id_evento." and id_pai = " . $id . " and id_usuario = " . $id_user . " AND deleted = '0'  ORDER BY ".$order." ASC";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_account_field( $table = null, $field = null, $id = null, $id_evento = null, $order = null, $id_user = null ) {

    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT " . $field . " FROM " . $table . " WHERE id_evento = ".$id_evento." and id_pai = " . $id . " and id_usuario = " . $id_user . " AND deleted = '0'  ORDER BY ".$order." ASC";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               // $found = $result->fetch_assoc();
				 $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
			      $found = $rows;
          
        }       
    }
        
		
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
	
    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find( $table = null, $id = null ) {
	$id_pai = $_SESSION['id_pai'];
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id_pai = ".$id_pai." AND id = " . $id . "  AND deleted = '0'  ";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                $found = $rows;
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find_contato( $table = null, $id = null ) {
	$id_pai = $_SESSION['id_pai'];
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id_pai = ".$id_pai." AND id_empresa = ". $id ." AND deleted = '0' ";

            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                $found = $rows;
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

    // var_dump($found);

    return $found;
}


/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function procurar_contato($id_evento,$id_usuario) {
	$id_pai = $_SESSION['id_pai'];
    $database = open_database();
    $found = 'CAMELO';
    try {
            $sql = "SELECT empresas.nome_fantasia, empresas.fone,contatos.nome,contatos.email,contatos.fone2,contatos.celular FROM empresas INNER JOIN contatos ON empresas.id_pai = contatos.id_pai AND empresas.id = contatos.id_empresa WHERE empresas.deleted = '0' AND empresas.id_evento = ".$id_evento." AND contatos.id_usuario = ".$id_usuario."";
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
               $rows = array();
               
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                $found = $rows;
             }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

    // var_dump($found);

    return $found;
}
/**
 *  Insere um registro no BD
 */
 
 
function save_atendimento($table = null, $data = null, $table_b = null, $data_b = null, $id_r = null) {
    $retorno = false;
    try {
        $database = open_database();
        $columns = null;
        $values = null;
        $columns_b = null;
        $values_b = null;
        
		//print_r($data);
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
        // remove a ultima virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
		
		//print_r($data);
        foreach ($data_b as $key_b => $value_b) {
            $columns_b .= trim($key_b, "'") . ",";
            $values_b .= "'$value_b',";
        }
        // remove a ultima virgula
        $columns_b = rtrim($columns_b, ',');
        $values_b = rtrim($values_b, ',');


//        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";


$sql = "INSERT INTO grupo_produto ($columns)" . " VALUES " . "($values);";

//$id = mysql_insert_id();

$sql_b = "INSERT INTO agenda ($columns_b, id_negocio)" . " VALUES " . "($values_b, LAST_INSERT_ID());";

//$sql_b = "INSERT INTO " . $table_b . "($columns_b)" . " VALUES " . "($values_b);";




        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $database->query($sql);
		$database->query($sql_b);
        $_SESSION['type'] = 'success';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

}
 
function save_four($table = null, $data = null, $table_b = null, $data_b = null, $id_r = null, $table_c = null, $data_c = null, $table_d = null, $data_d = null, $id_negocio = null  ) {
    $retorno = false;
    try {
        $database = open_database();
        $columns = null;
        $values = null;
        $columns_b = null;
        $values_b = null;
		$columns_c = null;
        $values_c = null;
		$columns_d = null;
        $values_d = null;
        
		//print_r($data);
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
        // remove a ultima virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
		
		//print_r($data);
        foreach ($data_b as $key_b => $value_b) {
            $columns_b .= trim($key_b, "'") . ",";
            $values_b .= "'$value_b',";
        }
        // remove a ultima virgula
        $columns_b = rtrim($columns_b, ',');
        $values_b = rtrim($values_b, ',');
		
		//print_r($data);
        foreach ($data_c as $key_c => $value_c) {
            $columns_c .= trim($key_c, "'") . ",";
            $values_c .= "'$value_c',";
        }
        // remove a ultima virgula
        $columns_c = rtrim($columns_c, ',');
        $values_c = rtrim($values_c, ',');
		
		//print_r($data);
        foreach ($data_d as $key_d => $value_d) {
            $columns_d .= trim($key_d, "'") . ",";
            $values_d .= "'$value_d',";
        }
        // remove a ultima virgula
        $columns_d = rtrim($columns_d, ',');
        $values_d = rtrim($values_d, ',');

//        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
		
$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
		
		$database->query($sql);
		$last_id = mysqli_insert_id($database);
		
$sql_b = "INSERT INTO " . $table_b . "($columns_b, $id_r)" . " VALUES " . "($values_b, $last_id);";
		
		$last_id2 = mysqli_insert_id($database);
		
$sql_c = "INSERT INTO " . $table_c . "($columns_c, $id_r)" . " VALUES " . "($values_c, $last_id2);";

		$last_id3 = mysqli_insert_id($database);
		
$sql_d = "INSERT INTO " . $table_d . "($columns_d, $id_r, $id_negocio)" . " VALUES " . "($values_d, $last_id3, LAST_INSERT_ID());";
		
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        
		$database->query($sql_b);
		$database->query($sql_c);
		$database->query($sql_d);
		
        $_SESSION['type'] = 'success';
		
    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

}



/**
 *  Insere um registro no BD
 */
  
function save_two($table = null, $data = null, $table_b = null, $data_b = null, $id_r = null) {
    $retorno = false;
    try {
        $database = open_database();
        $columns = null;
        $values = null;
        $columns_b = null;
        $values_b = null;
        
		//print_r($data);
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
        // remove a ultima virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');
		
		//print_r($data);
        foreach ($data_b as $key_b => $value_b) {
            $columns_b .= trim($key_b, "'") . ",";
            $values_b .= "'$value_b',";
        }
        // remove a ultima virgula
        $columns_b = rtrim($columns_b, ',');
        $values_b = rtrim($values_b, ',');



//        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
		
$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";

//$id = mysql_insert_id();

$sql_b = "INSERT INTO " . $table_b . "($columns_b, $id_r)" . " VALUES " . "($values_b, LAST_INSERT_ID());";

//$sql_b = "INSERT INTO " . $table_b . "($columns_b)" . " VALUES " . "($values_b);";




        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $database->query($sql);
		$database->query($sql_b);
        $_SESSION['type'] = 'success';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    }

    close_database($database);

}


/**
 *  Insere um registro no BD
 */
function save($table = null, $data = null) {
    $retorno = false;
    try {
        $database = open_database();
        $columns = null;
        $values = null;
        //print_r($data);
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
        }
        // remove a ultima virgula
        $columns = rtrim($columns, ',');
        $values = rtrim($values, ',');

        $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";

        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $database->query($sql);
        $_SESSION['type'] = 'success';
		$_SESSION['time_message'] = time();

    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
		$_SESSION['time_message'] = time();
    }

    close_database($database);

}
/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update_columns($table = null, $id_negocio = 0, $data = null) {
    $database = open_database();
    $items = null;
    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
    }
    // remove a ultima virgula
    $items = rtrim($items, ',');
    $sql  = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE id_negocio=" . $id_negocio . ";";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}

function update_variaveis($table = null, $coluna = null, $id = null, $data = null) {
    $database = open_database();
    $items = null;
    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";

    }
    // remove a ultima virgula
    $items = rtrim($items, ',');
    $sql  = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE " . $coluna . "=" . $id . ";";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
		$_SESSION['time_message'] = time();
    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
		$_SESSION['time_message'] = time();
    }
    close_database($database);
}


/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null) {
    $database = open_database();
    $items = null;
    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
    }
    // remove a ultima virgula
    $items = rtrim($items, ',');
    $sql  = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE id=" . $id . ";";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
		$_SESSION['time_message'] = time();
    } catch (Exception $e) {
        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
		$_SESSION['time_message'] = time();
    }
    close_database($database);
}

/**
 *  Remove uma linha de uma tabela pelo ID do registro
 */
function remove( $table = null, $id = null ) {
    $database = open_database();

    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result = $database->query($sql)) {
                $_SESSION['message'] = "Registro Removido com Sucesso.";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}