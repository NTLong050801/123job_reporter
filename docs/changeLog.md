#12/7/2022
- add column count_public_upload to table public_uploada
````
php artisan migrate --path=Modules/Report/Database/Migrations/2022_07_12_170534_add_count_upload_public_to_public_uploads_table.php
````

#6/7/2022
- add column country to table Site
````
 php artisan migrate --path=platform/plugins/manager-site/src/Database/Migrations/2022_07_06_111808_add_country_to_sites_table.php
````
- Command craw public_upload
````
php artisan worker-get-data:run uk --process=upload_public --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run us --process=upload_public --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run ca --process=upload_public --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run au --process=upload_public --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run fr --process=upload_public --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"

````

- Sau khi chạy xong 4 command bên trên chạy : 
````
php artisan queue:work --queue=local-queue-process-data-crawl
````

- Command craw seo_content
````
php artisan worker-get-data:run uk --process=seo_content --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run us --process=seo_content --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run ca --process=seo_content --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run au --process=seo_content --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
php artisan worker-get-data:run fr --process=seo_content --date_range="2022-07-12 00:00:00 - 2022-08-12 23:59:59"
````
- Sau khi chạy xong 4 command bên trên chạy :
````
php artisan queue:work --queue=local-queue-process-data-crawl
````
# 28/06/2021
- Add robot counter
```
    # run migrate
    php artisan migrate
    
    # seeder robot visit
    php artisan db:seed --class=Workable\\RobotLog\\Database\\Seeders\\RobotVisitDatabaseSeeder
    
    # seeder menu
    php artisan db:seed --class=Workable\\RobotLog\\Database\\Seeders\\RobotLogPermission
    
    # command count robot visit to robot counter
    php artisan robot-counter:count-visit --start_date=2021-06-01 --end_date=2021-06-24
```

# 24/06/2021
- Add google analytic page
```
    # seeder menu
    php72 artisan db:seed --class=\\Workable\\GoogleLog\\Database\\Seeders\\GoogleLogPermission
    
    # GA 
    php72 artisan google-log:get-data-ga-user --start_date=2021-06-01 --end_date=2021-06-24
    
    # Event
    php72 artisan client-event:get-data-ga-event --start_date=2021-06-01 --end_date=2021-06-24
    
    
```

# 21/06/2021
- Add worker get data ga ( ga-user & ga-event)
```
	# Run migration
	php artisan migrate
	
    # Worker get data ga-user - GAGetDataUserCommand
    php artisan google-log:get-data-ga-user
    
    # Worker get data ga-user - GAGetDataEventCommand
    php artisan client-event:get-data-ga-event
    
    
    # Install google client
    composer install
    
```

# 12/4/2021

```
# Run artisan
composer install
sh seed.sh
npm install
npm run plugin-watch --name=candidate
```
