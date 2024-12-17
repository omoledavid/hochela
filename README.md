# Hochela

**Hochela** is an accommodation website that helps students find hostels and houses at affordable rates, offering a
stress-free experience.

## Installation

1. Clone the repository to your local machine:
   ```bash
   git clone <repository-url>

2. Navigate into the project directory:

    ``` bash
    cd hochela

3. Install the project dependencies using Composer:

    ```bash
    composer install
4. Copy the example environment configuration file:

    ```bash
    cp .env.example .env

5. Open the .env file and make the necessary configuration changes:

    * Set your database connection, mail settings, and any other environment-specific configurations.

6. Generate a new application key:

    ```bash
    php artisan key:generate

7. Import the database schema:

    * Run the SQL script to set up the database:

    ```bash
    mysql -u yourusername -p yourdatabase < database.sql

8. Run database migrations (if applicable):

    ```bash
    php artisan migrate

9. Serve the application locally:

    ```bash
    php artisan serve

Now, your Laravel app should be up and running at http://localhost:8000.

## Usage

1. Visit the website: Go to https://hochela.com to access the platform.

2. Search for accommodation: Use the search functionality to easily locate hostels and houses in your preferred area at
   the
   best prices.

3. Filter results: Apply filters like price range, location, and type of accommodation to narrow down your options.

4. View accommodation details: Click on any listing to view more details, including photos, prices, and contact
   information.

5. Contact landlords or hostel managers: Once you've found a suitable accommodation, reach out directly to the property
   owner or manager for more information or to book.

## Features

* Search Functionality: Easily search for hostels and houses based on location, price range, and accommodation type.

* Advanced Filters: Refine your search results with filters such as price range, accommodation type, and location for a
  more personalized experience.

* Booking: Directly book your accommodation through the website, streamlining the process from search to reservation.

## Technologies

* **Backend**: Laravel (PHP Framework)
* **Database**: MySQL

License
This project is built using the Laravel framework, which is open-sourced software licensed under the MIT license