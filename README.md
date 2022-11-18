# Laravel Job finder Website

## The functionality of the website:
The user can register as an employee and as an emlpoyer as well, log in and change the password. https://prnt.sc/-uf5fSw3Xspt  

### For employee  
Main page: 
The list of vacancies is available only if the user has filled in the phone number, cover letter and uploaded a resume.  
Also, the list of vacancies has pagination.  
Each vacancy has a detailed page where every user can apply. After applying, the vacancy appears on the main page in the section "Your applications".  
https://prnt.sc/lcvTm0Q359nv  
https://prnt.sc/TGm_sdyuXinS  

Profile editing - validations added:  
for text - from 100 to 5000 characters,  
for CV - PDF format and size up to 10Mb.  
There are multiple additions of user skills also. These skills are supposed to sort vacancies for a specific user on the main page.  
https://prnt.sc/W-cCNL_NdGbo  
https://prnt.sc/YU_4YChtbyhg  

### For employer   
The employer can create a new jobs,  
Track the employee's applications, approve or decline them with feedback comment.  
Buttons available for employer to accept or decline application from user https://prnt.sc/jAF9iyPNkV7m  
He can write a comment https://prnt.sc/lxeJ4kLuurYO  
Also i added the application status to the employee dashboard https://prnt.sc/IPpI5CP3rP18  
And notification functionality to notify user, if some from his application was getting a feedback https://prnt.sc/kLAo8PsQganb

Main page: 
https://prnt.sc/pcbM5oyPQQhE  

Profile:  
https://prnt.sc/Sku8TsUkBsgf  
https://prnt.sc/1KkOc4AsDnkS
The company name in the vacancies shows from employer profile who did create it.

Adding a new job. It is possible to specify the Title, salary, job description, and select the necessary skills.  
https://prnt.sc/9pNrbVswQdzO  
https://prnt.sc/UzQNMBs7HqPR

Also possible to edit and delete it https://prnt.sc/z7zUvnHqu2m5
___

- A factories and DB seeder has been developed to generate users with skills and jobs:  
php artisan db:seed
- To download the CV, I created a symbolic link to the storage/app/public/profile folder.  
- When job is deleting, related entities (job skills, applications) also deleting.  

Controllers - app/Http/Controllers  
Models - app/Models  
Policies (for protect creating jobs from non-employer users) - app/Policies
Factories - database/factories
Migrations - database/migrations  
Routing - routes/web.php  
