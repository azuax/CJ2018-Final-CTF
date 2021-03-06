FROM ubuntu:18.04

# Base install
RUN apt update
RUN apt install locales
RUN locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND noninteractive
RUN apt install -y wget unzip build-essential cmake gcc libcunit1-dev libudev-dev socat netcat net-tools inetutils-ping

# For entrypoint and sanity check
RUN apt install -y cron curl
COPY src/start.sh /start.sh
COPY src/sanity.sh /sanity.sh
RUN chmod 555 /start.sh
RUN chmod 555 /sanity.sh

# For service
RUN apt install -y apache2 php libapache2-mod-php
RUN apt install -y libapache2-mod-security2
COPY src/app /app
COPY src/html /html

RUN rm -r /var/www/html/
RUN cp -r /html/ /var/www/html/
RUN chown -R root:root /var/www/html/
RUN chmod -R 555 /var/www/html/

RUN mv /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf
RUN sed -i "s/SecRuleEngine DetectionOnly/SecRuleEngine On/" /etc/modsecurity/modsecurity.conf
RUN sed -i "s/SecResponseBodyAccess On/SecResponseBodyAccess Off/" /etc/modsecurity/modsecurity.conf

# Hardcoded for PHP 7.2
RUN echo "disable_functions = exec,passthru,shell_exec,system,popen" >>  /etc/php/7.2/apache2/php.ini

# Flag placeholder
RUN mkdir /var/flag
RUN printf "LETNE{207e78fa19c48f2ae1f9221f61cf43c5}" > /var/flag/2436d5060137a90ed4d00c259ef485b7
RUN chmod -R 555 /var/flag

# Finishing
RUN useradd ctf
EXPOSE 80
ENTRYPOINT [ "/start.sh" ]
