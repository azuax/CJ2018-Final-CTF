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
RUN printf "LETNE{b0d3088f3915697d781b1be3ab330ff1}" > /var/flag/4be8d43f31ac6e5d5cd20b45ac515bdf
RUN chmod -R 555 /var/flag

# Finishing
RUN useradd ctf
EXPOSE 8000
ENTRYPOINT [ "/start.sh" ]
