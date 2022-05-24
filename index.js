

function getProductsByPrice(){

    let from = parseInt(document.getElementById("from").value);
    let to = parseInt(document.getElementById("to").value);

    if(isNaN(from) || isNaN(to)){
        return
    }

    let xhr = new XMLHttpRequest();
    xhr.open('GET', `request-handlers/get-by-price.php?from=${from}&to=${to}`, true);
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === xhr.DONE) {
            document.getElementById("content").innerHTML = xhr.responseText
        }
    }
}


function getProductsByVendor(){

    let select = document.getElementById("vendor-select");
    let vendor = select.options[select.selectedIndex].value;

    let xhr = new XMLHttpRequest();
    xhr.open('GET', `request-handlers/get-by-vendor.php?vendor=${vendor}`, true);
    xhr.responseType = "document";
    xhr.send();

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE) {
            printXMLProducts(xhr.responseXML.getElementsByTagName("product"))
        }
    };
}

async function getProductsByType(){
    let select = document.getElementById("type-select");
    let type = select.options[select.selectedIndex].value;
    fetch(`request-handlers/get-by-type.php?type=${type}`,{method: 'GET'})
        .then(function(response) { return response.json() })
        .then(function(json) { printJSONProducts(json) });
}


function printJSONProducts(products){

    let items = "<div class=\"list-group\">";
    products.forEach(function(item) {
        let style = "list-group-item ";
        style = item['quantity'] === 0 ? style + "list-group-item-danger" : style+"list-group-item-primary ";
        items +=
            `
            <div class="${style} pt-1 m-1">
                <h6>${item['name']}</h6>
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr><th scope="col">#</th><th scope="col"> Info </th></tr>
                    </thead>
                    <tbody>
                        <tr><th scope="row"> Category   </th><td>${item['category']} </td></tr>
                        <tr><th scope="row"> Vendor     </th><td>${item['vendor']}   </td></tr>
                        <tr><th scope="row"> Price      </th><td>${item['name']}     </td></tr></tr>
                        <tr><th scope="row"> Quantity   </th><td>${item['price']}    </td></tr>
                        <tr><th scope="row"> Quality    </th><td>${item['quality']}  </td></tr>
                    </tbody>
                </table>
            </div>
            `
    })
    items += "</div>";
    document.getElementById("content").innerHTML = items;
}

function printXMLProducts(products){

    let items = "<div class=\"list-group\">";
    for (let i = 0; i < products.length; i++) {
        let style = "list-group-item ";
        style = products[i].getElementsByTagName('quantity')[0].firstChild.nodeValue === "0" ?
            style + "list-group-item-danger" : style + "list-group-item-primary ";
        items +=
            `
            <div class="${style} pt-1 m-1">
                <h6>${products[i].getElementsByTagName('name')[0].firstChild.nodeValue}</h6>
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr><th scope="col">#</th><th scope="col"> Info </th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"> Category   </th>
                            <td>${products[i].getElementsByTagName('category')[0].firstChild.nodeValue}</td>
                        </tr>
                        <tr>
                            <th scope="row"> Vendor </th>
                            <td>${products[i].getElementsByTagName('vendor')[0].firstChild.nodeValue} </td>
                        </tr>
                        <tr>
                            <th scope="row"> Price  </th>
                            <td>${products[i].getElementsByTagName('price')[0].firstChild.nodeValue} </td>
                        </tr>
                        <tr>
                            <th scope="row"> Quantity   </th>
                            <td>${products[i].getElementsByTagName('quantity')[0].firstChild.nodeValue} </td>
                        </tr>
                        <tr>
                            <th scope="row"> Quality    </th>
                            <td>${products[i].getElementsByTagName('quality')[0].firstChild.nodeValue} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            `
    }

    items += "</div>";
    document.getElementById("content").innerHTML = items;
}