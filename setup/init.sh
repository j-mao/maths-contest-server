sudo apt-get -y install apache2
sudo apache2ctl configtest

sudo ufw allow 22
sudo ufw allow 80
sudo ufw enable

sudo apt-get -y install mysql-server

mysql_secure_installation

sudo apt-get -y install php libapache2-mod-php php-mcrypt php-mysql
sudo apt install php libapache2-mod-php
sudo apt-get install php-mysql

sudo a2enmod rewrite
sudo systemctl restart apache2

mysql -u root -p < init_database.sql 
mysql -u root -p < init_users.sql

sudo rm /var/www/html/index.html

echo "You now need to move the contents of the git clone to /var/www/html";
