if [ -n "$1" ];
then
    if [ "$1" == "n" ];
    then
    echo -e "\033[34mReseting migrates"
    eval php artisan migrate:reset
    echo -e "\033[34mMigrating"
    eval php artisan migrate
    echo -e "\033[34mSeeding"
    eval php artisan db:seed --class=UserSeeder
    eval php artisan db:seed --class=TaskSeeder
    echo -e "\033[34mStarting"
    x-terminal-emulator -e php artisan serve
    eval npm run watch
    fi
else
    echo -e "\033[34mStarting"
    x-terminal-emulator -e php artisan serve
    eval npm run watch
fi
echo 0