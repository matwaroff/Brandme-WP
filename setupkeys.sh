#!/bin/bash
key=$1
user=$2
if [[ -n "$key" ]]; then
	if sudo grep -Fxq "$key" /root/.ssh/authorized_keys
	then
		echo "Key Already Found in Root"
	else
		echo"Adding Key to Root"
		sudo echo "$key" >> /root/.ssh/authorized_keys
	fi
	if sudo grep -Fxq "$key" /home/$user/.ssh/authorized_keys
	then
		echo "Key Already Found in $user"
	else
		echo"Adding Key to $user"
		sudo echo "$key" >> /home/$user/.ssh/authorized_keys
	fi
else
	echo "NO KEY GIVEN"
fi
