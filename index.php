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
                <td colspan="2">
                    <h1>FORMULARIO PARTIDAS</h1>
                </td>
            </tr>
            <form action="" method="post">
                <tr>
                    <td>
                        <label>Introduce el nombre del juego:</label>
                    </td>
                    <td>
                        <input type="text" name="nombre" id="nombre">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Introduce el nº de jugadores:</label>
                    </td>
                    <td>
                        <input type="text" name="num_jugadores" id="num_jugadores">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Introduce la puntuación:</label>
                    </td>
                    <td>
                        <input type="text" name="puntuacion" id="puntuacion">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Introduce la fecha:</label>
                    </td>
                    <td>
                        <input type="date" name="fecha" id="fecha">
                    </td>
                </tr>
            </form>
        </table>
    </center>



</body>

</html>