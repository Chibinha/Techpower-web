var precoArray = $('.preco');
var quantidadeArray = $('.quantidade');
var subtotal = $('.subtotal');
var totalArray = $('.total');

total();

for(pos = 0; pos < quantidadeArray.length; pos++) {
    quantidadeArray[pos].addEventListener("change", total);
}

function total() {
    var total = 0;
    for(i = 0; i < precoArray.length; i++) {
        subtotal[i].textContent = parseFloat(parseFloat(precoArray[i].textContent) * parseInt(quantidadeArray[i].value)) + '€';
        total += parseFloat(subtotal[i].textContent);
    }
    totalArray[0].textContent = total + '€';
    totalArray[1].textContent = total + '€';
}


//Previne que a quantidade de um item no carrinho fique a NULL
const numInputs = document.querySelectorAll('input[type=number]')

numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 1
      total();
    }
  })
})