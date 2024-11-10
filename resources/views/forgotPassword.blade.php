@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <title>Forgot Password</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        body {
            background-color: #430090;
            overflow: hidden;
        }

        .text_div {
            padding-top: 50px;
            margin-top: -700px;
            color: white;
            text-align: center;
        }

        .text_div h1 {
            font-size: 60px;
            font-weight: bold;
            margin: auto;
        }

        .text_div h2 {
            font-size: 40px;
            font-weight: bold;
            margin: auto;
        }

        .form_div {
            position: relative;
            margin: auto;
            margin-top: 20px;
            background-color: white;
            height: 350px;
            width: 470px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form_div h2 {
            color: #7700FF;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 20px;
            box-shadow: 0px 3px 3px rgb(238, 238, 238);
        }

        .input-group input {
            width: 100%;
            font-size: 20px;
            padding: 10px 20px 10px 60px;
            border: none;
            color: rgba(119, 0, 255, 0.4);
            background-color: #faf6ff;
            outline: none;
        }
        .input-group input::placeholder {
            color: rgba(119, 0, 255, 0.4);
        }

        .input-group .icon {
            position: absolute;
            margin-left: 10px;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #8000ff;
        }

        button {
            margin-top: 20px;
            margin-left: 120px;
            padding: 8px 50px;
            font-size: 22px;
            color: #ffffff;
            font-weight: bold;
            background-color: #7700FF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #6a00e2;
        }
    </style>
</head>

<body>
    <div class="text_div">
        <h1>Ehmm?</h1>
        <h2>Forgot Your Password?</h2>
    </div>
    <div class="form_div">
        {{-- <form method="POST" action="{{ route('forgotPassword') }}"> --}}
        <form method="POST" action="{{ route('forgotPassword.post') }}">
        @csrf
            <h2>Email</h2>
            <div class="input-group">
                <span class="icon">@include('components.svg_user1')</span>
                <input type="text" placeholder="Email" required>
            </div>
            <div class="input-group">
                <span class="icon">@include('components.svg_password1')</span>
                <input type="password" placeholder="New Password" required>
            </div>
            <div class="input-group">
                <span class="icon">@include('components.svg_confirmPassword2')</span>
                <input type="password" placeholder="Confirm New Password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
