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

        // CLASE PARA GESTIONAR LOS DATOS DE LAS PARTIDAS
        class GestionPartida {
            private $partidas;

            public function __construct($partidas) {
               $this->partidas =  $partidas;
            }

            public function mostrarPorcentajeVictoriasTodosVideojuego() {
                for ($i = 0; $i < count($this->partidas); $i++) {
                    $nombre_equipo = $this->partidas[$i]->getTeamName();
                    $suma_putuacion = 0;
                    $videojuegos = [];
                    for ($j = 0; $j < count($this->partidas); $j++) {
                        if ($this->partidas[$j]->getTeamName() == $nombre_equipo) {
                            $partida = $this->partidas[$j];
                            $suma_putuacion += $partida->getScore();

                            if (array_search($partida->getGame(), $videojuegos) != $partida->getGame()) {
                                array_push($videojuegos, $partida->getGame());
                            }
                        }
                    }
                    $porcentaje = ($suma_putuacion / count($videojuegos));
                    $tabla = "<table border='1' style='text-align: center;'><tr><td>EQUIPO</td><td>PORCENTAJE DE VICTORIAS</td><tr><tr><td>" . $nombre_equipo . "</td><td>" . $porcentaje . "%" . "</td></tr></table>";
                    echo $tabla;
                }
            }

            public function mostrarPuntuacionGeneralCadaVideojuego() {
                $videojuegos = ["LoL" => 0, "WoW" => 0, "Valorant" => 0, "Fortnite" => 0, "Minecraft" => 0];
                for ($i = 0; $i < count($this->partidas); $i++) {
                    $partida = $this->partidas[$i];
                    $videojuegos[$partida->getGame()] == $videojuegos[$partida->getGame()] + $partida->getScore();
                }
                    

                $tabla = "<br><table border='1' style='text-align: center;'><tr><td>JUEGO</td><td>PUNTUACIÓN GENERAL</td><tr>";
                foreach ($videojuegos as $nombre => $puntuacion) {
                    $tabla .= "<tr><td>" . $nombre . "</td><td>" . $puntuacion . "</td></tr>"; 
                }
                $tabla .= "</table>";
                echo $tabla;
            }
        }

        $error = 0;

        if (isset($_POST['error'])) {
            $error = $_POST['error'];

            if ($error >= 3) {
                echo "¿QUÉ ESTÁS HACIENDO?";
            }
        }

        if ((isset($_POST['juego'])) && (isset($_POST['nombre_equipo'])) && (isset($_POST['num_jugadores'])) && (isset($_POST['puntuacion'])) && (isset($_POST['fecha'])) && (isset($_POST['ganada']))) {
            // RECOGEMOS DATOS DEL POST

            $correctos = true;
            $juego = $_POST['juego'];
            $nombre_equipo = $_POST['nombre_equipo'];
            $num_jugadores = $_POST['num_jugadores'];
            if ($num_jugadores < 3 || $num_jugadores > 5) {
                $num_jugadores = 3; // VALOR POR DEFECTO
                $correctos = false;
            }
            $puntuacion = $_POST['puntuacion'];
            if ($puntuacion < 0) {
                $puntuacion = 0; // VALOR POR DEFECTO
                $correctos = false;
            }

            $fecha = $_POST['fecha'];
            $ganada;
            if (strtoupper($_POST['ganada']) == "S") {
                $ganada = true;
            }
            else {
                $ganada = false;
            }

            // MIRAMOS SI LOS DATOS INTRODUCIDOS SON CORRECTOS, SI NO LO SON AUMENTAMOS LOS ERRORES
            if (!$correctos) {
                $error++;
            }

            // CREAMOS UNA CONEXIÓN Y UNA NUEVA ESTADÍSTICA LA CUAL INSERTAMOS EN LA BD
            $db = new DBManager();
            $stat = new Statistics($juego, $nombre_equipo, $num_jugadores, $puntuacion, $ganada, $fecha);
            $db->insertStatistics($stat);

            // COGEMOS TODAS LAS ESTADÍSTICAS DE LA BASE DE DATOS
            $stats = $db->getStatistics();
            $gestion = new GestionPartida($stats);
        }

    ?>

    <!-- FORMULARIO DE INSERCIÓN DE DATOS PARA LA PARTIDA -->
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
                        <input type="text" name="juego" id="juego">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Introduce el nombre del equipo:</label>
                    </td>
                    <td>
                        <input type="text" name="nombre_equipo" id="nombre_equipo">
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
                <tr>
                    <td>
                        <label>Introduce si se ha ganado la partida [S/N]:</label>
                    </td>
                    <td>
                        <input type="text" name="ganada" id="ganada">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="enviar" id="enciar" value="ENVIAR">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>PORCENTAJE VICTORIAS TODOS LOS JUEGOS</h2>
                        <?php
                            if ((isset($_POST['juego'])) && (isset($_POST['nombre_equipo'])) && (isset($_POST['num_jugadores'])) && (isset($_POST['puntuacion'])) && (isset($_POST['fecha'])) && (isset($_POST['ganada']))) {
                                $gestion->mostrarPorcentajeVictoriasTodosVideojuego();
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>MEDIA PUNTUACIÓN GENERAL EN CADA UNO DE LOS VIDEOJUEGOS</h2>
                        <?php
                            if ((isset($_POST['juego'])) && (isset($_POST['nombre_equipo'])) && (isset($_POST['num_jugadores'])) && (isset($_POST['puntuacion'])) && (isset($_POST['fecha'])) && (isset($_POST['ganada']))) {
                                $gestion->mostrarPuntuacionGeneralCadaVideojuego();
                            }
                        ?>
                    </td>
                </tr>
                <input type="hidden" name="errores" value="<?php $error ?>">
            </form>
        </table>
    </center>



</body>

</html>