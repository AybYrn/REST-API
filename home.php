<?php
$userId = 8;
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>HOME</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/site.webmanifest">

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="./js/pagination.min.js"></script>

        <style>
            :root {
                --blue: #007bff;
                --indigo: #6610f2;
                --purple: #6f42c1;
                --pink: #e83e8c;
                --red: #dc3545;
                --orange: #fd7e14;
                --yellow: #ffc107;
                --green: #28a745;
                --teal: #20c997;
                --cyan: #17a2b8;
                --white: #fff;
                --gray: #6c757d;
                --gray-dark: #343a40;
                --bs-border-radius-sm: 0.70rem;
                --bs-orange: #fd7e14;

            }
            a.nav-link{
                color: var(--gray);
            }
            a.nav-link:hover{
                color: black;
            }
            h3{
                color: orangered;
            }

        </style>
    </head>
    <body>
        <script>
            $(function () {
                $('header').load("header.html");
            });
        </script>
        <header></header>
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

                $.ajax({
                    type: "GET",
                    url: "http://localhost/WD_Assesment_1/api/products/1",
                    success: function (data) {
                        data.forEach(p => {
                            var pic = {location: "default.png"};
                            $.ajax({
                                type: "GET",
                                url: "http://localhost/WD_Assesment_1/api/product/pic/" + p.id,
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
                                            <a href="#" class="btn btn-warning rounded-pill add" id="` + p.id + `">Add</a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                        );
                        $(".add").click(function () {
                            addProductToCart(parseInt($(this).attr("id")));
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
    </body>
</html>
