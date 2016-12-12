#!/bin/bash
name=$1
if [[ -n '$name' ]]; then
	sudo adduser $name
else
	sudo adduser mat
	name="mat"
fi
sudo echo "$name     ALL=(ALL:ALL) NOPASSWD: ALL" >> /etc/sudoers
sudo ssh-keygen
sudo -u$name ssh-keygen
sudo vi ~/.bashrc
sudo apt-get install apache2 mysql-server php vsftpd
sudo mysql_secure_installation
sudo vi /etc/apache2/sites-available/000-default.conf
sudo service apache2 restart
