<script>
    $(document).ready(function () {
        function addProductToCart(id) {
            $.ajax({
                type: "POST",
                url: "http://localhost/WD_Assesment_1/api/cart",
                data: JSON.stringify({product_id: id, cust_id: <?= $userId ?>, amount: 1}),
                success: function (data) {
                    data = JSON.parse(data);
                }
            });
        }

        function searchProduct(word) {
            $(".products").html("");
            $.ajax({
                type: "GET",
                url: "http://localhost/WD_Assesment_1/api/products/search/name/" + word,
                success: function (data) {
                    console.log(data);
                    data.forEach(p => {
                        var pic = {location: "default.png"};
                        $.ajax({
                            type: "GET",
                            url: "http://localhost/WD_Assesment_1/api/products/pic/" + p.id,
                            success: function (data) {
                                var pics = JSON.parse(data);
                                if (pics.length !== 0)
                                    pic = pics[0];
                            },
                            async: false
                        });
                        if (p.disc_price === null) {
                            p.disc_price = "";
                        }
                        $(".products").append(`
                        <div class="col mb-5">
                            <div class="card" style="width: 18rem;">
                                <img src="./images/products/` + pic.location + `" class="card-img-top" alt="...">
                                <div class="card-body text-end">
                                    <h5 class="card-title text-center text-truncate" title="` + p.name + `">` + p.name + `</h5>
                                    <p class="card-text text-danger">` + p.normal_price + ` € ` + p.disc_price + `</p>
                                    <p class="card-text">` + p.expr_date + `</p>
                                    <button class="btn btn-warning rounded-pill add" type="button" data-toggle="modal" data-target="#exampleModal" id="` + p.id + `">Add</button>
                                </div>
                            </div>
                        </div>
                    `);
                    });
                },
                dataType: "json"
            });
        }

        $.ajax({
            type: "GET",
            url: "http://localhost/WD_Assesment_1/api/products/1",
            success: function (data) {
                data.forEach(p => {
                    var pic = {location: "default.png"};
                    $.ajax({
                        type: "GET",
                        url: "http://localhost/WD_Assesment_1/api/products/pic/" + p.id,
                        success: function (data) {
                            var pics = JSON.parse(data);
                            if (pics.length !== 0)
                                pic = pics[0];
                        },
                        async: false
                    });
                    if (p.disc_price === null) {
                        p.disc_price = "";
                    }
                    $(".products").append(`
                        <div class="col mb-5">
                            <div class="card" style="width: 18rem;">
                                <img src="./images/products/` + pic.location + `" class="card-img-top" alt="...">
                                <div class="card-body text-end">
                                    <h5 class="card-title text-center text-truncate" title="` + p.name + `">` + p.name + `</h5>
                                    <p class="card-text text-danger">` + p.normal_price + ` € ` + p.disc_price + `</p>
                                    <p class="card-text">` + p.expr_date + `</p>
                                    <button class="btn btn-warning rounded-pill add" type="button" data-toggle="modal" data-target="#exampleModal" id="` + p.id + `">Add</button>
                                </div>
                            </div>
                        </div>
                    `);
                });
                $(".add").click(function () {
                    $('#exampleModal').modal("show");
                    $.ajax({
                        type: "GET",
                        url: "http://localhost/WD_Assesment_1/api/products/search/id/" + parseInt($(this).attr("id")),
                        datatype: "application/json",
                        success: function (data) {
                            data = JSON.parse(data);
                            $('h5#exampleModalLabel').text(data.name);
                        },
                        async: false
                    });
                    addProductToCart(parseInt($(this).attr("id")));
                });

                $("#searchbtn").click(function (e) {
                    e.preventDefault();
                    searchProduct($("#search").val());
                });
            },
            dataType: "json"
        });
    });
</script>

<div class="container-xxl my-2">
    <h3 class="mb-5 text-center text-uppercase">Products</h3>

    <div class="row products"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Product has been added!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
