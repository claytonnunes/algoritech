<?php
/** O nome do banco de dados*/
//define('DB_NAME', 'db_promotora');
define('DB_NAME', 'gestor_evento');

/** Usuário do banco de dados MySQL */
//define('DB_USER', 'db_promotora');
//define('DB_USER', 'gestor_evento');
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
//define('DB_PASSWORD', '');
define('DB_PASSWORD', 'Blaster631xd');
/** nome do host do MySQL */

//define('DB_HOST', 'db_promotora.mysql.dbaas.com.br');
//define('DB_HOST', 'gestor_evento.mysql.dbaas.com.br');
define('DB_HOST', 'localhost');
/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** caminho no server para o sistema **/
if ( !defined('RAIZURL') )
    define('RAIZURL', '/montadora/');

/** caminho do produto para o sistema **/
if ( !defined('BASEURL') )
    define('BASEURL', '/montadora/');	

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
    define('DBAPI', ABSPATH . 'inc/database.php');

/** caminhos dos templates de header e footer **/
define('MODULO_VENDAS', ABSPATH . 'inc/header_vendas.php');
define('MODULO_PROJETO', ABSPATH . 'inc/header_projeto.php');
define('MODULO_MARKETING', ABSPATH . 'inc/header_marketing.php');
define('MODULO_FINANCEIRO', ABSPATH . 'inc/header_financeiro.php');
define('MODULO_OPERACIONAL', ABSPATH . 'inc/header_operacional.php');
define('MODULO_CLIENTE', ABSPATH . 'inc/header_cliente.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');