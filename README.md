# 🐾 DoggoCare - Dog Daycare Reservation System 🐾  

Welcome to **DoggoCare**, the ultimate solution for dog daycare reservations! 

## 📖 About the Project  

DoggoCare is a user-friendly reservation and booking system designed specifically for dog daycare services.

## ✨ Key Features  

- **User Management**  
  Effortlessly register, log in, and manage your account. Email verification ensures secure access.  

- **Dog Profile Management**  
  Keep detailed profiles for each furry friend, including their name, breed, and special needs.  

- **WhatsApp Notifications**  
  Never miss an appointment with automated WhatsApp reminders sent before upcoming reservations.  

- **Online Payments**  
  Secure and convenient payment processing powered by the Midtrans payment gateway.  

- **Appointment Scheduling**  
  A hassle-free way to book and manage daycare appointments.  

## 🔧 Technologies Used  

- **Backend**: Laravel 10  
- **Database**: MySQL  
- **Development Tools**:  
  - VSCode  
  - Postman (for API testing)  

## 🌐 APIs Integrated  

- **[Fonnte API](https://fonnte.com)**  
  Simplified WhatsApp notifications for seamless communication.  

- **[Midtrans API](https://midtrans.com)**  
  A trusted payment gateway for secure transactions.  

## 🔚 Endpoints
1. User Management
    - Register new account
      ```bash
      POST /api/register
      ```
    - Authenticate user and give access token
      ```bash
      POST /api/login
      ```
    - Logout
      ```bash 
      POST /api/logout
      ```
    - Retrieve user information
      ```bash
      GET /api/user
      ```
    - Update user information
      ```bash
       PUT /api/user/{id}/update
      ```
    - Send link to reset password through email
      ```bash
      POST /api/forgot-password
      ```
    - Reset user's password
      ```bash
      POST /api/reset-password
      ```
    - Delete account
      ```bash
      DELETE /api/delete
      ```


2. Dog Profile Management
    - Retrive user's dog(s) information
      ```bash
      GET /api/dogs
      ```
    - Add new dog
      ```bash
      POST /api/dogs
      ```
    - Retrieve information of a specific dog
      ```bash
      GET /api/dogs/{dog_id}
      ```
    - Update dog information
      ```bash
      PUT /api/dogs/{dog_id}
      ```
    - Delete dog information
      ```bash
      DELETE /api/dogs/{dog_id}
      ```

   
3. Boarding
    - Retrieve list of services available at the daycare
      ```bash
      GET /api/boardings
      ```
    - Retrieve a certain boarding service's information
      ```bash
      GET /api/boardings/{boarding_id}
      ```
    - Create new boarding services
      ```bash
      POST /api/boardings
      ```

      
4. Booking Appointment
    - Create a new appointment
      ```bash
      POST /api/bookings
      ```
    - Retrieve list of made appointments
      ```bash
      GET /api/bookings
      ```
    - Retrieve a certain appointment's information
      ```bash
      GET /api/bookings/{booking_id}
      ```
    - Update a certain appointment's information
      ```bash
      PUT /api/bookings/{booking_id}
      ```
    - Delete or Cancel appointment
      ```bash
      DELETE /api/bookings/{booking_id}
      ```
View the API documentation using Swagger Editor: https://editor.swagger.io/?url=https://raw.githubusercontent.com/Evelynboswell/Pet-DayCare-API/main/openapi.yaml

## 🛠️ Getting Started  

Follow these steps to set up DoggoCare on your local machine:  

### Prerequisites  

- PHP >= 8.1  
- Composer  
- MySQL  
- Node.js & npm (for frontend assets)
- Midtrans account (to get the Server and Client keys)
- Fonnte account (to get the token)

### Installation
1. Clone the repository
2. Install dependencies
   ```bash
   composer install
   npm install
   composer require midtrans/midtrans-php
3. Set up environment details
   - Database credentials
   - Fonnte API token
   - Midtrans API keys
4. Run migrations and seeders
   ```bash
   php artisan migrate
   php artisan db:seed  
5. Scheduler setup
   ```bash
   php artisan schedule:run   
6. Run the server
   ```bash
   php artisan serve

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
