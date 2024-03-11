# Cronjobs Files

The Cronjobs Files directory contains essential files responsible for executing various tasks at specified intervals within the Bugfish Fast PHP Page Framework. These cronjobs, including `daily.php` and `monthly.php`, are crucial for maintaining the functionality of the system. The timing of cronjob execution can be adjusted to meet specific requirements, with different intervals tailored to the needs of individual site modules.

## Description

The PHP script in this directory functions as a robust cronjob handler within the Bugfish Fast PHP Page Framework. It orchestrates various tasks scheduled for execution at different intervals across the framework's managed sites. These tasks range from daily maintenance routines to monthly or yearly administrative operations. The script encompasses environment checks, SMTP email configuration, and logging functionalities to ensure seamless operation.

## Usage

To utilize the cronjobs effectively:

- Regularly schedule this directory in your server's crontab to ensure that the cronjobs execute as necessary.
- Modules should organize their specific cronjobs into corresponding folders such as `_cron/daily`, `_cron/hourly`, etc., for automatic execution.
- It's recommended to refrain from placing custom cronjobs directly in this directory. Instead, create a dedicated site module within the `_site` folder for any custom cronjobs. Examples of module development can be found within the framework for guidance.

## Features

The script offers the following features:

- **Environment Check:** Validates the presence of the configuration file and confirms that the script is being executed from the command-line interface.
- **SMTP Configuration:** Retrieves SMTP configuration settings from the database and initializes an email sending class with these settings for seamless communication.
- **Email Template Handling:** Fetches email header and footer templates from the database and configures them for use during email transmission.
- **Cronjob Execution:** Executes cronjobs scheduled for various intervals (daily, monthly, yearly) for each site managed by the framework, ensuring timely execution of essential tasks.

## Important Notes

Here are some important considerations:

- Avoid making direct alterations to files within this folder, as they may be overwritten during CORE Updates, potentially causing system inconsistencies.
- Exercise caution when modifying or adding cronjobs to prevent unintended consequences that may disrupt the system's operation.

## Caution

To ensure smooth operation:

- Verify that server permissions and configurations allow for the execution of cronjobs.
- Monitor log files regularly for any errors generated during the execution of cronjobs, allowing for prompt troubleshooting if necessary.