function addDeleteEventListeners() {
    const productDeleteButtons = document.querySelectorAll(".product_delete");
    productDeleteButtons.forEach((button) => {
        button.addEventListener("click", function (el) {
            const isConfirm = confirm("Are you sure?");
            if (isConfirm) {
                const id = el.target.getAttribute("data-id");
                const endpoint = `${BASEPATH}/product/delete/${id}`;
                const request = new XMLHttpRequest();

                const row = el.target.closest("tr");

                request.open("GET", endpoint);
                request.onreadystatechange = function () {
                    if (request.readyState == XMLHttpRequest.DONE) {
                        if (request.status == 200) {
                            const data = JSON.parse(request.responseText);
                            if (data.status === "success") {
                                row.remove();
                                alert(data.message);
                            }
                        } else {
                            const data = JSON.parse(request.responseText);
                            alert("Error: " + data.message);
                        }
                    }
                };
                request.send();
            }
        });
    });
}



function fetchProducts(page = 1) {
    const limit = 10;
    const endpoint = `${BASEPATH}/product/fetch-products?page=${page}&limit=${limit}`;
    const request = new XMLHttpRequest();

    request.open("GET", endpoint, true);
    request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                const response = JSON.parse(request.responseText);
                console.log(response)
                renderProducts(response.data,limit,page);
                renderPagination(response.pagination);
            } else {
                console.error("Failed to fetch categories");
            }
        }
    };
    request.send();
}

fetchProducts();
function renderProducts(products,limit,current_page) {
    const tableBody = document.querySelector("tbody");
    var currentRowNumber = (limit * (current_page -1 )) + 1
    tableBody.innerHTML = ""; // Clear existing data
    products.forEach((product, index) => {
        const row = document.createElement("tr");
        var image = product.image;
        if(!image.startsWith("http")){
            image = `${BASEPATH}/${image}`
        }
        row.innerHTML = `
            <td>${currentRowNumber}</td>
            <td><img src="${image}" style="height:100px;width:100px;" alt=""></td>
            <td>
                <p>${product.category_name} 
                </p>
            </td>
            <td>
                <p>${product.product_name} 
                    ${product.is_featured ? '<span class="badge text-bg-success">Featured</span>' : ""}
                </p>
            </td>
            
            <td>
                <p>${BASECURRENCY}${product.price} 
                </p>
            </td>
            <td>${product.status}</td>
            <td>
                <a href="${BASEPATH}/product/view/${product.id}" class="btn btn-info btn-sm">View</a>
                <a href="${BASEPATH}/product/edit/${product.id}" class="btn btn-success btn-sm">Edit</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm product_delete" data-id="${product.id}">Delete</a>
            </td>
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
        pageButton.onclick = () => fetchProducts(i);
        paginationContainer.appendChild(pageButton);
    }
}