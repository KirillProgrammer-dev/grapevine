if [ -n "$1" ];
then
    echo -e "\033[34mIndexing files"
    eval git add .
    echo -e "\033[34mCommiting files"
    eval git commit -m "$1"
    echo -e "\033[34mPushing files"
    eval git push
fi
echo 0