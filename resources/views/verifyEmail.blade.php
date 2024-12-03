<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <title>Verify Email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            background-color: #FFBF00;
            overflow: hidden;
        }

        .form_div {
            margin: auto;
            margin-top: 100px;
            background-color: white;
            height: 360px;
            width: 500px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form_div h1 {
            color: #FEA603;
            margin-bottom: 15px;
            font-weight: bold;
        }

        #loginBtn {
            margin-left: 80px;
            padding: 8px 30px;
            font-size: 18px;
            color: #ffffff;
            font-weight: bold;
            background-color: #1f79ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #loginBtn:hover {
            background-color: #0056d7;
        }
    </style>
</head>

<body>
    <div class="form_div">
        <h1>Verify Your Email</h1>
        <br>
        <p>Please check your email inbox as soon as possible</p>
        <p>The registration process will be completed if you do so</p>
        <br>
        <p>If you have, please click the Login button</p>
        <br>
        <button type="button" class="btn" id="loginBtn" onclick="window.location='{{ route('loginView') }}'">I Have Verified My Account</button>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>