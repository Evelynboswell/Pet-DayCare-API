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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
        body {
            background-image: url(images/smallPawPrintsBG.png);
            background-attachment: fixed;
            overflow: hidden;
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
            max-height: 180px;
            overflow-y: scroll; 
            margin: auto;
            margin-top: 30px;
        }
        table {
            border-collapse: separate;
            border-spacing: 0 12px;
            text-align: center;
            margin-top: -10px;
        }
        table thead th {
            font-weight: 500;
        }
        table tbody tr {
            background-color: rgba(255, 191, 0, 0.2);
        }
        table tbody tr td:first-child {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }
        table tbody tr td:last-child {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
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
                <h5>Service Information</h5>
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
                            <tr>
                                <td>Sammy</td>
                                <td>2/11/2024</td>
                                <td>Daycare</td>
                                <td>Full Day</td>
                                <td>Rp 100.000</td>
                            </tr>
                            <tr>
                                <td>Sammy</td>
                                <td>2/11/2024</td>
                                <td>Daycare</td>
                                <td>Full Day</td>
                                <td>Rp 100.000</td>
                            </tr>
                            <tr>
                                <td>Sammy</td>
                                <td>2/11/2024</td>
                                <td>Daycare</td>
                                <td>Full Day</td>
                                <td>Rp 100.000</td>
                            </tr>
                            {{-- @foreach ()
                            <tr>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                            </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="pets-container">

            </div>
            <div class="services-container">

            </div>
        </main>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
