<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <title>Welcome To DoggoCare</title>
    <style>
        body {
            background-color: #FFBF00;
            background-image: url(images/pawPrintsBG.png);
            background-repeat: repeat;
            background-attachment: fixed;
            background-size: cover;
            overflow: hidden;
        }
        .picture_div {
            height: fit-content;
            width: fit-content;
            margin-top: -455px;
            margin-left: 190px;
        }
        img {
            height: 915px;
        }
        .buttons_div {
            position: relative;
            margin-top: -470px;
        }
        .text_div {
            position: relative;
            padding-top: 50px; 
            margin-left: 200px;
            color: white;
        }
        .text_div h2 {
            font-size: 120px;
            font-weight: bold;
        }
        #love {
            font-size: 52px;
            font-weight: bolder;
            margin-top: -130px;
            margin-left: 190px; 
        }
        #care {
            font-size: 52px;
            font-weight: bolder;
            margin-top: -25px;
            margin-left: 190px; 
        }
        .text_div h4 {
            font-size: 45px;
            font-weight: bold;
            margin-left: 20px;
        }
        .text_div h1 {
            color: #7700FF;
            font-size: 130px;
            font-weight: bold;
            margin-left: 65px;
            margin-top: -93px;
            margin-bottom: 50px;
        }
        .buttons_div {
            margin-left: 280px;
        }
        #loginBtn {
            font-size: 22px;
            font-weight: bold;
            padding: 10px 110px;
            margin-bottom: 15px;
            background-color: #7700FF;
        }
        #loginBtn:hover {
            background-color: #6a00e2;
        }
        #registerBtn {
            font-size: 22px;
            font-weight: bold;
            padding: 10px 98px;
            color: #f7b900;
        }
        #registerBtn:hover {
            background-color: rgb(228, 228, 228);
        }
    </style>
</head>

<body>
    <div class="text_div">
        <h2>WE</h2>
        <h3 id="love">Love</h3>
        <h3 id="care">Care</h3>
        <h4>in</h4>
        <h1>DOGGO</h1>
        <h1>CARE</h1>
    </div>
    <div class="picture_div">
        <img src="images/dogPicture2.png" alt="smiling dog">
    </div>
    <div class="buttons_div">
        <button type="button" class="btn btn-primary" id="loginBtn" onclick="window.location='{{route('loginView')}}'">Login</button>
        <br>
        <button type="button" class="btn btn-light" id="registerBtn" onclick="window.location='{{ route('registerView') }}'">Register</button>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
