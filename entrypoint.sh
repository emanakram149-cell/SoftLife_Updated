#!/bin/bash
set -e

# Extra conflicting Apache modules ko disable karein
echo "Disabling event & worker MPM modules..."
a2dismod mpm_event mpm_worker || true

# Prefork (PHP ke liye correct module) ko enable karein
echo "Enabling mpm_prefork module..."
a2enmod mpm_prefork || true

# Absolute path ke sath Apache ko foreground mein run karein
echo "Starting Apache Web Server..."
exec /usr/local/bin/apache2-foreground
