<script>

    $(window).on("load", function () {
        var items;
        $(".order").empty();
        $.ajax({
            type: "GET",
            url: "http://localhost/WD_Assesment_1/api/purchase/<?= $userId ?>",
            success: function (data) {
                data = JSON.parse(data);
                items = data;
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

                    $(".order").append(`
                    <div class="row">
                        <div class="col-1">
                            <img src="./images/products/` + pic.location + `" class="img-fluid rounded-start small" >
                        </div>
                        <div class="col-8 my-auto ms-3">
                            <div>
                                <h5 class="productName">` + p.name + `</h5>
                                <p><small class="text-muted productDate">` + p.date + `</small></p>
                                <p><small class="text-muted productPriceQuantity">` + p.price + ` X ` + p.quantity + `</small></p>
                            </div>
                        </div>
                    </div>
                `);
                });
            }
        });
    });

</script>

<div class="container mt-3 order"></div>
