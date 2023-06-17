# Instructions for Running the Subscription Platform

Follow these steps to set up and run the subscription platform.

## 1. Pull the Repository

Clone the repository to your local machine.

## 2. Install Dependencies

`composer install`

## 3. Change Environment Settings

Navigate to the project directory and update the `.env` file with your desired settings. Make sure to configure the following:

-   Database connection details (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
-   Mail settings (`MAIL_DRIVER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`)
-   Queue connection details (`QUEUE_CONNECTION`)

Save the changes in the `.env` file.

## 4. Run Database Migrations

To create the necessary tables in the database, run the following command:

`php artisan migrate`

This command will execute the database migrations and set up the required tables.

## 5. Start the Queue Worker

To process the queued jobs and send email notifications, run the following command:

`php artisan queue:work`

This command will start the queue worker, which listens for incoming jobs and processes them in the background.

Make sure to keep the queue worker running in a separate terminal window or as a background process.

## 6. Run the test

`php artisan test` to run the test.
`php artisan send:post-notifications` to send the post notifications.

for API documentation, please read link below:
https://documenter.getpostman.com/view/21583062/2s93si19k6
