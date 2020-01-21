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
    * chcon -R -t httpd_sys_rw_content_t wst-hrms/storage/logs/
    * chcon -R -t httpd_sys_rw_content_t wst-hrms/storage/framework/
    * chcon -Rt httpd_sys_content_t /data/www (Give read access)
5. Install PHP extensions
    * yum install ea-php73-php-fileinfo
    * yum install ea-php73-php-zip
6. Go into the cloned/downloaded directory (for this installation, it's /data/www/wst-hrms), and perform the following steps.
    * Run 'composer install" 
    * Run "npm i"
    * Copy or rename .env.example to .env
    * Update .env with the correct database details
    * run "php artisan key:generate"
7. To perform database migration and adding seed data, run "php artisan migrate:refresh --seed"
8. Install wkhtmltopdf
    * yum install -y xorg-x11-fonts-75dpi
    * wget https://downloads.wkhtmltopdf.org/0.12/0.12.5/wkhtmltox-0.12.5-1.centos7.x86_64.rpm
    * rpm -Uvh wkhtmltox-0.12.5-1.centos7.x86_64.rpm
9. Run 'php artisan storage:link'

# Others #
For mobile app,
- php artisan passport:keys - to generate the keys needed for the mobile app authentication
- php artisan passport:client --personal - to create personal access token

# Seeder #
Seed after create company
- php artisan db:seed --class=PayrollSetupTableSeeder
- php artisan db:seed --class=AdditionTableSeeder
- php artisan db:seed --class=DeductionTableSeeder

# Import EPF schedule from csv #
load data local infile '/data/www/wst-hrms/database/seeds/epf.csv' into table epfs fields terminated by ',' set created_at=now(), deleted_at=null;

# Import EIS schedule from csv #
load data local infile '/data/www/wst-hrms/database/seeds/eis.csv' into table eis fields terminated by ',' set created_at=now(), deleted_at=null;

# Import SOCSO schedule from csv #
load data local infile '/data/www/wst-hrms/database/seeds/socso.csv' into table socsos fields terminated by ',' set created_at=now(), deleted_at=null;

# Import PCB Schedule #
php artisan tinker
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-2-50.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-51-100.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-101-150.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-151-200.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-201-250.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-251-300.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-301-350.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-351-355.xlsx',3]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-357-400.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-401-450.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-451-500.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-501-550.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-551-600.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-601-650.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-651-700.xlsx',2]);
app()->call('App\Http\Controllers\Admin\SettingsController@importPcb', ['pcb\Jadual_PCB_2018-701-733.xlsx',2]);