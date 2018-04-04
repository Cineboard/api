-- mysql create db for cineboard
DROP DATABASE IF EXISTS cineboard_db ;
CREATE DATABASE cineboard_db ;
GRANT USAGE ON *.* TO 'cineboard_user'@'localhost' ;
DROP USER 'cineboard_user'@'localhost' ;
CREATE USER 'cineboard_user'@'localhost' IDENTIFIED BY 'cineboard_password' ;
GRANT ALL PRIVILEGES ON cineboard_db.* TO 'cineboard_user'@'localhost' ;
FLUSH PRIVILEGES ;
