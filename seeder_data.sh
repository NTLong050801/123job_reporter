# File tổng hợp seeder data

# System
php72 artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\AdminTableSeeder
php72 artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\MenuSeeder

# Company
php72 artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\AnnouncementTableSeeder
php72 artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\CompanySeederTableSeeder
php72 artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\DepartmentTableSeeder

# hrm
php72 artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\RoleTableSeeder
php72 artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\RoleUserTableSeeder

# Product
php72 artisan db:seed --class=\\Workable\\ReferenceSite\\Database\\Seeders\\JobReferSourceTableSeeder
php72 artisan db:seed --class=\\Workable\\Attribute\\Database\\Seeders\\AttributeDatabaseSeeder
php72 artisan db:seed --class=\\Workable\\ApplyJob\\Database\\Seeders\\ApplyJobSourceTableSeeder
php72 artisan db:seed --class=\\Workable\\SubscribeJob\\Database\\Seeders\\SubscribeJobTableSeeder
