# Motivation form notes

- The entry point is `index.php`.
- It is meant to simulate a RESTful service. I know it is not in the best of ways and that it could be improved. As an example I would've even splitted the fron-end and back-end code bases (despite CORS issues).
- It uses composer to get an `autoloading mechanism`.
- Tested against a MariaDB and MySQL instance.
- When starting, the php script should have access to the the `./img/student` directory.
- I've not followed the best coding practices (like taking your DB connection credentials from the environment) but it is due to this being a homework.

Although it might have many problems I think it is sufficient enough.