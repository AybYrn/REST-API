<?php
$userId = 7;
?>

<html>
    <head>
        <title>Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/site.webmanifest">

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.js"></script>
        <style>
            button.quantity{
                height: 40px;
                border: none;
                background-color: #ffffff;
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
            h3{
                color: orangered;
            }
            
        </style>
        <script>
            $(window).ready(function(){
                $("li.nav-item").click(function(){
                    $(window).trigger("load");
                });
            });
        </script>
    </head>
    <body>
        <?php include 'header.html'; ?>
        
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><?= include 'home.php'; ?></div>
            <div class="tab-pane fade" id="pills-cart" role="tabpanel" aria-labelledby="pills-cart-tab"><?= include 'cart.php';?></div>
            <div class="tab-pane fade" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab"><?= include 'order.php';?></div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><?= include 'profile.php';?></div>
        </div>
    </body>
</html>