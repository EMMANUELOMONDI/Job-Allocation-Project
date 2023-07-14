# Job Application website with a Resume Scanner

This project is a Job Application website built with Laravel that includes a Resume Scanner component developed in Python. The website aims to streamline the job application process by automatically scanning and analyzing resumes to extract relevant information and show the similarity between the candidate and the position applied for.

## Technologies Used
- Laravel 9
- Python 3
- FastAPI
- Python libraries: scikit-learn, pdfminer, docx2txt.

## Installation
1. Clone the repository:
   ```shell
   git clone https://github.com/EMMANUELOMONDI/Job-Allocation-Project.git

2. Install Laravel dependencies:
   ```shell
   composer install laravel
   composer create-project --prefer-dist project/job-website

3. Install Python dependencies:
   -Create the Virtual Enivronment 
   ```shell
   pip install virtualenv
   virtualvenv venv
   source ./venv/bin/activate
   
   pip install scikit-learn
   pip install docx2txt
   pip install pdfminer

 5. Set up the database:
  Create a new MySQL database.
  Copy the .env.example file to .env and update the database credentials.
   
 6. Run database migrations:
    ```shell
    php artisan migrate

 7. Generate the application key:
    ```shell
    php artisan key: generate

 8. Start the development server:
    ```shell
    php artisan serve

 9. Access the website at http://localhost:8000.

## Configuration
Make sure to set the appropriate environment variables in the .env file for database connections, Python path, etc.

## Usage
1. Register as a user on the website.
2. Log in with your credentials.
3. Upload a resume file on the Job Application page.
4. The Resume Scanner will process the resume, extract key information and check them against a job decsription giving the similarity between the two
5. View and manage your job applications through the website's intuitive interface.

## Features
1. User registration and authentication.
2. Job Application submission and management.
3. Resume Scanner with automated data extraction.
4. Search and filtering capabilities for job listings.
5. User profile customization.

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

1. Fork the repository.
    Create a new branch:
    ```shell
    git checkout -b feature/your-feature-name.

2. Make your changes and commit them:
   ```shell
   git commit -m 'Add some feature'.

3. Push to the branch:
    ```shell
    git push origin feature/your-feature-name.

4. Submit a pull request.

Kindly adhere to the code style guidelines and relevant testing in your changes.


## License

[MIT](https://choosealicense.com/licenses/mit/)
