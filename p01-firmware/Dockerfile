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
COPY src/app /app

# Flag placeholder
RUN mkdir /var/flag
RUN printf "LETNE{ca3c9ff52254f87c29bd572efd80fe23}" > /var/flag/9406f98947ab90901a6a89e7dbe325b5
RUN chmod -R 555 /var/flag

# Finishing
RUN useradd ctf
EXPOSE 8000
ENTRYPOINT [ "/start.sh" ]
