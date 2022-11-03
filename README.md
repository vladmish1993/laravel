The functionality of the website:
- the user can register, log in, and change the password.
Main page: 
- the list of vacancies is available only if the user has filled in the phone number and cover letter and uploaded a resume. Also, the list of vacancies has pagination.
Each vacancy has a detailed page where you can apply. After applying, the vacancy appears on the main page in the section "Your applications".
Profile editing - validations added, for text - from 100 to 5000 characters, for resume - PDF format and size up to 10Mb.
There are also multiple additions of user skills. These skills are supposed to sort vacancies for a specific user (not implemented at the moment).
The user with the email address admin@admin.com (specified in the .env file) is the admin by default and has an additional button in the personal account - "add a vacancy".
/job/create - adding a new job. It is possible to specify the Title, Company name, salary, and job description and select the necessary skills.
A factory has been developed to generate vacancies:
php artisan tinker
\App\Models\Job::factory()->create();
The method will create a vacancy with all fields filled in.

To download the CV, I created a symbolic link to the storage/app/public/profile folder
Controllers - app/Http/Controllers
Models - app/Models
Migrations - database/migrations
Routing - routes/web.php
