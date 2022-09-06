#public_upload
php artisan migrate --path=Modules/Report/Database/Migrations/2022_06_24_134135_create_public_uploads_table.php
php artisan migrate --path=Modules/Report/Database/Migrations/2022_07_12_170534_add_count_upload_public_to_public_uploads_table.php
#site
php artisan migrate --path=platform/plugins/manager-site/src/Database/Migrations/2021_12_28_013457_create_sites_table.php
php artisan migrate --path=platform/plugins/manager-site/src/Database/Migrations/2022_07_06_111808_add_country_to_sites_table.php
#audit_log
php artisan migrate --path=platform/plugins/audit-log/src/Database/Migrations/2021_02_09_140321_create_activity_log_table.php
php artisan migrate --path=platform/plugins/audit-log/src/Database/Migrations/2021_01_19_164643_admin_login_history.php

#company
php artisan migrate --path=Modules/Company/Database/Migrations/2020_06_02_110621_create_admins_table.php
php artisan migrate --path=Modules/Company/Database/Migrations/2021_02_01_142150_create_menu_table.php
php artisan migrate --path=Modules/Company/Database/Migrations/2021_03_25_155051_add_route_to_menus_table.php

#acl
php artisan migrate --path=platform/plugins/acl/src/Database/Migrations/2021_01_04_105011_create_permissions.php

#attribute
php artisan migrate --path=platform/plugins/attribute/src/Database/Migrations/2020_05_10_180933_create_attribute_table.php

#audit_log
php artisan migrate --path=platform/plugins/audit-log/src/Database/Migrations/2021_01_19_164643_admin_login_history.php
php artisan migrate --path=platform/plugins/audit-log/src/Database/Migrations/2021_02_09_140321_create_activity_log_table.php

#organization
php artisan migrate --path=platform/plugins/organization/src/Database/Migrations/2020_08_30_143021_create_companies_table.php

#report_seo
 php artisan migrate --path=Modules/Report/Database/Migrations/2022_06_29_094150_create_report_seos_table.php

#referent
php artisan migrate --path=Modules/Report/Database/Migrations/2022_06_30_111555_create_references_table.php

#robot
php artisan migrate --path=Modules/Report/Database/Migrations/2022_06_30_111606_create_robots_table.php

#monitor
php artisan migrate --path=Modules/Report/Database/Migrations/2022_07_01_143747_create_monitors_table.php
