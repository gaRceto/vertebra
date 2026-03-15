#!/bin/bash
# Generar /etc/msmtprc a partir de variables de entorno
cat > /etc/msmtprc <<EOF
defaults
auth           on
tls            on
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile        /var/log/msmtp.log

account        default
host           ${SMTP_HOST:-smtp.ruedesfermes.com}
port           ${SMTP_PORT:-587}
from           ${SMTP_USER:-bonjour@ruedesfermes.com}
user           ${SMTP_USER:-bonjour@ruedesfermes.com}
password       ${SMTP_PASSWORD:-}
EOF
chmod 600 /etc/msmtprc

# Lanzar Apache
exec apache2-foreground
