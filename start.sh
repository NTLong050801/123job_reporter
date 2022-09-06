echo "Starting setup --------" &&

echo "--1. Remove git submodule \n" &&
sh submodule_rm.sh

echo "--2. Copy .gitmodules.example to .gitmodules"
cp .gitmodules.example .gitmodules

echo "--3. Init git submodule \n" &&
sh submodule_init.sh

echo "--4. Composer install \n" &&
composer install
cp .env.example .env
php artisan key:generate

echo "--5. Npm install \n" &&
npm install

echo "--6. Npm render \n" &&
npm run render

echo "--7. Run seeder.sh"
sh seeder.sh

echo "Finish!!!"
