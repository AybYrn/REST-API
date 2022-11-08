<?php
$userId = 8;
?><!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>Order</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/site.webmanifest">

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

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
            img{
                max-width: 10%;
            }
        </style>
    </head>
    <body>
        <script>

            $(function () {

                $('header').load("header.html");

                var items;
                $.ajax({
                    type: "GET",
                    url: "http://localhost/WD_Assesment_1/api/purchaseHistory/<?= $userId ?>",
                    success: function (data) {
                        data = JSON.parse(data);
                        items = data;
                        data.forEach(p => {
                            var pic = {location: "default.png"};
                            $.ajax({
                                type: "GET",
                                url: "http://localhost/WD_Assesment_1/api/product/pic/" + p.product_id,
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
        <header></header>
        <div class="container mt-3 order">

        </div>
    </body>
</html>
