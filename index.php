<?php
  include('./config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contador de Energia</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
  
  <section>

    <h1 class="text-center">Contador de Energia</h1>

    <div id="form">

      <div class="name">
        <label for="aparelho">Nome do aparelho: </label>
        <input type="text" class="name" name="aparelho" placeholder="Ex: Tv">
      </div>

      <div class="potencia">
        <label for="potencia">Potêcia (Watt): </label>
        <input type="number" class="potencia" name="potencia" placeholder="Ex: 40 (Não precisa colocar o 'W')">
      </div>

      <div class="horas">
        <label for="horas">Horas por dia: </label>
        <input type="number" class="horas" name="horas" min="0" max="24" placeholder="Ex: 3">
      </div>

      <div class="dias">
        <label for="dias">Dias por mês: </label>
        <input type="number" class="dias" min="0" max="30" name="dias" placeholder="Ex: 10">
      </div>

      <div class="tarifa">
        <label for="tarifa">Valor em Real por KW/h: </label>
        <input type="number" class="tarifa" name="tarifa">
      </div>

      <button id="add" class="btn btn-primary w-100 mt-2">Adicionar</button>

    </div>

    <h2 class="text-center mt-3">Tabela</h2>

    <div class="tabela mt-2">
      
      <table class="table-header">

        <tr>
          <th>Aparelho</th>
          <th>Potência</th>
          <th>Horas/mês</th>
          <th>Gasto KWh no mês</th>
          <th>Tarifa por KW/h</th>
          <th>Total gasto</th>
        </tr>

      </table>

    </div>

    <div class="button">
      <button class="createPDF">Gerar documento PDF</button>
    </div>
    
    <div class="ajax text-center text-white bg-dark"></div>
  </section>



  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="js/index.js"></script>

</body>
</html>