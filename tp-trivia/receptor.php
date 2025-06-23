<?php
include 'respuestas.php';

$puntaje = 0;
$res_usu = [];
$correctas = 0;
$incorrectas = 0;

foreach ($_GET as $pregunta => $respuesta_usuario) {
   
    if ($pregunta == 'pregunta11') {
        $respuestas_correctas_preg11 = $respuestas_correctas['pregunta11'];
        $respuesta_usuario = $_GET['pregunta11']; 

        $respuestas_correctas_usuario = 0;
        $respuestas_incorrectas_usuario = 0;

       
        foreach ($respuesta_usuario as $respuesta) {
          
            if (in_array($respuesta, $respuestas_correctas_preg11)) {
                $respuestas_correctas_usuario++;
            } else {
                
                $respuestas_incorrectas_usuario++;
            }
        }

      
        $puntaje_preg11 = $respuestas_correctas_usuario * 10; 
        $puntaje += $puntaje_preg11;

       
        $correctas += $respuestas_correctas_usuario;
        $incorrectas += $respuestas_incorrectas_usuario;
    } else {
       
        if ($respuesta_usuario == $respuestas_correctas[$pregunta]) {
            $puntaje += 10;
            $correctas++;
        } else {
            $incorrectas++;
        }
    }
    $res_usu[$pregunta] = $respuesta_usuario;
}

$total_res = 10; // Si tienes 10 preguntas en total
$porcentaje_correctas = ($correctas / $total_res) * 100;
$porcentaje_incorrectas = ($incorrectas / $total_res) * 100;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Trivia Stranger Things</title>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Resultados</h1>
    <p>Tu puntaje es: <?php echo $puntaje; ?> </p>
    <?php 
        if ($porcentaje_correctas < 50) {
            echo '<img src="./img/Seguiparticipando" style="max-width: 150px; margin-top: 20px;">';
            echo '<br>';
            echo "Seguí participando";
        } elseif ($porcentaje_correctas >= 50 && $porcentaje_correctas < 75) {
            echo '<img src="./img/Bien" style="max-width: 150px; margin-top: 20px;">';
            echo '<br>';
            echo "Bien";
        } elseif ($porcentaje_correctas >= 75 && $porcentaje_correctas < 100) {
            echo '<img src="./img/Muybien" style="max-width: 150px; margin-top: 20px;">';
            echo '<br>';
            echo "Muy bien";
        } else {
            echo '<img src="./img/Excelente" style="max-width: 150px; margin-top: 20px;">';
            echo '<br>';
            echo "Excelente";

           
        }
    ?>
    

    <h2>Detalles de las respuestas</h2>
    <?php 
    if (isset($res_usu['pregunta11'])) {
    $respuestas_usuario = $res_usu['pregunta11'];
    $respuestas_correctas_preg11 = $respuestas_correctas['pregunta11'];
      
    foreach ($respuestas_usuario as $respuesta) {
        if (in_array($respuesta, $respuestas_correctas_preg11)) {
            echo '<div class="alert alert-success" role="alert">';
            echo "Correcta: $respuesta";
            echo "</div>";
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo "Incorrecta: $respuesta. Las respuestas correctas eran: ";
            foreach ($respuestas_correctas_preg11 as $respuesta_correcta) {
                echo $respuesta_correcta . " ";
            }
            echo "</div>";
        }
    }
    unset ($_GET['pregunta11']);
} 
    
    foreach ($_GET as $pregunta => $respuesta_usuario) {
        if ($respuesta_usuario == $respuestas_correctas[$pregunta]) {
            echo '<div class="alert alert-success" role="alert">'; 
            echo "Correcta: $respuesta_usuario";
            echo "</div>";
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo "Incorrecta: $respuesta_usuario. La respuesta correcta era: " . $respuestas_correctas[$pregunta];
            echo "</div>";   
        }
    }


?>

    <h2>Estadísticas</h2>
    <p>Respuestas correctas: <?php echo $correctas; ?> (<?php echo $porcentaje_correctas; ?>%)</p>
    <p>Respuestas incorrectas: <?php echo $incorrectas; ?> (<?php echo $porcentaje_incorrectas; ?>%)</p>
    <form action="index.html">
        <input type="submit" value="Volver a intentarlo">
    </form>
 </html>
