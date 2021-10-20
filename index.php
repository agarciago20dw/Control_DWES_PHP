<html>
<head>

    <?php 
        /// AÑADE EL CODIGO NECESARIO PARA PODER ACCEDER AL CONTENIDO DEL FICHERO statistics.php
        require("statistics.php");
    ?>
    <title>PARTIDAS</title>

</head>


<body>


    <?php

        // // EJEMPLO:
        
        // $db = new DBManager();
        
        // $stat = new Statistics("LoL", "unai", "4", 56, true, date("Y-m-d", strtotime("2020-03-01")));
        // $db->insertStatistics($stat);

        // $statsArray = $db->getStatistics();

        // echo "<ul>";
        // foreach ($statsArray as $stats){
        //     echo "<li>$stats</li>";
        // }
        // echo "<ul>";



    ?>

    <center>
        <table style="text-align: center;">
            <tr>
                <td>
                    <h1>FORMULARIO PARTIDAS</h1>
                </td>
            </tr>
        </table>
    </center>



</body>

</html>