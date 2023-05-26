<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Design Using HTML & CSS</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <div class="container mt-2">
        <header class="d-flex align-items-center justify-content-between">
            <div class="d-flex">
                <div class="d-flex align-items-center">
                <span class="mr-3">Logo</span>
                <img src="" class="logo">
            </div>
            <nav>
                <ul class="list-inline mb-0 ml-5">
                    <li class="list-inline-item"><a class="text-white" href="">Home</a></li>
                    <li class="list-inline-item"><a class="text-white" href="">Order Now</a></li>
                </ul>
            </nav>
            </div>
            
            <div class="d-flex">
                <a href="user_login.php"><button class="btn btn-outline-primary" id="btn1">Log in</button></a>
                <a href="register.php"><button class="btn btn-primary" id="btn2">Sign Up</button></a>
            </div>
        </header>
        <div class="content d-flex justify-content-between align-items-center flex-wrap-reverse">
            <div class="text m-5">
                <h1 class="display-4 fw-bold m-0 text-white">Food Crave</h1>
                <p class="font-italic m-0 text-white">Pepsi is a carbonated soft drink manufactured by PepsiCo. <br>Originally created and developed in 1893 by Caleb Bradham <br>and introduced as Brad's Drink, it was renamed as Pepsi-Cola in 1898, and then shortened to Pepsi in 1961.</p>
                <button class="btn">Order now</button>
            </div>
            <div class="pepsi">
                <img src="" alt="">
            </div>
        </div>
        
        <div class="sub-content d-flex justify-content-around align-items-center mt-5">
             <div class="sub-item text-center">
                <img class="rounded-circle" src="https://source.unsplash.com/120x120/?food" alt="Food Image 1">
                <p class="mt-3 text-white fs-2">Order and Pick-up</p>
            </div>
             <div class="sub-item text-center">
                <img class="rounded-circle" src="https://source.unsplash.com/120x120/?food" alt="Food Image 2">
                <p class="mt-3 text-white fs-2">Deliver at your home</p>
            </div>
            <div class="sub-item text-center">
                <img class="rounded-circle" src="https://source.unsplash.com/120x120/?food" alt="Food Image 3">
                <p class="mt-3 text-white fs-2">Call 09057331813</p>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>