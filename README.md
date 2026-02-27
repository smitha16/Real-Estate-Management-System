# Real Estate Management System

A web-based real estate platform built with PHP and MySQL that connects property sellers and buyers. Sellers can list properties for sale or rent, while buyers can search, filter, cart, and purchase properties, all through a clean session-based interface.

![Language](https://img.shields.io/badge/language-PHP-purple) ![Database](https://img.shields.io/badge/database-MySQL-blue) ![Frontend](https://img.shields.io/badge/frontend-HTML%20%2F%20CSS-orange) ![Server](https://img.shields.io/badge/server-Apache%20%2F%20XAMPP-red)

---

## Features

### 👤 Authentication
- User registration (Sign Up) with name, username, password, email, and phone
- Login with role selection — **Seller** or **Buyer**
- Session-based authentication with protected routes
- Logout functionality

### 🏡 Seller
- Add new property listings with full details (type, contract, location, price, area)
- View all personal property listings
- Edit and update existing property details
- Delete property listings

### 🔍 Buyer
- Search and filter properties by:
  - Property type (Land / Residential / Commercial)
  - Contract type (For Sale / Lease/Rent)
  - City and pincode
  - Max carpet area (sq. ft.)
  - Max price (₹)
- Add properties to a **shopping cart**
- Remove items from cart
- Complete purchase — generates a unique billing ID on confirmation
- View purchase history

---

## Project Structure

```
Project-files/
├── index.php           # Login page
├── signup.php          # User registration
├── Lvalidation.php     # Login authentication & session handling
├── logout.php          # Session destroy & logout
│
├── sellerpage.php      # Seller dashboard
├── estateform.php      # Add new property form
├── viewestate.php      # View seller's own listings
├── estateedit.php      # Edit property form
├── estateupdate.php    # Process property update
├── deleteestate.php    # Delete a property
│
├── buyerpage.php       # Buyer dashboard — property search
├── buyerupdate.php     # Process search and display results
├── cart.php            # View shopping cart
├── indexcart.php       # Add property to cart
├── removecart.php      # Remove property from cart
├── billing.php         # Confirm purchase & generate billing ID
├── finalpurchase.php   # Purchase confirmation handler
├── modifyform.php      # Modify buyer search/form
│
├── stylelogin.css      # Global stylesheet
└── *.jpg               # Background images (Pexels)
```

---

## Database Schema

The application uses a MySQL database named `real_estate`. You'll need the following tables:

### `user`
| Column     | Type         | Description          |
|------------|--------------|----------------------|
| `name`     | VARCHAR      | Full name            |
| `username` | VARCHAR (PK) | Unique username      |
| `password` | VARCHAR      | User password        |
| `email`    | VARCHAR      | Email address        |
| `phone`    | VARCHAR      | 10-digit phone       |

### `estate`
| Column       | Type         | Description                     |
|--------------|--------------|---------------------------------|
| `estate_id`  | INT (PK, AI) | Unique property ID              |
| `username`   | VARCHAR (FK) | Seller's username               |
| `type`       | VARCHAR      | Land / Residential / Commercial |
| `contract`   | VARCHAR      | Sale / Lease                    |
| `city`       | VARCHAR      | City                            |
| `pincode`    | VARCHAR      | Area pincode                    |
| `sq`         | INT          | Carpet area in sq. ft.          |
| `price`      | BIGINT       | Price in ₹                      |

### `purchase`
| Column       | Type    | Description              |
|--------------|---------|--------------------------|
| `billing_id` | VARCHAR | Zero-padded billing ID   |
| `estate_id`  | INT     | Purchased property ID    |
| `buyername`  | VARCHAR | Buyer's username         |

---

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)
- PHP 7.x or higher
- A modern web browser

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/real-estate-management-system.git
   ```

2. **Move files to your server root**
   ```bash
   # For XAMPP on Windows:
   cp -r Project-files/ C:/xampp/htdocs/real-estate/

   # For XAMPP on Linux/Mac:
   cp -r Project-files/ /opt/lampp/htdocs/real-estate/
   ```

3. **Set up the database**
   - Start Apache and MySQL from the XAMPP Control Panel
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database named `real_estate`
   - Create the three tables using the schema above, or import an SQL dump if available

4. **Configure the database connection**
   - The connection credentials are hardcoded in each PHP file. Default values:
     ```php
     $servername = "localhost";
     $username   = "root";
     $password   = "";
     $dbname     = "real_estate";
     ```
   - Update these if your MySQL setup uses different credentials.

5. **Run the application**
   - Open your browser and navigate to: [http://localhost/real-estate/index.php](http://localhost/real-estate/index.php)

---

## Usage

1. **Sign up** for a new account at `signup.php`
2. **Log in** and select your role — Seller or Buyer
3. **Sellers** can add, view, edit, and delete property listings from their dashboard
4. **Buyers** can search for properties using filters, add them to a cart, and complete a purchase
5. A **billing ID** is generated upon purchase confirmation

---

## Tech Stack

| Layer     | Technology         |
|-----------|--------------------|
| Frontend  | HTML, CSS          |
| Backend   | PHP (procedural)   |
| Database  | MySQL (via MySQLi) |
| Server    | Apache (XAMPP)     | 

---
