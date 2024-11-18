@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        body {
            background-color: #430090;
        }
        label:not(#warningText) {
            font-weight: 500;
        }
        .card {
            margin: auto;
            width: 80%;
            height: 80vh;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
        }
        h3 {
            font-size: 22px;
        }
        .farLeft {
            margin-top: 20px; 
            margin-left: 30px;
            width: 5%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sectionLeft {
            width: 27%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sectionRight {
            margin-top: -290px;
            width: 70%;
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-left: auto;
            margin-right: 40px;
        }
        .group {
            display: flex;
            justify-content: space-between;
        }
        .form-group input, .form-group select {
            width: 395px;
            height: 40px;
            background-color: #F0F0F0;
            border: none;
            border-radius: 5px;
            padding-left: 20px;
        }
        .form-group input[type=password] {
            width: 260px;
        }
        button {
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            height: 35px;
            width: 70px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }
        .save-btn {
            background-color: #2BCD43;
        }
        .save-btn:hover {
            background-color: #15AD45;
        }
        .delete-btn {
            background-color: #FF1111;
        }
        .delete-btn:hover {
            background-color: #d81111
        }
        .photoProfile {
            margin-left: -40px;
        }
        .photo-upload {
            position: relative;
            display: inline-block;
            width: 275px;
            height: 248px;
        }
        .profile-img {
            width: 275px;
            height: 248px;
            border-radius: 50%;
        }
        .photo-upload a {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .photo-upload a:hover {
            cursor: pointer;
        }
        .photoProfile button {
            margin-left: 100px;
        }
        .back-btn a:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="farLeft">
        <a href="{{ route('dashboard')}}" class="back-btn">
            <div class="svg-inactive">
                @include('components.svg_arrowLeft')
            </div>
            <div class="svg-active" style="display: none;">
                @include('components.svg_arrowLeftActive')
            </div>
        </a>
    </div>
    <div class="card">
        <div class="sectionLeft">
            <div class="photoProfile">
                @include('profile.partials.update-photo-profile-form')
            </div>
        </div>

        <div class="sectionRight">
            <div class="profileInfo">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="changePassword">
                @include('profile.partials.update-password-form')
            </div>
            <div class="deleteAcc">
                @include('profile.partials.delete-account-form')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const icons = document.querySelectorAll(".camera-icon, .back-btn");
    
            icons.forEach((icon) => {
                const inactiveSvg = icon.querySelector(".svg-inactive");
                const activeSvg = icon.querySelector(".svg-active");
    
                icon.addEventListener("mouseenter", function () {
                    inactiveSvg.style.display = "none";
                    activeSvg.style.display = "block";
                });
    
                icon.addEventListener("mouseleave", function () {
                    inactiveSvg.style.display = "block";
                    activeSvg.style.display = "none";
                });
            });
        });
        </script>
</body>

</html>
