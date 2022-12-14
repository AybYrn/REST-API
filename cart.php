
<script>
    $(window).on("load", function () {
        function updateItemCount() {
            var cnt = 0;
            items.forEach(p => {
                cnt += parseInt(p.amount);
            });
            $(".numOfItems").html("").append(cnt);
        }

        function updatePrice() {
            var totalPrice = 0;
            items.forEach(p => {
                var price = p.disc_price === null ? p.normal_price : p.disc_price;
                totalPrice += parseFloat(price) * parseInt(p.amount);
            });
            totalPrice = totalPrice.toFixed(2);
            $(".totalPrice").html("").append("€ " + totalPrice);
        }

        function updateProductPrice() {
            var totalPrice = 0;
            items.forEach(p => {
                var price = p.disc_price === null ? p.normal_price : p.disc_price;
                totalPrice = parseFloat(price) * parseInt(p.amount);
                totalPrice = totalPrice.toFixed(2);
                $(".totalProductPrice").children("#" + p.product_id).html("").append("€ " + totalPrice);
            });
        }

        function deleteProduct(id) {
            $.ajax({
                type: "DELETE",
                url: "http://localhost/WD_Assesment_1/api/cart/<?= $userId ?>/" + id,
                success: function (data) {
                    items = items.filter(i => {
                        return parseInt(i.product_id) !== id;
                    });
                    updateItemCount();
                    updatePrice();
                    updateProductPrice();
                }
            });
        }

        var items;
        $.ajax({
            type: "GET",
            url: "http://localhost/WD_Assesment_1/api/cart/<?= $userId ?>",
            success: function (data) {
                data = JSON.parse(data);
                items = data;
                $(".cart").empty();
                data.forEach(p => {
                    var pic = {location: "default.png"};
                    $.ajax({
                        type: "GET",
                        url: "http://localhost/WD_Assesment_1/api/products/pic/" + p.product_id,
                        success: function (data) {
                            var pics = JSON.parse(data);
                            if (pics.length !== 0) {
                                pic = pics[0];
                            }
                        },
                        async: false
                    });
                    $(".cart").append(`               
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                    <img src="./images/products/` + pic.location + `"
                                         class="w-100" alt="Blue Jeans Jacket" />
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <p><strong>` + p.name + `</strong></p>
                                <button type="button" class="btn btn-light btn-outline-danger btn-sm me-1 mb-2 delete" data-mdb-toggle="tooltip"
                                        title="Remove item" id="` + p.product_id + `">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 15L10 12" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M14 15L14 12" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M3 7H21V7C20.0681 7 19.6022 7 19.2346 7.15224C18.7446 7.35523 18.3552 7.74458 18.1522 8.23463C18 8.60218 18 9.06812 18 10V16C18 17.8856 18 18.8284 17.4142 19.4142C16.8284 20 15.8856 20 14 20H10C8.11438 20 7.17157 20 6.58579 19.4142C6 18.8284 6 17.8856 6 16V10C6 9.06812 6 8.60218 5.84776 8.23463C5.64477 7.74458 5.25542 7.35523 4.76537 7.15224C4.39782 7 3.93188 7 3 7V7Z" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M10.0681 3.37059C10.1821 3.26427 10.4332 3.17033 10.7825 3.10332C11.1318 3.03632 11.5597 3 12 3C12.4403 3 12.8682 3.03632 13.2175 3.10332C13.5668 3.17033 13.8179 3.26427 13.9319 3.37059" stroke="#33363F" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-light btn-outline-warning btn-sm mb-2" data-mdb-toggle="tooltip"
                                        title="Move to the wish list">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke="#33363F" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4 my-auto">

                                <div class="d-flex h-25" style="max-width: 300px">
                                    <button class="me-2 quantity"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); $(this).parent().children('div').children('input').trigger('change')">
                                        <svg class=" mb-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 1H2C1.44772 1 1 1.44772 1 2V14C1 14.5523 1.44772 15 2 15H14C14.5523 15 15 14.5523 15 14V2C15 1.44772 14.5523 1 14 1ZM2 0C0.895431 0 0 0.895431 0 2V14C0 15.1046 0.895431 16 2 16H14C15.1046 16 16 15.1046 16 14V2C16 0.895431 15.1046 0 14 0H2Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 8C3.5 7.72386 3.72386 7.5 4 7.5H12C12.2761 7.5 12.5 7.72386 12.5 8C12.5 8.27614 12.2761 8.5 12 8.5H4C3.72386 8.5 3.5 8.27614 3.5 8Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <div class="form-outline" id="` + p.product_id + `">
                                        <input id="form1" min="0" name="quantity" value="` + p.amount + `" type="number" class="quantityInput form-control" />
                                        <label class="form-label mt-1" for="form1">Quantity</label>
                                    </div>

                                    <button class=" ms-2 quantity"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); $(this).parent().children('div').children('input').trigger('change')">
                                        <svg class=" mb-1" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 3.5C8.27614 3.5 8.5 3.72386 8.5 4V8C8.5 8.27614 8.27614 8.5 8 8.5H4C3.72386 8.5 3.5 8.27614 3.5 8C3.5 7.72386 3.72386 7.5 4 7.5H7.5V4C7.5 3.72386 7.72386 3.5 8 3.5Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 8C7.5 7.72386 7.72386 7.5 8 7.5H12C12.2761 7.5 12.5 7.72386 12.5 8C12.5 8.27614 12.2761 8.5 12 8.5H8.5V12C8.5 12.2761 8.27614 12.5 8 12.5C7.72386 12.5 7.5 12.2761 7.5 12V8Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14 1H2C1.44772 1 1 1.44772 1 2V14C1 14.5523 1.44772 15 2 15H14C14.5523 15 15 14.5523 15 14V2C15 1.44772 14.5523 1 14 1ZM2 0C0.895431 0 0 0.895431 0 2V14C0 15.1046 0.895431 16 2 16H14C15.1046 16 16 15.1046 16 14V2C16 0.895431 15.1046 0 14 0H2Z" fill="black"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-start text-md-center mt-4 totalProductPrice">
                                    <strong id="` + p.product_id + `"></strong>
                                </p>
                            </div>
                        </div>
                    `);
                });
                $("input.quantityInput").change(
                        function () {
                            var amountUpdate = parseInt($(this).val());
                            var pId = $(this).parent().attr('id');

                            if (amountUpdate === 0) {
                                $(this).parent().parent().parent().prev().children("button.delete").trigger("click");
                            } else
                            {
                                $.ajax({
                                    type: "PUT",
                                    url: "http://localhost/WD_Assesment_1/api/cart/" + <?= $userId ?> + "/" + pId,
                                    data: JSON.stringify({amount: amountUpdate}),
                                    success: function (data) {
                                        items.find(i => {
                                            return pId === i.product_id;
                                        }).amount = amountUpdate;

                                        updateItemCount();
                                        updatePrice();
                                        updateProductPrice();
                                    },
                                    error: function (data) {
                                        console.log(data);
                                    }
                                });
                            }
                        });
                $(".delete").click(function () {
                    deleteProduct(parseInt($(this).attr("id")));
                    $(this).parent().parent().remove();
                });
                updateItemCount();
                updatePrice();
                updateProductPrice();
            }
        });
    });
