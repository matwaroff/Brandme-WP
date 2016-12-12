#!/bin/bash
name=$1
if [[ -n '$name' ]]; then
	sudo adduser $name
else
	sudo adduser mat
	name="mat"
fi
sudo -i
sudo echo "$name     ALL=(ALL:ALL) NOPASSWD: ALL" >> /etc/sudoers
logout
sudo ssh-keygen
sudo -u$name ssh-keygen
sudo vi ~/.bashrc
sudo apt-get install apache2 libapache2-mod-php php vsftpd mysql-server 
sudo mysql_secure_installation
sudo echo '[mysqld]\nsql-mode=' >> /etc/mysql/my.cnf
sudo vi /etc/apache2/sites-available/000-default.conf
sudo service apache2 restart
