#!/usr/bin/env bash

if ! yum list installed | grep nginx > /dev/null; then
    echo ">>> install nginx <<<"
    yum install -y nginx
    echo ">>> create ssl certificate <<<"
    mkdir /etc/nginx/ssl
    openssl req -x509 -newkey rsa:2048 -keyout /etc/nginx/ssl/local.vm.key -out /etc/nginx/ssl/local.vm.crt -days 365 -nodes -subj "/C=GB/ST=Warwickshire/L=Rugby/O=local.vm/OU=local.vm/CN=local.vm"
    echo ">>> nginx config <<<"
    cat <<EOF >/etc/nginx/nginx.conf
user  nginx nginx;

worker_processes  1;

events {
  worker_connections  1024;
}

pid        /var/run/nginx.pid;
error_log  /var/log/nginx/error.log;

http {
  include /etc/nginx/mime.types;
  default_type application/octet-stream;

  access_log  off;
  sendfile    off;

  server {
    listen       80;
    server_name  localhost;

    root   /srv/public;
    index  index.php;

    location / {
      try_files  \$uri \$uri/ /index.php\$is_args\$args;
    }

    location ~ \.php\$ {
      fastcgi_pass   127.0.0.1:9000;
      fastcgi_param  SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
      fastcgi_param  APP_ENV development;
      include        fastcgi_params;
    }
  }

  server {
    listen       443;
    server_name  localhost;

    root   /srv/public;
    index  index.php;

    ssl on;
    ssl_certificate      /etc/nginx/ssl/local.vm.crt;
    ssl_certificate_key  /etc/nginx/ssl/local.vm.key;

    location /status {
      fastcgi_pass   127.0.0.1:9000;
      fastcgi_param  SCRIPT_FILENAME /status;
      include        fastcgi_params;
    }

    location / {
      try_files  \$uri \$uri/ /index.php\$is_args\$args;
    }

    location ~ \.php\$ {
      fastcgi_pass   127.0.0.1:9000;
      fastcgi_param  SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
      fastcgi_param  APP_ENV development;
      include        fastcgi_params;
    }
  }
}
EOF
    echo ">>> start nginx <<<"
    systemctl enable nginx
    systemctl start nginx
fi
