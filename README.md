# 🎫 Event Management & Ticketing API (Laravel)

A production-style **Event Management and Ticketing System REST API** built with **Laravel (PHP), MySQL, and Eloquent ORM**.

This project demonstrates how to build a **real-world, scalable backend system** using Laravel best practices, including:

* Authentication & Authorization (Laravel Sanctum / JWT)
* Role-based access control (Admin & User)
* Event management
* Ticket purchasing with inventory control
* Payment gateway integration (Paystack / Stripe / Flutterwave ready)
* Email notifications
* Advanced API features (filtering, sorting, pagination)
* Centralized error handling
* Clean architecture (Controllers, Services, Requests, Policies)

> This project is built as a portfolio project to demonstrate **backend engineering skills, real-world API design, and Laravel architecture best practices**.

---

## 🚀 Features

### 👤 Authentication & Authorization

* User registration & login
* Token-based authentication (Laravel Sanctum or JWT)
* Role-based access control (Admin / User)
* Protected API routes
* Email verification (optional)

---

### 🎫 Event Management (Admin)

* Create events
* Update events
* Delete events
* Activate / close events
* Set ticket price, capacity, and event date
* Upload event banners/images (optional)

---

### 🛒 Ticket Booking (Users)

* Browse available events
* Buy tickets for events
* Prevent overbooking using ticket inventory control
* View own tickets
* Cancel tickets (if allowed)
* Receive email confirmation after purchase

---

### 💳 Payment Integration

* Payment initialization endpoint
* Payment verification webhook
* Supports:

  * Paystack
  * Flutterwave
  * Stripe (optional)
* Tickets are only marked as **paid** after successful payment verification

---

### 🧠 Business Logic

* Tickets can only be purchased if:

  * Event is active
  * Tickets are still available
* Ticket purchase:

  * Locks ticket stock (to prevent race conditions)
  * Creates a pending ticket record
  * Initializes payment
  * On payment success:

    * Marks ticket as paid
    * Reduces available ticket count
    * Sends confirmation email
* Admin can:

  * View all ticket sales
  * Manage users
  * Close events

---

### ⚙️ Advanced API Features

* Filtering
* Sorting
* Pagination
* Field limiting

Example:

```
GET /api/events?price[lte]=5000&sort=price,date&page=1&limit=10&fields=title,price,date
```

---

## 🏗️ Tech Stack

* Laravel 10/11+
* PHP 8.2+
* MySQL / PostgreSQL
* Eloquent ORM
* Laravel Sanctum or JWT
* Laravel Queues (for emails & background jobs)
* Laravel Notifications & Mail
* Redis (optional)
* Payment Gateways (Paystack / Flutterwave / Stripe)

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   ├── Middleware/
│   └── Resources/
├── Models/
├── Services/
├── Policies/
├── Notifications/
├── Mail/
├── Jobs/
routes/
├── api.php
database/
├── migrations/
├── seeders/
```

---

## 📚 Data Models

### User

* id
* name
* email
* password
* role (admin | user)
* is_active
* email_verified_at

---

### Event

* id
* title
* description
* location
* date
* price
* capacity
* tickets_available
* status (draft | active | closed)

---

### Ticket

* id
* user_id
* event_id
* quantity
* total_price
* status (pending | paid | cancelled)
* payment_reference

---

### Payment (Optional Table)

* id
* user_id
* ticket_id
* amount
* gateway
* status
* reference
* payload

---

## 🔐 API Endpoints

### Auth

```
POST /api/auth/register
POST /api/auth/login
GET  /api/auth/me
POST /api/auth/logout
```

---

### Events

```
POST   /api/events            (Admin)
PATCH  /api/events/{id}       (Admin)
DELETE /api/events/{id}       (Admin)

GET    /api/events            (Public)
GET    /api/events/{id}       (Public)
```

---

### Tickets

```
POST /api/tickets             (User)
GET  /api/tickets/me          (User)
GET  /api/tickets             (Admin)
PATCH /api/tickets/{id}/cancel
```

---

### Payments

```
POST /api/payments/initialize
POST /api/payments/verify
POST /api/webhooks/paystack   (or flutterwave)
```

---

### Users (Admin)

```
GET   /api/users
PATCH /api/users/{id}/deactivate
```

---

## 🛡️ Security Features

* Laravel Policies for authorization
* Form Request validation
* Rate limiting
* SQL injection protection via Eloquent
* Password hashing
* Secure payment verification via webhooks

---

## 📧 Email Features

* Registration welcome email
* Ticket purchase confirmation email
* Payment success receipt
* Event cancellation notification (optional)

---

## 🧪 What This Project Demonstrates

* Real-world Laravel backend architecture
* Clean separation of concerns (Controller, Service, Policy)
* Secure authentication & authorization
* Complex business logic implementation
* Payment system integration
* Scalable API patterns
* Professional backend engineering practices

---

## 👨‍💻 Author

**Olawale Olayinka**
Backend Developer (Laravel & PHP)


