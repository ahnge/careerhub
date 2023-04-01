# Careerhub - CS50 Final Project

## Description

Careerhub is a job portal web application developed using Laravel framework. The project is hosted on AWS EC2 instance with LAMP stack and MySQL server. The project also includes Amazon S3 bucket for storing images and resumes. The application allows users to create two types of accounts (employer and job_seeker). Employers can create job postings and job_seekers can apply to the job postings. Employers can see job_seekers who apply to their job postings.

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
