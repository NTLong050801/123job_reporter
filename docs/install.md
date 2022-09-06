### Sau khi clone project về
b1: checkout sang nhánh của mình

````
git checkout dev
git checkout -b <ten nhanh cua mình>
````

b2: cài đặt các submodule
````
sh submodule_rm.sh
````
### xóa core, packages trong platform
````
sh submodule_init.sh
````

b3: Copy .env cài đặt database tương ứng
````
cp .env.example .env
````
### sửa lại file .env cho đúng database, user-password

````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

````
b4: install composer và npm
````
composer install
npm install
````


b5: tạo key
````
php artisan key:generate
````

b6: Tạo các bảng
````
sh sh/migration.sh
````

b7 : Seed DB

````
sh sh/seeder_permission.sh
sh sh/seeder.sh
````

b8 : Run webpack

````
sh sh/npm.sh
````

b9: xoá cache
````
php artisan cache:clear
php artisan config:cache
php artisan config:clear
````
