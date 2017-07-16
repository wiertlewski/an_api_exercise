#!/usr/bin/env bash

if ! yum repolist | grep epel > /dev/null; then
    echo ">>> update yum <<<"
    yum update -y
    echo ">>> epel repository <<<"
    yum install -y epel-release
    echo ">>> remi repository <<<"
    rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
    echo ">>> mariadb repository <<<"
    cat <<EOF >/etc/yum.repos.d/MariaDB.repo
[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/10.1/centos7-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1
EOF
    echo ">>> nginx repository <<<"
    cat <<EOF >/etc/yum.repos.d/nginx.repo
[nginx]
name=nginx repo
baseurl=http://nginx.org/packages/centos/7/x86_64/
gpgcheck=0
enabled=1
EOF
fi
