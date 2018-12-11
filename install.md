# We used the following spec for our first client #
OS: CentOS 7.5
CPU: Intel(R) Xeon(R) CPU E5-2630 v2 @ 2.60GHz x 2 unit (12 cores, 24 threads)
Memory: 64GB DDR3 (1600MHz)

# Brief installation steps #
1. Install Apache httpd 2.4 and above
2. Install MySQL 5.7
3. Install PHP 7.2 and above and all its required modules. You will know the required modules when you deploy the HRMS System for the first time.
4. Clone or download this repository's contents to your preferred location. For this server, it's in /data/www. (/data/www is a new path. To use a new path, you will need to perform various other steps in order for httpd be be able to access it. Among them are SELinux permissions)
    * chcon -R -t httpd_sys_rw_content_t wst-hrms/bootstrap/cache/ (Give read+write access)
    * chcon -Rt httpd_sys_content_t /data/www (Give read access)
5. Go into the cloned/downloaded directory (for this installation, it's /data/www/wst-hrms), and perform the following steps.
    * Run 'composer install" 
    * Run "npm i"
    * Copy or rename .env.example to .env
    * Update .env with the correct database details
    * run "php artisan key:generate"
6. To perform database migration and adding seed data, run "php artisan migrate:refresh --seed"


