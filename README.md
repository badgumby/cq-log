# CQ-Log

A simple web app using PHP and MySQL/MariaDB to log contacts when contesting in Amateur Radio!

It can be used to track the call sign, sequence number, frequency, band, state, country, RST (R/S), datetime, and any additional notes of contacts you make during your contesting. It has support for multiple users, and even has an FCC lookup option. You can search by FRN, FCC call sign, or even by name. This pulls directly from the FCC ULS, and displays the basic information of the contact. Once found, it will provide a link to the FCC ULS page with additional information on the contact.

If you experience issues with the site once you get it setup, be sure to white-list it in your pop-up blocker.


# Files
### build.sql

Once you get Apache, PHP, and MySQL/MariaDB setup, this will build your table needed for logging.

### files (directory)

This should be placed one directory above your root.

If `cq-log` webroot is `/var/www/html/cq-log/`, then the `files` directory should be placed `/var/www/html/files/`


# Screenshots

![alt text](https://github.com/badgumby/cq-log/raw/master/cq-log.png "Logbook screen")
