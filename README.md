# Careerhub - CS50 Final Project

#### Video Demo: <https://youtu.be/TrrCWuIUeb8>

#### Description:

Careerhub is a job portal web application developed using the Laravel framework as a final project for the CS50 course. The application allows employers to create job postings and job seekers to apply to those postings. The project also includes an Amazon S3 bucket for storing images and resumes.

The application is hosted on an AWS EC2 instance with LAMP stack and MySQL server, providing a robust and scalable infrastructure for managing large numbers of job postings and job seekers. The project uses the Model-View-Controller (MVC) architecture to separate concerns and ensure maintainability and scalability.

Careerhub includes two types of accounts: employer and job_seeker. Employers can create job postings, which include the job title, description, and requirements. Job_seekers can apply to job postings by submitting their resume and a brief cover letter.

Employers can view the list of job_seekers who have applied to their job postings and can communicate with them.

The project leverages the power of the Laravel framework, which provides a rich set of features and tools for web application development. It includes robust validation rules, an authentication system, and a flexible database migration system.

In conclusion, Careerhub is a sophisticated job portal web application that provides an intuitive and user-friendly interface for employers and job seekers. It leverages the power of Laravel and AWS infrastructure to provide a scalable and robust platform for managing job postings and applications.

## Features

-   User registration and authentication system for employer and job_seeker
-   Employers can create, edit and delete job postings
-   Job_seekers can search and apply to the job postings
-   Employers can see the list of job_seekers who applied for their job postings

## Technology Stack

-   Laravel Framework
-   LAMP stack on AWS EC2 instance
-   MySQL server
-   Amazon S3 bucket for storing images and resumes

## [VIDEO DEMO](https://youtu.be/TrrCWuIUeb8)

## Requirements

-   PHP 7.3 or higher
-   MySQL
-   Composer

## Installation

1.  Clone the repository to your local machine using `git clone https://github.com/ahnge/careerhub.git`
2.  Change to the project directory using `cd careerhub`
3.  Run `composer install` to install the project dependencies
4.  Create a `.env` file by copying the `.env.example` file using the command `cp .env.example .env`
5.  Set up the database connection in the `.env` file
6.  Run `php artisan migrate` to create the database tables
7.  Set up the Amazon S3 bucket credentials in the `.env` file
8.  Run the application using `php artisan serve`

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)
