# File tổng hợp phân quyền hệ thống
# Menu + Modules
php artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\CompanyPermissionSeeder


# Company + Department
# php72 artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\OrganizationPermissionSeeder


# Role + Permission
php artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\AclRolePermissionSeeder
php artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\AclPermissionSeeder

# Account
php artisan db:seed --class=\\Workable\\Employee\\Database\\Seeders\\EmployeePermissionSeeder

# Audit log
php artisan db:seed --class=\\Workable\\AuditLog\\Database\\Seeders\\AuditLogPermissionSeeder


# Product
php artisan db:seed --class=\\Workable\\ReferenceSite\\Database\\Seeders\\ReferenceSitePermission
php artisan db:seed --class=\\Workable\\ApplyJob\\Database\\Seeders\\ApplyJobPermission
php artisan db:seed --class=\\Workable\\Candidate\\Database\\Seeders\\ReportCandidatePermissionSeeder
php artisan db:seed --class=\\Workable\\SubscribeJob\\Database\\Seeders\\SubscribeJobPermission

#site
php artisan db:seed --class=\\Workable\\ManagerSite\\Database\\Seeders\\ManagerSitePermissionTableSeeder
