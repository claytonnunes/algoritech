<?php
require_once('functions.php');
//index();
mysqli_report(MYSQLI_REPORT_STRICT);
?>
<?php $db = open_database(); ?>

<?php include(HEADER_TEMPLATE);

?><head>
        <link rel="stylesheet" href="--><?php //echo BASEURL; ?><!--css/relatorio.css">
    </head>


        

    <table id="tabela_relatorio">
            <thead>
            <tr>
                <?php
                $database = open_database();
                ?>
            </tr>
            <tr>
                <?php
                $sql = "SELECT * FROM visitantes";
                $result = mysqli_query($db,$sql);
                //$total_visitantes = printf(" Temos ao total " . $result->num_rows ." Visitantes" );
                $total_visitantes = $result->num_rows;
                ?>
            </tr>
            <tr>
                <?php
                $sql = "SELECT * FROM empresas";
                $result2 = mysqli_query($db,$sql);
                //$total_expositores = printf(" Temos ao total " . $result2->num_rows ." expositores" );
                $total_empresas = $result2->num_rows;

                ?>
            </tr>
            <tr>
                <?php
                $sql = "SELECT * FROM checkins";
                $result3 = mysqli_query($db,$sql);
                //$total_checkins = printf(" Temos ao total " . $result3->num_rows ." expositores " );
                $total_checkins = $result3->num_rows;
                //echo $total_expositores;
                ?>
            </tr>
            </thead>
        </table>
    </div>


<style>
    @import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

    body {
        background-color: #ffffff;
        /*font-family: "Roboto", helvetica, arial, sans-serif;*/
        /*font-size: 16px;*/
        /*font-weight: 400;*/
        /*text-rendering: optimizeLegibility;*/
    }

    div.table-title {
        display: block;*/
    margin: auto;
        max-width: 600px;*/
    padding:102px;
        width: 100%;*/
    text-align: left;
    }

    .table-title h3 {
        color: #000000;
        font-size: 20px;
        font-weight: 400;
        font-style:normal;
        font-family: "Roboto", helvetica, arial, sans-serif;
        text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        text-transform:uppercase;
        margin-bottom: 40px;
    }


    /*** Table Styles **/

    .table-fill {
        background: white;
        border-radius:3px;
        border-collapse: collapse;
        height: 120px;
        margin: 0;
        max-width: 50%;
        padding: 5px;
        width: 100%;
        /*box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);*/
        animation: float 5s infinite;
    }

    th {
        color: white;
        background:#1b1e24;
        border-bottom:4px solid #0d0e0f;
        border-right: 1px solid #343a45;
        font-size:18px;
        font-weight: 100;
        padding:15px;
        text-align:left;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        vertical-align:middle;
    }

    th:first-child {
        border-top-left-radius:3px;
    }

    th:last-child {
        border-top-right-radius:3px;
        border-right:none;
    }

    tr {
        border-top: 1px solid #C1C3D1;
        border-bottom-: 1px solid #C1C3D1;
        color:#666B85;
        font-size:14px;
        font-weight:normal;
        text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
    }

    tr:hover td {*/
    background:#4E5066;*/
    color:#FFFFFF;*/
    border-top: 1px solid #22262e;*/
    border-bottom: 1px solid #22262e;*/
    }

    tr:first-child {
        border-top:none;
    }

    tr:last-child {
        border-bottom:none;
    }

    tr:nth-child(odd) td {
        background:#EBEBEB;
    }

    tr:nth-child(odd):hover td {
        background:#4E5066;
    }

    tr:last-child td:first-child {
        border-bottom-left-radius:3px;
    }

    tr:last-child td:last-child {
        border-bottom-right-radius:3px;
    }

    td {
        background:#FFFFFF;
        padding:20px;
        text-align:left;
        vertical-align:middle;
        font-weight:300;
        font-size:14px;
        text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #C1C3D1;
    }

    .row{
        margin-top: 10px;
        color: #0000CC;

    }
    td:last-child {
        border-right: 0px;
    }

    th.text-left {
        text-align: left;
    }

    th.text-center {
        text-align: center;
    }

    th.text-right {
        text-align: right;
    }

    td.text-left {
        text-align: left;
    }

    td.text-center {
        text-align: center;
    }

    td.text-right {
        text-align: right;
    }


</style>



    <div id="divConteudo">
        <div class="col-sm-6">


            <h2>Relatórios</h2>


            <div class="table-title">
                <h3>Clientes </h3>
            </div>

            <table class="table-fill">

                <tr>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Total</th>
                </tr>

                <tr>
                    <td class="text-center">Clientes Cadastrados Total</td>
                    <td class="text-center"><?php echo  $total_empresas ?> </td>

                </tr>

                <tr>
                    <td class="text-center">Clientes Cadastrados mês</td>
                    <td class="text-center"><?php echo  $total_empresas ?> </td>

            </table>
            <br/>
            <div class="table-title">
                <h3>Vendedores </h3>
            </div>

            <table class="table-fill">

                <tr>
<!--                    <th class="text-center">Data</th>-->
                    <th class="text-center">Total</th>
                </tr>

                <tr>
<!--                    <td>12/03</td>-->
                    <td class="text-center"><?php echo  $total_empresas; ?> </td>
                </tr>

            </table>
            <br/>
        </div>

<!--    <div id="actions" >-->
<!--        <div class="col-md-12">-->
<!--            <a class="btn btn-success" href="./geracaoRelatorioPDF.php"> Imprimir</a>-->
<!--            <a href="../index.php" class="btn btn-default">Voltar</a>-->
<!--        </div>-->
<!--    </div>-->


<?php include('modal.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>