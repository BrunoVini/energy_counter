var aparelhosJson = [];
var totalGastoAllDinheiro;
var totalGastoAllKWh;

const showTotal = function() {
  totalGastoAllDinheiro = 0;
  totalGastoAllKWh = 0;

  $("tr.total").remove();

  aparelhosJson.forEach((value, index) => {
    totalGastoAllKWh += parseFloat(value.WhMes);
    totalGastoAllDinheiro += parseFloat(value.totalGasto);
  })

  $(".table-header")[0].innerHTML += `
    <tr class="total"'>
      <td>&#160;</td>
      <td>&#160;</td>
      <td>&#160;</td>
      <td>${totalGastoAllKWh.toFixed(2)}KWh</td>
      <td>&#160;</td>
      <td>R$ ${totalGastoAllDinheiro.toFixed(2)}</td>
    </tr>
  `;

}

$("#add").click(() => {
  let aparelho = $("[name=aparelho]").val();
  let potencia = $("[name=potencia]").val();
  let horas = $("[name=horas]").val();
  let dias = $("[name=dias]").val();
  let tarifa = $("[name=tarifa]").val();
  let id = Math.floor(Math.random() * 999999999999);

  let horasPorMes = ((horas * 60) * dias) / 60;

  let WhMes = (potencia / 1000) * horasPorMes; 
  let totalGasto = WhMes * tarifa;

  aparelhosJson.push({
    id: id,
    aparelho: aparelho,
    potencia: potencia,
    horasPorMes: horasPorMes,
    WhMes: WhMes.toFixed(2),
    tarifa: tarifa,
    totalGasto: totalGasto.toFixed(2)
  });

  $("input").val(''); $("[name=tarifa]").val(tarifa);

  $(".table-header")[0].innerHTML += `
    <tr id="${id}" class="elements">
      <td>${aparelho}</td>
      <td>${potencia}W</td>
      <td>${horasPorMes}h</td>
      <td>${WhMes.toFixed(2)}KWh</td>
      <td>R$ ${tarifa}</td>
      <td>R$ ${totalGasto.toFixed(2)} 
        <button class="deleteLine" onclick="deleteLine(${id})">
          <i class="fas fa-trash-alt"></i>
        </button> 
      </td>
    </tr>
  `;
  
  showTotal();

})

$(".createPDF").click(async function() {
  $(this).attr('disabled', true);
  $(this).html("Carregando...");
  aparelhosJson.forEach(function(value, index) {
    aparelhosJson[index].id = index;
  })

  await aparelhosJson.push({
    id: aparelhosJson.length + 1,
    aparelho: "<strong>Total</strong>",
    potencia: "&#160",
    horasPorMes: "&#160",
    WhMes: totalGastoAllKWh.toFixed(2),
    tarifa: "&#160",
    totalGasto: totalGastoAllDinheiro.toFixed(2)
  });
  
  $.post('ajax/createPdf.php', {tableJson: JSON.stringify(aparelhosJson)}, function(data) {
   document.write(data);
  });
  setTimeout(function() {
      $(this).attr('disabled', false);
      $(this).html("Gerar documento PDF");
    }, 3000);
})


const deleteLine = (id) => {
  if(id != null) {
    $("#" + id).remove();
    const indice = aparelhosJson.findIndex(aparelho => aparelho.id === id);
    aparelhosJson.splice(indice, 1);
    showTotal();
  }
}