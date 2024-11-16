
function fetchInventories(page = 1) {
    const limit = 10;
    const endpoint = `${BASEPATH}/inventory/fetch-inventories?page=${page}&limit=${limit}`;
    const request = new XMLHttpRequest();

    request.open("GET", endpoint, true);
    request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                const response = JSON.parse(request.responseText);
                console.log(response)
                renderInventories(response.data,limit,page);
                renderPagination(response.pagination);
            } else {
                console.error("Failed to fetch categories");
            }
        }
    };
    request.send();
}

fetchInventories();
function renderInventories(inventories,limit,current_page) {
    const tableBody = document.querySelector("tbody");
    var currentRowNumber = (limit * (current_page -1 )) + 1
    tableBody.innerHTML = ""; // Clear existing data
    inventories.forEach((inventory, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${currentRowNumber}</td>
            <td>${inventory.stock_input_date}</td>
            <td>${inventory.product_name}</td>
            <td> 
                ${inventory.quantity}
            </td>
            <td>$${inventory.price}</td>
            <td>${inventory.total}</td>
            <td>${inventory.note ?? "N/A"}</td>
        `;
        tableBody.appendChild(row);
        currentRowNumber++;
    });

    addDeleteEventListeners();
}

function renderPagination(pagination,targetElement = document.querySelector("#pagination")) {
    const paginationContainer = targetElement;
    paginationContainer.innerHTML = ""; // Clear existing pagination

    for (let i = 1; i <= pagination.total_pages; i++) {
        const pageButton = document.createElement("button");
        pageButton.className = "btn btn-primary";
        pageButton.style.margin = "0px 5px 0px 0px"
        pageButton.textContent = i;
        pageButton.onclick = () => fetchInventories(i);
        paginationContainer.appendChild(pageButton);
    }
}