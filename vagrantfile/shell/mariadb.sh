#!/usr/bin/env bash

if ! yum list installed | grep MariaDB > /dev/null; then
    echo ">>> install mariadb <<<"
    yum install -y MariaDB-server MariaDB-client
    echo ">>> start mariadb <<<"
    systemctl enable mariadb
    systemctl start mariadb
    echo ">>> mysql secure installation <<<"
    mysql -u root -e "
        DROP DATABASE test;
        DELETE FROM mysql.user WHERE User='';
        DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
        UPDATE mysql.user SET Password=PASSWORD('password') WHERE User='root';
        FLUSH PRIVILEGES;
    "
    echo ">>> remote client access <<<"
    mysql -u root -ppassword -e "
        GRANT ALL PRIVILEGES ON *.* TO 'root'@'192.168.79.%' IDENTIFIED BY 'password' WITH GRANT OPTION;
        FLUSH PRIVILEGES;
    "
fi
