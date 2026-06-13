# Eventify - Event Management Platform

Eventify is a Laravel-based event management platform designed to streamline the complete event lifecycle, from event planning and attendee registration to ticket sales, check-in, networking, and post-event analytics.

This project is being built as a portfolio-grade backend application to demonstrate modern Laravel architecture, scalable API design, clean code principles, and real-world software engineering practices.

---

## Project Goal

The goal of Eventify is to provide event organizers with a centralized platform to:

* Create and manage events
* Sell tickets online
* Process secure payments
* Manage speakers and vendors
* Track attendee registrations
* Perform event check-ins
* Collect feedback and analytics
* Automate notifications and reminders

The project focuses heavily on backend engineering concepts such as dependency injection, service containers, contracts, service providers, event-driven architecture, queues, caching, and API development.

---

## Core Features

### Authentication & Authorization

* User registration
* Login & logout
* Password reset
* Email verification
* Role-based access control
* API authentication using Laravel Sanctum

Roles:

* Super Admin
* Event Organizer
* Attendee
* Vendor
* Speaker

---

### Event Management

Organizers can:

* Create events
* Update events
* Publish events
* Cancel events
* Set event capacity
* Define target audience
* Configure event goals and themes

Event details include:

* Title
* Description
* Event goal
* Theme
* Event format
* Event location
* Start and end dates
* Capacity

---

### Venue Management

Supports:

* Physical Events
* Virtual Events
* Hybrid Events

Venue information:

* Venue name
* Address
* Capacity
* Contact information

---

### Speaker Management

Features:

* Speaker profiles
* Speaker biographies
* Profile photo upload
* Social media links
* Session assignments

---

### Agenda & Session Management

Organizers can:

* Create event agendas
* Create multiple sessions
* Assign speakers
* Set session capacity
* Manage session schedules

Examples:

* Keynote Sessions
* Workshops
* Breakout Sessions
* Networking Sessions

---

### Registration & Ticketing

Attendees can:

* Register for events
* Select ticket packages
* Receive confirmation
* Download event tickets

Ticket Types:

* Free
* Early Bird
* Standard
* VIP
* Premium

Ticket Features:

* QR Codes
* Unique Ticket Numbers
* PDF Ticket Generation

---

### Payment Processing

Supported Gateways:

* Paystack
* Flutterwave
* Stripe

Features:

* Payment initialization
* Payment verification
* Refund support
* Webhook processing

---

### Event Check-In

Features:

* QR Code scanning
* Manual attendee check-in
* Attendance tracking
* Check-in analytics

---

### Vendor & Exhibitor Management

Vendor Features:

* Vendor registration
* Company profile management
* Booth applications
* Lead tracking

Vendor Information:

* Business name
* Contact details
* Industry
* Website
* Business description

---

### Networking & Appointments

Features:

* Attendee profiles
* Vendor profiles
* Speaker profiles
* Appointment scheduling
* Business networking

---

### Polls & Live Engagement

Features:

* Live session polls
* Audience questions
* Session voting
* Real-time engagement

---

### Notifications

Channels:

* Email
* SMS
* In-App Notifications

Notification Events:

* Registration confirmation
* Payment confirmation
* Event reminders
* Session reminders
* Check-in notifications

---

### Feedback & Surveys

Collect:

* Event ratings
* Session feedback
* Vendor feedback
* Suggestions and comments

---

### Analytics Dashboard

Track:

* Ticket sales
* Event revenue
* Attendance rates
* Registration trends
* Check-in statistics
* Vendor engagement
* Feedback scores

---

## Technical Architecture

The application follows a service-oriented architecture using Laravel best practices.

### Controllers

Controllers remain thin and delegate business logic to service classes.

Examples:

```php
EventController
RegistrationController
PaymentController
VendorController
```

### Services

Business logic is handled inside services.

```php
EventService
RegistrationService
PaymentService
TicketService
CheckInService
NotificationService
AnalyticsService
VendorService
```

### Contracts (Interfaces)

Abstractions are defined through contracts.

```php
PaymentGatewayInterface
TicketGeneratorInterface
NotificationInterface
AnalyticsInterface
```

### Service Providers

Dependencies are registered using Laravel's service container.

```php
$this->app->bind(
    PaymentGatewayInterface::class,
    PaystackPaymentService::class
);
```

### Dependency Injection

Services are injected into controllers through constructor injection.

```php
public function __construct(
    private EventService $eventService
) {}
```

---

## Event-Driven Architecture

The application leverages Laravel Events and Listeners.

Events:

```php
RegistrationCompleted
PaymentSuccessful
TicketGenerated
AttendeeCheckedIn
```

Listeners:

```php
SendConfirmationEmail
GenerateTicket
UpdateAnalytics
```

---

## Queue System

Background jobs will be used for:

* Email delivery
* Ticket generation
* Notifications
* Analytics processing

Technologies:

```php
Laravel Queues
Redis
```

---

## Caching Strategy

Caching is used for:

* Dashboard metrics
* Event listings
* Ticket statistics
* Analytics summaries

Examples:

```php
Cache::remember()
Cache::tags()
```

---

## Security Features

* CSRF protection
* Password hashing
* API token authentication
* Email verification
* Authorization policies
* Request validation
* Rate limiting
* Secure payment verification

---

## API Design

The application follows RESTful API principles.

Example Endpoints:

```http
POST   /api/auth/register
POST   /api/auth/login

GET    /api/events
POST   /api/events
GET    /api/events/{id}
PUT    /api/events/{id}

POST   /api/registrations
POST   /api/payments/initialize
POST   /api/checkins
```

---

## Database Design

Main Entities:

```text
users
roles
permissions

events
venues
sessions
speakers

tickets
registrations
payments

vendors
booths

appointments
check_ins

feedback

notifications
activity_logs
```

Relationships:

```text
User -> Event
Event -> Sessions
Event -> Tickets
Event -> Registrations
Event -> Speakers
Vendor -> Booths
Registration -> Payment
Registration -> Ticket
```

---

## Future Enhancements

Planned improvements:

* Multi-tenancy support
* Event sponsorship management
* Coupon and discount engine
* Waitlists for sold-out events
* Mobile application
* Real-time chat
* Event live streaming
* AI-powered attendee recommendations
* Advanced reporting exports
* Public GraphQL API

---

## Testing

Testing strategy includes:

### Unit Tests

* Services
* Repositories
* Business rules

### Feature Tests

* Authentication
* Registration
* Payments
* Check-ins

### API Tests

* Endpoint validation
* Authorization
* Response structures

Goal:

```bash
80%+ test coverage
```

Run tests:

```bash
php artisan test
```

---

## Tech Stack

Backend:

* PHP 8+
* Laravel 12
* MySQL

Authentication:

* Laravel Sanctum

Authorization:

* Spatie Laravel Permission

Caching:

* Redis

Queues:

* Redis Queue

File Storage:

* Laravel Storage

Payments:

* Paystack
* Flutterwave
* Stripe

Testing:

* PHPUnit
* Pest

Documentation:

* Swagger / OpenAPI

---

## Learning Objectives

This project is primarily designed to strengthen practical backend engineering skills by implementing:

* Service Container
* Dependency Injection
* Service Providers
* Contracts & Interfaces
* Event-Driven Development
* Queues & Jobs
* API Development
* Payment Integrations
* Authorization & Security
* Testing Strategies
* Scalable Laravel Architecture

---

## License

This project is open-source and available under the MIT License.

## 👨‍💻 Author

**Olawale Olayinka**
Backend Developer (Laravel & PHP)
