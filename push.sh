if [ -n "$1" ];
then
    echo -e "\033[34mIndexing files\e[97m"
    eval git add .
    echo -e "\033[34mCommiting files\e[97m"
    eval git commit -m "$*"
    echo -e "\033[34mPushing files\e[97m"
    eval git push
fi
echo 0