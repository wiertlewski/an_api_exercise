#!/usr/bin/env bash

if ! yum list installed | grep redis > /dev/null; then
    echo ">>> install redis <<<"
    yum -y --enablerepo=remi install redis
    echo ">>> start redis <<<"
    systemctl enable redis
    systemctl start redis
fi
