INTRUCTIONS:
1. git clone git@github.com:wanderpaul/message_bus.git
2. composer install
3. docker compose up
4. docker compose exec php bash
5. php bin/console messenger:consume -vv

Testing the app using postman
URL: http://localhost/user
body: {"email": "test@email", "first_name":"John", "last_name":"Doe"}
