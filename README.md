# Laravel 11 Contact Form Package

This project is a custom Laravel 11 package that provides a **Contact Form** feature with user & admin roles, form submission storage, queued email notifications, and admin dashboard for managing submissions.  

---

## **📦 Features**

- Contact form with fields: `name`, `email`, `subject`, `message`
- JWT Authentication for API routes
- User roles: `admin` and `user`
- Form submission storage in database
- Queued email notifications to admin
- Admin dashboard to view & filter submissions
- Users can view their own submissions via API

---

## **🛠 Requirements**

- PHP >= 8.2
- MySQL or compatible database
- Composer
- Laravel 11
- Postman (recommended for API testing)

---

## **⚡ Installation & Setup**

1. **Clone the repository**
   ```bash
   git clone https://github.com/Manojk-1989/contact-form.git
   cd contact-form

2. Install dependencies

composer install


3. Copy .env file

cp .env.example .env


4. Set up database
Edit .env and configure:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contact_form
DB_USERNAME=root
DB_PASSWORD=


5. Generate app key

php artisan key:generate


6. Generate JWT secret

php artisan jwt:secret


7. Run migrations

php artisan migrate


8. Seed admin & normal user (optional)

php artisan tinker


Inside tinker:

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::updateOrCreate(
    ['email' => 'admin@example.com'],
    ['name' => 'Admin User', 'password' => Hash::make('password'), 'role' => 'admin']
);

$user = User::updateOrCreate(
    ['email' => 'user@example.com'],
    ['name' => 'Normal User', 'password' => Hash::make('password'), 'role' => 'user']
);

$adminToken = auth('api')->login($admin);
$userToken = auth('api')->login($user);

$adminToken; // copy for Postman
$userToken;  // copy for Postman


9. Start Laravel server

php artisan serve


Visit: http://127.0.0.1:8000

🚀 Testing APIs with Postman
1. Submit Contact Form (User)

URL: POST http://127.0.0.1:8000/api/contact/submit

Headers:

Authorization: Bearer <userToken>
Accept: application/json
Content-Type: application/json


Body (raw JSON):

{
  "name": "John Doe",
  "email": "john@example.com",
  "subject": "Test",
  "message": "This is a test message."
}


Response:

{
  "message": "Submitted successfully"
}

2. View My Submissions (User)

URL: GET http://127.0.0.1:8000/api/contact/my-submissions

Headers:

Authorization: Bearer <userToken>
Accept: application/json


Response: List of submissions by the authenticated user.

3. Admin Dashboard: View All Submissions

URL: GET http://127.0.0.1:8000/admin/contact-submissions

Headers:

Authorization: Bearer <adminToken>
Accept: application/json


Optional Query Params:

user_id – filter by user

date – filter by submission date (YYYY-MM-DD)

Response: Paginated list of all submissions with user info.

⚙️ Queued Email Notifications

Make sure to configure mail in .env:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<username>
MAIL_PASSWORD=<password>
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="ContactForm"


Email is queued when a user submits the form.

Run the queue worker to process emails:

php artisan queue:work
