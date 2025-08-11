# URL Shortener App

A simple and elegant URL shortening application built with **Laravel**. This app allows users to convert long URLs into short, shareable links and ensures redirection back to the original URL when accessed.

---

##  Features

- **User Input**: Enter a long URL and receive a short code.
- **Redirection**: Visiting the short URL redirects to the original destination.
- **Minimalist Frontend**: Clean UI powered by Blade templates.

---

##  Tech Stack

- **Backend**: PHP 8+, Laravel 11
- **Frontend**: Blade Templates  
- **Database**: MySQL (via Laravel’s database configuration)

---

##  Routes

| Method | URI          | Action                             |
|--------|--------------|-------------------------------------|
| GET    | `/`          | Show form to submit a long URL      |
| POST   | `/shorten`   | Save the original URL, generate a shortcode |
| GET    | `/{shortcode}` | Redirect to the original URL         |

---

##  Database Schema

Your `urls` table should include:

| Column        | Type       | Description                  |
|---------------|------------|------------------------------|
| `original_url` | TEXT       | The input long URL           |
| `short_code`   | STRING     | Shortened unique code        |
| `created_at`   | TIMESTAMP  | Record creation timestamp    |
| `updated_at`   | TIMESTAMP  | Record update timestamp      |

---

##  Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/ashishharsoda791/URL-Shortener-App.git
   cd URL-Shortener-App
