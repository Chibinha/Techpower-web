let precoArray = Array.from( $('td[name ="preco"]'));
let quantidadeArray = Array.from( $('input[name ="quantidade"]'));
let subtotal = Array.from( $('td[name ="subtotal"]'));

$(":input").bind('keyup mouseup', function () {
             
});

let total = 0;
for(i = 0; i < precoArray.length; i++) {
    console.log(precoArray[i].innerHTML);
    console.log(quantidadeArray[i].value);
    $(":input").bind('keyup mouseup', function () {
        total += precoArray.innerHTML * subtotal.innerHTML;
    });
}


// console.log($('preco').text());
// console.log([0].innerHTML);
// console.log(td.innerHTML);
//var total = parseInt($('#preco').text()) * parseInt($('#quantidade').text());
