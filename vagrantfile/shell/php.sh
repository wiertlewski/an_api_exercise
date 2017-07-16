#!/usr/bin/env bash

if ! yum list installed | grep php71-php > /dev/null; then
    echo ">>> install php <<<"
    yum install -y php71-php php71-php-fpm php71-php-mysqlnd php71-php-opcache
    yum install -y php71-php-pecl-xdebug php71-php-pecl-redis
    echo ">>> php fpm config <<<"
cat <<EOF >/etc/opt/remi/php71/php-fpm.d/www.conf
[www]
user = nginx
group = nginx

listen = 127.0.0.1:9000
listen.allowed_clients = 127.0.0.1

pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.status_path = /status

slowlog = /tmp/php-fpm-www-slow.log

php_admin_value[error_log]    = /tmp/php-fpm-www-error.log
php_admin_flag[log_errors]    = on
php_admin_value[memory_limit] = 256M
php_value[date.timezone]      = Europe/London

;php_value[session.save_handler] = files
php_value[session.save_handler] = redis
;php_value[session.save_path]    = /tmp
php_value[session.save_path]    = "tcp://127.0.0.1:6379"
php_value[soap.wsdl_cache_dir]  = /tmp
php_value[opcache.file_cache]   = /tmp
EOF
    echo ">>> start php fpm <<<"
    systemctl enable php71-php-fpm
    systemctl start php71-php-fpm
fi
