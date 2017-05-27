CREATE USER 'contest-manager'@'localhost' IDENTIFIED BY 'password';
GRANT ALL ON contest.* TO 'contest-manager'@'localhost';
FLUSH PRIVILEGES;
