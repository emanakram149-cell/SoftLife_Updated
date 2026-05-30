#!/bin/bash

# 1. Railway ke dynamic PORT par Apache ko configuration set karna
if [ -n "$PORT" ]; then
  sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
  sed -i "s/*:80/*:${PORT}/g" /etc/apache2/sites-available/*.conf
fi

# 2. "More than one MPM loaded" error ko solve karna
a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork || true

# 3. Apache container ko foreground mein start karna
exec apache2-foreground
