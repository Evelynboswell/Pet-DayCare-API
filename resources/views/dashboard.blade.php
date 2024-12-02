@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            background-image: url(images/smallPawPrintsBG.png);
            background-attachment: fixed;
            overflow: hidden;
            background-color: #FFBF00;
        }

        .second-container {
            width: 75%;
            display: flex;
            justify-content: space-between;
            margin-left: 300px;
            margin-top: 40px;
        }

        .bookings-container {
            width: 75%;
            height: 300px;
            max-height: 400px;
            margin-top: -650px;
            margin-left: 300px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .bookings-list {
            width: 95%;
            height: 180px;
            padding-right: 10px;
            max-height: 180px;
            overflow-y: scroll;
            margin: auto;
            margin-top: 30px;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 12px;
            text-align: center;
            margin-top: -10px;
        }

        .table thead th {
            font-weight: 500;
        }

        .table tbody tr {
            background-color: rgba(255, 191, 0, 0.8);
        }

        .table tbody tr td {
            padding: 10px 0px;
        }

        .table tbody tr td:first-child {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .table tbody tr td:last-child {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .pets-container {
            width: 50%;
            height: 230px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .pets-text {
            display: flex;
            justify-content: space-between;
        }

        .pets-list {
            width: 95%;
            height: 140px;
            padding-right: 10px;
            max-height: 140px;
            overflow-y: scroll;
            margin: auto;
            margin-top: 20px;
        }

        .services-container {
            width: 45%;
            height: 230px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .services-list {
            width: 80%;
            height: 140px;
            padding-right: 10px;
            margin: auto;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <x-sidebar />
        </div>

        <!-- Main Content Div -->
        <main class="content">
            <!-- Your main content here -->
            <div class="bookings-container">
                <h5>Booking Information</h5>
                <div class="bookings-list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pet</th>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Service Type</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->dog->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                                    <td>{{ $booking->boarding->service_name }}</td>
                                    <td>{{ $booking->boarding->service_type }}</td>
                                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="second-container">
                <div class="pets-container">
                    <div class="pets-text">
                        <h5>Your Pets</h5>
                        <a href="#">See all</a>
                    </div>
                    <div class="pets-list">
                        {{-- <table class="pets-table">
                            <tr>
                                @foreach ($dogs as $dog)
                                    @if ($loop->index == 0)
                                        <td>
                                            <a href="#" class="pet-icon" data-inactive="components.svg_dogInactive" data-active="components.svg_dogActive">
                                                @include('components.svg_dogInactive')
                                            </a>
                                            <br>
                                            <label>{{ $dog->name }}</label>
                                        </td>
                                    @elseif ($loop->index == 1)
                                        <td>
                                            <a href="#" class="pet-icon" data-inactive="components.svg_dogInactive" data-active="components.svg_dogActive">
                                                @include('components.svg_dogInactive')
                                            </a>
                                            <br>
                                            <label>{{ $dog->name }}</label>
                                        </td>
                                        <td class="add-pet">
                                            <a href="#" class="pet-icon" data-inactive="components.svg_plusInactive" data-active="components.svg_plusActive">
                                                @include('components.svg_plusInactive')
                                            </a>
                                            <br>
                                            <label>Add Pet</label>
                                        </td>
                                    @else
                                        @break
                                    @endif
                                @endforeach
                            </tr>
                    
                            @php $dogIndex = 2; @endphp
                            @for ($i = $dogIndex; $i < count($dogs); $i += 3)
                                <tr>
                                    @for ($j = 0; $j < 3 && $i + $j < count($dogs); $j++)
                                        <td>
                                            <a href="#" class="pet-icon" data-inactive="components.svg_dogInactive" data-active="components.svg_dogActive">
                                                @include('components.svg_dogInactive')
                                            </a>
                                            <br>
                                            <label>{{ $dogs[$i + $j]->name }}</label>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table> --}}
                    </div>
                </div>
                <div class="services-container">
                    <h5>Book Our Services</h5>
                    <div class="services-list">
                        <div>
                            <a href="#" class="services-icon">
                                <div class="svg-inactive">
                                    @include('components.svg_daycareInactive')
                                </div>
                                <div class="svg-active" style="display: none;">
                                    @include('components.svg_daycareActive')
                                </div>
                            </a>
                            <label>Daycare</label>
                        </div>
                        <div>
                            <a href="#" class="services-icon">
                                <div class="svg-inactive">
                                    @include('components.svg_groomingInactive')
                                </div>
                                <div class="svg-active" style="display: none;">
                                    @include('components.svg_groomingActive')
                                </div>
                            </a>
                            <label>Grooming</label>
                        </div>
                        <div>
                            <a href="#" class="services-icon">
                                <div class="svg-inactive">
                                    @include('components.svg_trainingInactive')
                                </div>
                                <div class="svg-active" style="display: none;">
                                    @include('components.svg_trainingActive')
                                </div>
                            </a>
                            <label>Training</label>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Include Bootstrap JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const icons = document.querySelectorAll(".services-icon");

            icons.forEach((icon) => {
                const inactiveSvg = icon.querySelector(".svg-inactive");
                const activeSvg = icon.querySelector(".svg-active");

                icon.addEventListener("mouseenter", function() {
                    inactiveSvg.style.display = "none";
                    activeSvg.style.display = "block";
                });

                icon.addEventListener("mouseleave", function() {
                    inactiveSvg.style.display = "block";
                    activeSvg.style.display = "none";
                });
            });
        });
    </script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js">
        < /> <
        /body>

        <
        /html>
