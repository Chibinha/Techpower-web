var precoArray = $('.preco');
var quantidadeArray = $('.quantidade');
var subtotal = $('.subtotal');
var totalArray = $('.total');

fillTotal();

for(pos = 0; pos < quantidadeArray.length; pos++) {
    quantidadeArray[pos].addEventListener("change", fillTotal());
}

function fillTotal() {
    for(i = 0; i < precoArray.length; i++) {
        subtotal[i].textContent = parseFloat(parseFloat(precoArray[i].textContent) * parseInt(quantidadeArray[i].value)) + '€';
    }
    let total = getTotal();
    totalArray[0].textContent = total + '€';
    totalArray[1].textContent = total + '€';
}

function getTotal() {
    var total = 0;
    for(i = 0; i < precoArray.length; i++) {
        total += parseFloat(precoArray[i].textContent) * parseInt(quantidadeArray[i].value);
    }
    return total;
}

// Open pay window for Paypal
paypal.Buttons({
    createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: getTotal()
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);

            window.location.href = '/sale/create';

            // Call your server to save the transaction
            // return fetch('/sale/getorder', {
            //     method: 'post',
            //     headers: {
            //         'content-type': 'application/json'
            //     },
            //     body: JSON.stringify({
            //         orderID: data.orderID
            //     }),
                
            // });
        });
    }
}).render('#paypal-button-container');