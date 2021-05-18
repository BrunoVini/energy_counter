<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pdf</title>
</head>
<body>

<?php

    try {
        include('../config.php');

        $dataJson = isset($_POST['tableJson']) ? $_POST['tableJson'] : '';
        $dataArray = json_decode($dataJson, true);
        $arrayLength = count($dataArray);
        $dataHTML = "
            <table>
            <tr class='table-header'>
                <th>Aparelho</th>
                    <th>Potência</th>
                    <th>Horas/mês</th>
                    <th>Gasto KWh no mês</th>
                    <th>Tarifa por KW/h</th>
                    <th>Total gasto</th>
                </tr>
            ";

        foreach ($dataArray as $key => $value) {
            if($value['id'] == $arrayLength) {
                $dataHTML .= "
                <tr class='place'>
                    <td>${value['aparelho']}</td>
                    <td>${value['potencia']}</td>
                    <td>${value['horasPorMes']}</td>
                    <td>${value['WhMes']}KWh</td>
                    <td>${value['tarifa']}</td>
                    <td>R$ ${value['totalGasto']}</td>
                </tr>
                </table>
                <link type='text/css' rel='stylesheet' href=''../style/model.css'>
                ";
                break;
            }

            $dataHTML .= "
            <tr class='place'>
                <td>${value['aparelho']}</td>
                <td>${value['potencia']}W</td>
                <td>${value['horasPorMes']}h</td>
                <td>${value['WhMes']}KWh</td>
                <td>R$ ${value['tarifa']}</td>
                <td>R$ ${value['totalGasto']}</td>
            </tr>
            ";
        }
        $idPDF = uniqid( time ());

        $css = file_get_contents(BASE_URL.'style/model.css');

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($dataHTML);
        $mpdf->Output("contador_de_energia_$idPDF.pdf", \Mpdf\Output\Destination::FILE);
        
        sleep(2);
        echo  "<script>location.href='".BASE_URL."ajax/contador_de_energia_$idPDF.pdf';</script>";
        die();

    } catch (Exception $e) {
        echo $e->getMessage();
        echo "Error";
    }

?>
    
</body>
</html>