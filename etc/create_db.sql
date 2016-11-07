CREATE USER 'test'@'%' IDENTIFIED WITH mysql_native_password AS 'secret';
GRANT USAGE ON *.* TO 'test'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `test`;
GRANT ALL PRIVILEGES ON `test`.* TO 'test'@'%';
