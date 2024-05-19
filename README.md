# Tour Reservation System

This Tour Reservation System is a web application developed to manage tour bookings and reservations. It allows users to view available tours, search for specific tours, and make reservations. Administrators can add new tours to the system. The application is built using HTML, CSS, JavaScript, PHP, and MySQL. XAMPP is used as the development environment.

## Features

- **User Registration and Login:** Users can register an account and log in to access the system.
- **Search Tours:** Users can search for tours by name or location.
- **View Tours:** Users can view a list of available tours with details like name, description, location, price, and image.
- **Book Tours:** Users can book a tour by filling out a form with their details and payment information.
- **Admin Panel:** Administrators can add new tours to the system with details like name, description, start and end dates, location, price, and image URL.
- **Responsive Design:** The application is designed to be responsive and user-friendly.

## Technologies Used

- **Frontend:**
  - HTML
  - CSS
  - JavaScript

- **Backend:**
  - PHP
  - MySQL

- **Development Environment:**
  - XAMPP

## Installation and Setup

### Prerequisites

- XAMPP installed on your machine
- A web browser

### Steps

1. **Clone the Repository:**
   ```bash
   git clone <repository_url>

2. **Start XAMPP:**
   - Open the XAMPP Control Panel.
   - Start the Apache and MySQL modules.

3. **Import the Database:**
   - Open phpMyAdmin by navigating to [http://localhost/phpmyadmin](http://localhost/phpmyadmin) in your web browser.
   - Create a new database named `list`.
   - Import the `list.sql` file located in the `database` directory of this project into the `list` database.



4. **Move Project Files to XAMPP Directory:**
   - Move the cloned repository files to the `htdocs` directory inside your XAMPP installation directory.

5. **Access the Application:**
   - Open your web browser and navigate to [http://localhost/<project_directory>](http://localhost/<project_directory>).


### Usage
1.**Admin Panel:**
Log in as an administrator. since signup is not option in case of Admin. Goto the database and create Admin
Navigate to the "Add Tour" page to add new tours to the system.

2.**User Registration:**
Navigate to the registration page and create a new account.

3.**Login:**
Signup and Log in using your email and password.

4.**Browse Tours:**
Browse the available tours on the homepage.

5.**Search Tours:**
Use the search bar to find specific tours by name or location.

6.**Book a Tour:**
Click the "Book Now" button on a tour to open the booking form.
Fill out the required information and submit the form to book the tour.


