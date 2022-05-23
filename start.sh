if [ -n "$1" ];
then
    if [ "$1" == "n" ];
    then
    echo -e "\033[34mReseting migrations\e[97m"
    eval php artisan migrate:reset
    echo -e "\033[34mMigrating\e[97m"
    eval php artisan migrate
    echo -e "\033[34mSeeding\e[97m"
    eval php artisan db:seed --class=UserSeeder
    eval php artisan db:seed --class=TaskSeeder
    echo -e "\033[34mStarting\e[97m"
    x-terminal-emulator -e php artisan serve
    eval npm run watch
    fi
else
    echo -e "\033[34mStarting\e[97m"
    x-terminal-emulator -e php artisan serve
    eval npm run watch
fi
echo 0