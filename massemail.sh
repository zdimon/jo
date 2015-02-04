#!/bin/sh
PATH=$PATH:/usr/bin:/usr/sbin:/bin:/sbin

cd /var/www/ourfeeling14
/usr/bin/php symfony frontend:massemail
