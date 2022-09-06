# File tổng hợp phân quyền hệ thống
# Menu + Modules
php72 artisan db:seed --class=\\Modules\\Company\\Database\\Seeders\\CompanyPermissionSeeder


# Company + Department
# php72 artisan db:seed --class=\\Workable\\Organization\\Database\\Seeders\\OrganizationPermissionSeeder


# Role + Permission
php72 artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\AclRolePermissionSeeder
php72 artisan db:seed --class=\\Workable\\Acl\\Database\\Seeders\\AclPermissionSeeder

# Account
php72 artisan db:seed --class=\\Workable\\Employee\\Database\\Seeders\\EmployeePermissionSeeder

# Audit log
php72 artisan db:seed --class=\\Workable\\AuditLog\\Database\\Seeders\\AuditLogPermissionSeeder


# Product
php72 artisan db:seed --class=\\Workable\\ReferenceSite\\Database\\Seeders\\ReferenceSitePermission
php72 artisan db:seed --class=\\Workable\\ApplyJob\\Database\\Seeders\\ApplyJobPermission
php72 artisan db:seed --class=\\Workable\\Candidate\\Database\\Seeders\\ReportCandidatePermissionSeeder
php72 artisan db:seed --class=\\Workable\\SubscribeJob\\Database\\Seeders\\SubscribeJobPermission
