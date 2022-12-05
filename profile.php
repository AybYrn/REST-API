<?php
$userId = 7;
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/site.webmanifest">

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

        <style>
            div.profileContainer img{
                border: 1px solid red;
            }
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
        </style>
    </head>
    <body>

        <script>
            $(function () {
                $('header').load("header.html");

                var user;
                $.ajax({
                    type: "GET",
                    url: "http://localhost/WD_Assesment_1/api/customer/<?= $userId ?>",
                    success: function (data) {
                        data = JSON.parse(data);
                        user = data;
                    },
                    async: false
                });
                function putInfo() {
                    $(".nameOfUser").append(user.name);
                    $(".profileContainer img").attr("src", "./images/profile_pictures/" + user.profile_photo);
                    $(".email").val(user.email);
                    $(".pnumber").val(user.phone_number);
                    $(".address").val(user.address);
                }

                $("#edit").click(function () {
                    $("input").attr("readonly", false);
                    $("input").addClass("border-danger");
                    $("input").addClass("fw-bold");
                    $("button").css("display", "block");
                });

                $("button").click(function () {
                    var updatedemail = $("input.email").val();
                    var updatedpnumber = $("input.pnumber").val();
                    var updatedaddress = $("input.address").val();
                    $.ajax({
                        type: "PUT",
                        url: "http://localhost/WD_Assesment_1/api/profile/" + <?= $userId ?>,
                        data: JSON.stringify({email: updatedemail, phone: updatedpnumber, address: updatedaddress}),
                        success: function (data) {
                           location.reload();
                        }
                    });
                });

                putInfo();

            });



        </script>
        <header></header>

        <div class="container py-5 w-h-100">
            <div class="row-1 d-flex justify-content-center align-items-center">
                <div class="col col-12 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 mb-5 gradient-custom  text-center text-dark"
                                 style="border-top-left-radius: .8rem; border-bottom-left-radius: .5rem;">
                                <div class="profileContainer">
                                    <img alt="Avatar" class="img-fluid my-5 rounded-circle" style="width: 150px;" />
                                </div>
                                <h5 class="nameOfUser"></h5>
                                <a class="button" id="edit">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.204 10.796L19 9C19.5453 8.45475 19.8179 8.18213 19.9636 7.88803C20.2409 7.32848 20.2409 6.67153 19.9636 6.11197C19.8179 5.81788 19.5453 5.54525 19 5C18.4548 4.45475 18.1821 4.18213 17.888 4.03639C17.3285 3.75911 16.6715 3.75911 16.112 4.03639C15.8179 4.18213 15.5453 4.45475 15 5L13.1814 6.81866C14.1452 8.46926 15.5314 9.84482 17.204 10.796ZM11.7269 8.27312L4.8564 15.1436C4.43134 15.5687 4.21881 15.7812 4.07907 16.0423C3.93934 16.3034 3.88039 16.5981 3.7625 17.1876L3.1471 20.2646C3.08058 20.5972 3.04732 20.7635 3.14193 20.8581C3.23654 20.9527 3.40284 20.9194 3.73545 20.8529L6.81243 20.2375C7.40189 20.1196 7.69661 20.0607 7.95771 19.9209C8.21881 19.7812 8.43134 19.5687 8.8564 19.1436L15.7458 12.2542C14.1241 11.2386 12.7524 9.87628 11.7269 8.27312Z" fill="#222222"/>
                                    </svg>
                                </a>

                            </div>
                            <div class="col-md-8 my-auto">
                                <div class="card-body p-4">
                                    <h6 class="text-danger">Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6 class="text-danger">Email</h6>
                                            <input class="form-control bg-light text-muted email" readonly></input>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6 class="text-danger">Phone</h6>
                                            <input class="form-control bg-light text-muted pnumber" readonly></input>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6 class="text-danger">Address</h6>
                                            <input class="form-control bg-light text-muted address" readonly></input>
                                        </div>
                                        <div class="col-6 mb-3 d-flex justify-content-center my-auto">
                                            <button type="button" class="btn btn-danger btn-outline-light" style="display: none;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
