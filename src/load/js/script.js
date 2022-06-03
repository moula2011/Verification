fetch('../../../data/tr.json')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        localStorage.setItem("tr", JSON.stringify(data));
        if (!localStorage.getItem("cart")) {
            localStorage.setItem("cart", "[]");
        }
    });

let tr = JSON.parse(localStorage.getItem("tr"));

let cart = JSON.parse(localStorage.getItem("cart"));

function addItemToCart(id) {
    let tr = tr.find(function (tr) {
        return tr.id == id;
    });

    if (cart.length == 0) {
        cart.push(tr);
    } else {
        let response = cart.find(element => element.id == id);
        if (response == undefined) {
            cart.push(tr);
        }
    }

    localStorage.setItem("cart", JSON.stringify(cart));

}
