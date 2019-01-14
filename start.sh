docker-compose up -d \
    && docker-compose exec php /start.sh \
    && echo 'Done! Go to localhost'