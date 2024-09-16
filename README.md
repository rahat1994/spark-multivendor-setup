<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About this project

This project completely relies on 4 packages

1. [sparkcommerce](https://github.com/rahat1994/sparkCommerce).
   
    This is the core of the project and every-other packages extends on its functinalities. It only has basic shop setup functionality with authentication.
2. [sparkcommerce-multivendor](https://github.com/rahat1994/sparkCommerce-multivendor)

    This package adds multivendor capabilities to the sparkcommerce package.
3. [sparkcommerce-rest-routes](https://github.com/rahat1994/sparkCommerce-rest-routes)

    Not every application needs REST api capabilities but those who does this package adds restapi capbilities to sparkcommerce package. Available rest routes are mentioned later in this page.
4. [sparkcommerce-multivendor-rest-routes](https://github.com/rahat1994/sparkCommerce-multivendor-rest-routes)

    It extends on the 3rd package and adds its own rest routes.


## Setup Process
1. `git clone`
2. `composer install`
3. create `.env` file from `.env.example`
4. generate APP KEY by `php artisan key:generate`
5. paste the DB credentials
6. `php artisan migrate`
7. run the `sparkcommerce` commands (Not needed for this project)
8. run the `scmv` commands
    * publish User roles using `php artisan scmv:publish-roles`
    * create first admin user `php artisan make:scmv-admin-user`
    * create first vendor owner user `php artisan make:scmv-vendor-owner-user`
9. serve the app using `php artisan serve`
10. for vendor dashboard visit http://127.0.0.1:8000/vendor/login
11. for admin dashboard visit http://127.0.0.1:8000/backoffice/login

## Features

### SparkCommerce
- [x] DashBoard
- [x] Product CRUD
- [x] Tags CRUD
- [x] Categories CRUD
- [x] Orders
- [x] Coupons CRUD 
- [x] Checkout
- [ ] Using Sale price during checkout
- [ ] Use coupons during checkout
- [ ] Anlytics
- [ ] Export/Import products
- [ ] Export/Import Orders
- [ ] Export/Import Categories
- [ ] Export/Import Tags

### SparkCommerce Multivendor
- [x] Vendor CRUD
- [x] Advertisement CRUD
- [x] Shop Categories CRUD
- [x] Support ticket CRUD
- [ ] Vendor Request
- [ ] Payout Request
- [ ] Deactivating vendor
- [ ] Conflict resolution

### REST APIS available

Here’s a list of all the endpoints along with the required parameters.

`base_url` is the url of the application.

# API Endpoints

## Auth

### 1. Login
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/login`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "email": "the-email@example.com",
    "password": "the-password-of-choice",
    "device_name": "Iphone15pro"
}
```

### 2. Register
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/register`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "name": "Rahat",
    "email": "rahat92@gmail.com",
    "password": "The-password-of-choice-5",
    "device_name": "Iphone15pro"
}
```

### 3. Forgot Password
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/forgot-password`  
**Body (JSON):**
```json
{
    "email": "rahat392@gmail.com"
}
```

### 4. Reset Password
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/reset-password`  
**Body (JSON):**
```json
{
    "token": "token",
    "email": "rahat392@gmail.com",
    "password": "new-password",
    "password_confirmation": "new-password"
}
```

### 5. Me
**Method:** `GET`  
**URL:** `{{base_url}}/sc/v1/me`  
**Headers:**  
- Accept: application/json

### 6. Confirm Password
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/confirm-password`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "password": "The-password-of-choice-5"
}
```

### 7. Update Profile
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/update-profile`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "name": "Rahat Baksh"
}
```

### 8. Logout
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/logout`  
**Headers:**  
- Accept: application/json

### 9. Change Password
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/update-password`

---

## Post Code

### 10. Post Code List
**Method:** `GET`  
**URL:** `https://api.postcodes.io/postcodes?q=GU5`

---

## Shop Category

### 11. List Shop Categories
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/shop_categories`  
**Headers:**  
- Accept: application/json

---

## Landing Page

### 12. Top Vendors
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/top_vendors`

### 13. Landing Page Advertisements
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/advertisements`

### 14. Weekly Best Selling Items
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/weekly_best_selling_items`

### 15. Newsletter Subscription
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/newsletter_subscription`

### 16. Product Recommendation
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/product_recomedation/5`

### 17. Global Search
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/search/chicken`

---

## Vendor

### 18. Get Vendor
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/vendor/panshi`

### 19. Vendor Categories
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/vendor/didar-store/categories`

### 20. Vendor Products
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/vendor/unimart/products?categories=chicken-breast-fillets`

### 21. Search Products
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/vendor/didar-store/search/dorian-ferrell`

### 22. All Vendors
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/vendor/search/pult`

---

## Cart

### 23. Add Product to Cart
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/cart`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "slug": "polo-t-shirt",
    "quantity": 16,
    "replace_existing": false
}
```

### 24. Bulk Add Product to Cart
**Method:** `POST`  
**URL:** `{{base_url}}/scmv/v1/bulk_product_add`  
**Body (JSON):**
```json
[
    {
        "slug": "tanek-schwartz-2",
        "quantity": 5
    }
]
```

### 25. Get Current Cart
**Method:** `GET`  
**URL:** `{{base_url}}/sc/v1/cart`

### 26. Remove Product from Cart
**Method:** `DELETE`  
**URL:** `{{base_url}}/sc/v1/cart/polo-t-shirt`  
**Headers:**  
- Accept: application/json

### 27. Clear Current Cart
**Method:** `DELETE`  
**URL:** `{{base_url}}/sc/v1/cart/clear_all`

### 28. Associate Anonymous Cart
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/associate_anonymous_cart`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "reference": "mb"
}
```

### 29. Validate Coupon
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/validate-coupon`  
**Body (JSON):**
```json
{
    "coupon_code": "rahat100"
}
```

---

## Product

### 30. Single Product (Not Multivendor)
**Method:** `GET`  
**URL:** `{{base_url}}/sc/v1/product/dorian-ferrell`

### 31. All Products (Not Multivendor)
**Method:** `GET`  
**URL:** `{{base_url}}/sc/v1/products?page=1`

### 32. Product by Category (Not Multivendor)
**Method:** `GET`  
**URL:** `{{base_url}}/sc/v1/products/`

---

## Order

### 33. Checkout
**Method:** `POST`  
**URL:** `{{base_url}}/sc/v1/checkout`  
**Headers:**  
- Accept: application/json  
**Body (JSON):**
```json
{
    "items": [
        {
            "slug": "hard-chicken-1kg",
            "quantity": 15
        },
        {
            "slug": "swordfish-supremes-153-207g",
            "quantity": 10
        }
    ],
    "shipping_address": "31st Baksh Monjil",
    "billing_address": "31st Baksh Monjil",
    "shipping_method": "in-person",
    "total_amount": "50",
    "discount": "",
    "payment_method": "cash",
    "transaction_id": "cash"
}
```

### 34. Orders
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/orders`  
**Headers:**  
- Accept: application/json

### 35. Single Order
**Method:** `GET`  
**URL:** `{{base_url}}/scmv/v1/orders/IboDycFlGI`

