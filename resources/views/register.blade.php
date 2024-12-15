<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            background-color: #FFBF00;
            overflow: hidden;
        }

        .picture_div {
            height: fit-content;
            width: fit-content;
            margin-top: 10vh;
        }

        .picture_div img {
            height: 90vh;
            width: 90vw;
            /* height: 650px; */
            /* width: 1450px; */
        }

        .text_div {
            padding-top: 50px;
            /* margin-top: -730px; */
            margin-top: -100vh;
            color: white;
            text-align: center;
        }

        .text_div h1 {
            font-size: 70px;
            font-weight: bold;
        }

        .form_div {
            position: relative;
            margin: auto;
            margin-top: 20px;
            background-color: white;
            height: 507px;
            width: 570px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form_div h2 {
            color: #FEA603;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 15px;
            box-shadow: 0px 3px 3px rgb(238, 238, 238);
        }

        .input-group input,
        .input-group select {
            display: flex;
            align-items: center;
            width: 100%;
            font-size: 20px;
            padding: 10px 20px 10px 60px;
            border: none;
            color: rgba(254, 166, 3, 0.6);
            background-color: rgba(255, 191, 0, 0.1);
            outline: none;
        }

        .input-group input::placeholder {
            color: rgba(254, 166, 3, 0.6);
        }

        #name {
            width: 62%;
        }

        #gender-group {
            width: 35%;
            margin-top: -65px;
            margin-left: 332px;
        }

        #password {
            width: 48%;
        }

        #confirmPassword {
            width: 48%;
            margin-top: -65px;
            margin-left: 265px;
        }

        .input-group .icon {
            position: absolute;
            margin-left: 10px;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }

        .hasAccount {
            display: block;
            margin: 10px 0;
            font-size: 14px;
            color: #FEA603;
            text-decoration: none;
        }

        button {
            margin-left: 150px;
            padding: 8px 50px;
            font-size: 22px;
            color: #ffffff;
            font-weight: bold;
            background-color: #FEA603;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e59501;
        }
    </style>
</head>

<body>
    <div class="picture_div">
        <img src="images/dogToy.png" alt="dog toy picture">
    </div>
    <div class="text_div">
        <h1>Join Us!</h1>
    </div>
    <div class="form_div">
        <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Register</h2>
        <div class="input-group" id="name">
            <span class="icon">@include('components.svg_user2')</span>
            <input type="text" name="name" placeholder="Name" required>
        </div>
        <div class="input-group" id="gender-group">
            <span class="icon">@include('components.svg_gender')</span>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="input-group">
            <span class="icon">@include('components.svg_mail')</span>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
            <span class="icon">@include('components.svg_phone')</span>
            <input type="text" name="phone_number" placeholder="Whatsapp" required>
        </div>
        <div class="input-group">
            <span class="icon">@include('components.svg_address')</span>
            <input type="text" name="address" placeholder="Address" required>
        </div>
        <div class="input-group" id="password">
            <span class="icon">@include('components.svg_password2')</span>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group" id="confirmPassword">
            <span class="icon">@include('components.svg_confirmPassword')</span>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        <a href="{{ route('loginView') }}" class="hasAccount">Already have an account?</a>
        <button type="submit">Register</button>
    </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
