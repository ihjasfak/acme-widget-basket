# 🛒 Acme Widget Basket

This is a proof-of-concept e-commerce cart system for **Acme Widget Co.** built using PHP, MySQL, JavaScript, and Bootstrap. It demonstrates dynamic product catalog loading, offer handling (including buy-one-get-one and percentage discounts), and delivery charge calculation based on configurable rules.

## 🚀 Features

- ✅ Dynamic product catalog from MySQL
- 🎁 Supports multiple discount types:
  - Buy One Get Second at Half Price (BOGO 50%)
  - Percentage-based discounts (e.g., 10% off for 3+ items)
- 🚚 Delivery charge calculation using tiered rules
- 🧠 Persistent cart using `localStorage`
- 💡 Clean UI with Bootstrap
- 📦 Modular and scalable architecture

## 🛠 Tech Stack

- **Backend:** PHP (REST-like API)
- **Frontend:** Vanilla JavaScript + Bootstrap
- **Database:** MySQL
- **State Management:** `localStorage`

## 📂 Project Structure

```
acme-widget-basket/
│
├── db/
│   └── schema.sql              # SQL script for DB setup
├── public/
│   └── api.php                 # Backend API entry point
│   └── cart.js                 # Logics for cart
│   └── index.php               # Frontend entry point
├── src
│   └── Models
│       └── DeliveryRule.php    # CRUD functions for Delivery Charge Rules
|       └── Offer.php           # CRUD functions for Offers
|       └── Product.php         # CRUD functions for Product Catalog
├── Database.php                # DB Instance
├── tests                       # Unit tests
│   └── DeliveryRuleTest.php
|   └── OfferTest.php
|   └── ProductTest.php
├── composer.json              
└── README.md                   # This file
```

## ⚙️ Setup Instructions

### 1. Clone the Repository

git clone `https://github.com/ihjasfak/acme-widget-basket.git`
cd acme-widget-basket

### 2. Import the Database

Create a database (e.g., `acme_basket`) and import the schema:
mysql -u your_user -p acme_basket < db/schema.sql

### 3. Run the App

Use PHP's built-in server:
php -S localhost:8000

Access the app at: `http://localhost:8000`


## 📦 Example Offers Supported

### ✅ Buy One, Get Second at Half Price (BOGO 50%)

{
  "type": "bogo",
  "product_id": 1,
  "min_quantity": 1,
  "discount_type": "percentage",
  "discount_value": "50.00",
  "description": "Buy one get half second"
}


### ✅ Percent Discount on Minimum Quantity

{
  "type": "percentage",
  "product_id": 2,
  "min_quantity": 10,
  "discount_type": "percentage",
  "discount_value": "25.00",
  "description": "25% discount on selected item"
}


## 📬 Delivery Rules Example

Delivery charges are based on total cart value:

| Min Amount | Max Amount | Delivery Cost |
| ---------- | ---------- | ------------- |
| 0          | 50         | \$4.95        |
| 50         | 90         | \$2.95        |
| 90+        | ∞          | Free          |


## 🧪 Assumptions

* Cart is stored client-side using `localStorage`
* Offers are mutually independent and can stack
* All products are uniquely identified by either `product_id` or `product_code`
* Delivery rules are fetched from the backend


## 📌 Future Improvements

* Backend offer validation for extra safety
* Auth and user sessions
* Admin panel for managing products and offers
* Checkout with payment gateway


> Built with ❤️ for the Acme Widget Co. by [@ihjasfak](https://github.com/ihjasfak)