</script>
<div id="userId" style="display: none;"></div>

<div class="container">

    <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Cart - <span class="numOfItems"></span> items</h5>
                </div>
                <div class="card-body cart">

                </div>
            </div>

            <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                    <p><strong>We accept</strong></p>
                    <svg width="55" height="35" viewBox="0 0 193 133" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.72966" y="1.72966" width="189.541" height="129.541" rx="2.27034" fill="white" stroke="#F3F3F3" stroke-width="3.45932"/>
                        <path d="M114.17 96.347H79.726V34.9532H114.17V96.347Z" fill="#FF5F00"/>
                        <path d="M81.9326 65.645C81.9326 53.191 87.812 42.0974 96.9676 34.9482C90.2723 29.7203 81.8225 26.6 72.6392 26.6C50.8988 26.6 33.2758 44.0808 33.2758 65.645C33.2758 87.2093 50.8988 104.69 72.6392 104.69C81.8225 104.69 90.2723 101.57 96.9676 96.3419C87.812 89.1927 81.9326 78.099 81.9326 65.645Z" fill="#EB001B"/>
                        <path d="M160.625 65.645C160.625 87.2093 143.002 104.69 121.261 104.69C112.078 104.69 103.628 101.57 96.9304 96.3419C106.089 89.1927 111.968 78.099 111.968 65.645C111.968 53.191 106.089 42.0974 96.9304 34.9482C103.628 29.7203 112.078 26.6 121.261 26.6C143.002 26.6 160.625 44.0808 160.625 65.645Z" fill="#F79E1B"/>
                    </svg>

                    <svg width="55" height="35" viewBox="0 0 193 133" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.72966" y="1.72966" width="189.541" height="129.541" rx="2.27034" fill="white" stroke="#F3F3F3" stroke-width="3.45932"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M58.4892 49.6307C57.0854 51.309 54.8393 52.6327 52.5932 52.4436C52.3124 50.1744 53.4121 47.7634 54.6989 46.2742C56.1027 44.5487 58.5594 43.3195 60.5482 43.225C60.7821 45.5887 59.8697 47.9052 58.4892 49.6307ZM60.525 52.8926C58.5462 52.7776 56.7407 53.4939 55.2823 54.0724C54.3438 54.4447 53.549 54.76 52.9444 54.76C52.2658 54.76 51.4383 54.4279 50.5091 54.0549L50.5091 54.0549C49.2916 53.5663 47.8997 53.0077 46.44 53.0345C43.0942 53.0817 39.9824 54.9964 38.2744 58.0456C34.7648 64.1441 37.3619 73.1736 40.7545 78.1374C42.4157 80.5957 44.4044 83.2904 47.0249 83.1958C48.1778 83.1519 49.007 82.7964 49.8653 82.4285C50.8534 82.0049 51.8798 81.5648 53.4825 81.5648C55.0296 81.5648 56.0112 81.9934 56.9534 82.4048C57.8493 82.796 58.7097 83.1716 59.9869 83.1486C62.701 83.1013 64.4089 80.6903 66.0701 78.232C67.8628 75.5936 68.6506 73.0186 68.7702 72.6278L68.7781 72.602L68.7842 72.5826C68.7813 72.5797 68.7592 72.5695 68.7201 72.5514C68.1208 72.2743 63.5404 70.1558 63.4965 64.475C63.4524 59.7068 67.1296 57.2909 67.7084 56.9106C67.7436 56.8875 67.7674 56.8719 67.7781 56.8637C65.4384 53.3654 61.7885 52.9872 60.525 52.8926ZM79.3127 82.8885V46.0378H93C100.066 46.0378 105.003 50.9543 105.003 58.1401C105.003 65.3259 99.9723 70.2898 92.8128 70.2898H84.9748V82.8885H79.3127ZM84.9751 50.8598H91.5029C96.4162 50.8598 99.2239 53.5072 99.2239 58.1638C99.2239 62.8204 96.4162 65.4914 91.4795 65.4914H84.9751V50.8598ZM123.697 78.4685C122.2 81.3522 118.901 83.1723 115.344 83.1723C110.08 83.1723 106.407 80.0049 106.407 75.2301C106.407 70.5026 109.963 67.7843 116.538 67.3825L123.604 66.957V64.9242C123.604 61.9222 121.662 60.2913 118.199 60.2913C115.344 60.2913 113.262 61.7804 112.841 64.0496H107.74C107.904 59.2749 112.35 55.8001 118.363 55.8001C124.844 55.8001 129.055 59.2276 129.055 64.546V82.8887H123.814V78.4685H123.697ZM116.865 78.7994C113.847 78.7994 111.928 77.3339 111.928 75.0883C111.928 72.7718 113.777 71.4245 117.31 71.2118L123.604 70.8099V72.89C123.604 76.3411 120.702 78.7994 116.865 78.7994ZM146.439 84.3306C144.17 90.7836 141.573 92.911 136.051 92.911C135.63 92.911 134.226 92.8637 133.898 92.7691V88.3489C134.249 88.3962 135.115 88.4435 135.559 88.4435C138.063 88.4435 139.467 87.3798 140.332 84.6142L140.847 82.9832L131.254 56.1548H137.174L143.842 77.9248H143.959L150.627 56.1548H156.383L146.439 84.3306Z" fill="black"/>
                    </svg>

                    <svg width="55" height="35" viewBox="0 0 193 133" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.72966" y="1.72966" width="189.541" height="129.541" rx="2.27034" fill="white" stroke="#F3F3F3" stroke-width="3.45932"/>
                        <path d="M85.6911 91.2156H72.8417L80.8786 44.6632H93.7274L85.6911 91.2156Z" fill="#15195A"/>
                        <path d="M132.271 45.8013C129.737 44.8594 125.717 43.8194 120.746 43.8194C108.057 43.8194 99.1213 50.1581 99.0665 59.2206C98.9611 65.9068 105.464 69.6205 110.328 71.8499C115.299 74.128 116.989 75.615 116.989 77.6456C116.938 80.7643 112.972 82.2018 109.273 82.2018C104.142 82.2018 101.394 81.4607 97.2164 79.7256L95.5244 78.9818L93.7263 89.4318C96.74 90.718 102.292 91.8593 108.057 91.9094C121.539 91.9094 130.317 85.6687 130.421 76.0112C130.472 70.7119 127.038 66.6513 119.635 63.3332C115.141 61.2031 112.389 59.7669 112.389 57.5875C112.441 55.6062 114.717 53.5769 119.79 53.5769C123.967 53.4775 127.036 54.4181 129.361 55.3594L130.524 55.8537L132.271 45.8013Z" fill="#15195A"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M155.271 44.6632H165.21L175.577 91.2149H163.679C163.679 91.2149 162.515 85.8662 162.146 84.2318H145.648C145.171 85.4693 142.952 91.2149 142.952 91.2149H129.469L148.555 48.5257C149.878 45.5045 152.206 44.6632 155.271 44.6632ZM154.479 61.6989C154.479 61.6989 150.407 72.0495 149.349 74.7238H160.03C159.501 72.3963 157.068 61.2532 157.068 61.2532L156.17 57.242C155.792 58.2749 155.245 59.695 154.876 60.6528C154.626 61.3021 154.458 61.739 154.479 61.6989Z" fill="#15195A"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M49.5254 76.4075L62.1092 44.6632H75.6964L55.4993 91.1662H41.9114L30.4587 50.7163C26.5072 48.5522 21.9975 46.8117 16.9553 45.6039L17.1668 44.6633H37.8403C40.6425 44.7613 42.9163 45.6032 43.6562 48.5764L48.1492 69.966C48.1495 69.9671 48.1499 69.9682 48.1503 69.9694L49.5254 76.4075Z" fill="#15195A"/>
                    </svg>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Products
                            <span class="totalPrice"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Shipping
                            <span>Free</span>
                        </li>
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total amount</strong>
                                <strong>
                                    <p class="mb-0">(including VAT)</p>
                                </strong>
                            </div>
                            <span><strong class="totalPrice"></strong></span>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-outline-dark btn-warning btn-lg btn-block rounded-pill">
                        Go to checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>