# Laravel Job finder Website

## The functionality of the website:
The user can register as an employee and as a emlpoyer as well, log in, and change the password. https://prnt.sc/-uf5fSw3Xspt  

### For employee  
Main page: 
The list of vacancies is available only if the user has filled in the phone number and cover letter and uploaded a resume.  
Also, the list of vacancies has pagination.  
Each vacancy has a detailed page where user can apply. After applying, the vacancy appears on the main page in the section "Your applications".  
https://prnt.sc/lcvTm0Q359nv  
https://prnt.sc/TGm_sdyuXinS  

Profile editing - validations added:  
for text - from 100 to 5000 characters,  
for CV - PDF format and size up to 10Mb.  
There are also multiple additions of user skills. These skills are supposed to sort vacancies for a specific user on the main page.  
https://prnt.sc/W-cCNL_NdGbo  
https://prnt.sc/YU_4YChtbyhg  

### For employers:  
The employer can create a new jobs,  
Track the employee's applications, approve or decline them with feedback comment. (In progress)  

Main page: 
https://prnt.sc/pcbM5oyPQQhE  

Profile:  
https://prnt.sc/Sku8TsUkBsgf  
https://prnt.sc/1KkOc4AsDnkS
The company name in the vacancies shows from employer profile who create it.

Adding a new job. It is possible to specify the Title, salary, job description, and select the necessary skills.  
https://prnt.sc/9pNrbVswQdzO  
https://prnt.sc/UzQNMBs7HqPR

___

A factories and DB seeder has been developed to generate users with skills and jobs:  
php artisan db:seed

To download the CV, I created a symbolic link to the storage/app/public/profile folder  
Controllers - app/Http/Controllers  
Models - app/Models  
Policies (for protect creating jobs from non-employer users) - app/Policies
Factories - database/factories
Migrations - database/migrations  
Routing - routes/web.php  
