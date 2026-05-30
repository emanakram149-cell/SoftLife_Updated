#!/bin/bash

# Conflicting MPM configurations ko start hone se pehle completely remove karein
rm -f /etc/apache2/mods-enabled/mpm_event.load
rm -f /etc/apache2/mods-enabled/mpm_event.conf
rm -f /etc/apache2/mods-enabled/mpm_worker.load
rm -f /etc/apache2/mods-enabled/mpm_worker.conf

# Force disable events and enable prefork
a2dismod mpm_event mpm_worker || true
a2enmod mpm_prefork

# Start Apache in the foreground
exec apache2-foreground
