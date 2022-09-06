# File tổng hợp seeder data
# System
php artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\AdminTableSeeder
php artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\MenuSeeder

# Company
php artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\AnnouncementTableSeeder
php artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\CompanySeederTableSeeder
php artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\DepartmentTableSeeder

# hrm
php artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\RoleTableSeeder
php artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\RoleUserTableSeeder

# Product
php artisan db:seed --class=\\Workable\\ReferenceSite\\Database\\Seeders\\JobReferSourceTableSeeder
php artisan db:seed --class=\\Workable\\Attribute\\Database\\Seeders\\AttributeDatabaseSeeder
php artisan db:seed --class=\\Workable\\ApplyJob\\Database\\Seeders\\ApplyJobSourceTableSeeder
php artisan db:seed --class=\\Workable\\SubscribeJob\\Database\\Seeders\\SubscribeJobTableSeeder

#upload/public
php artisan db:seed --class=Modules\\Report\\Database\\Seeders\\UploadDatabaseSeeder

#report_seo
php artisan db:seed --class=Modules\\Report\\Database\\Seeders\\ReportSeoDatabaseSeeder

#robot
php artisan db:seed --class=Modules\\Report\\Database\\Seeders\\RobotDatabaseSeeder

#reference
php artisan db:seed --class=Modules\\Report\\Database\\Seeders\\ReferenceDatabaseSeeder
