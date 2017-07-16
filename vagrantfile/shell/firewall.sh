#!/usr/bin/env bash

if ! systemctl status firewalld | grep running > /dev/null; then
    echo ">>> start firewalld <<<"
    systemctl enable firewalld
    systemctl start firewalld
    echo ">>> open ports <<<"
    firewall-cmd --permanent --zone=public --add-port=80/tcp
    firewall-cmd --permanent --zone=public --add-port=443/tcp
    firewall-cmd --permanent --zone=public --add-port=3306/tcp
    firewall-cmd --reload
fi
