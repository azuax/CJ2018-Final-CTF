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
RUN apt install -y python-pip
RUN pip install flask gunicorn
RUN apt install -y apache2
RUN apt install -y libapache2-mod-security2
RUN apt install -y dnsutils
COPY src/app /app
COPY src/webapp /webapp

COPY src/etc/apache2/sites-available/hackme.conf /etc/apache2/sites-available/hackme.conf
RUN mv /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf
RUN sed -i "s/SecRuleEngine DetectionOnly/SecRuleEngine On/" /etc/modsecurity/modsecurity.conf
RUN sed -i "s/SecResponseBodyAccess On/SecResponseBodyAccess Off/" /etc/modsecurity/modsecurity.conf

# Flag placeholder
RUN mkdir /var/flag
RUN printf "LETNE{8fdcbdd3a1e00cdcee75567c082db6d1}" > /var/flag/82977b35edecfdf9261dbbfe5c8c13f2
RUN chmod -R 555 /var/flag

# Finishing
RUN useradd ctf
EXPOSE 8000
EXPOSE 80
ENTRYPOINT [ "/start.sh" ]
