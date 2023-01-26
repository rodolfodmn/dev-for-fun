
FROM ubuntu:18.04
RUN apt-get update
RUN apt install -y software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN add-apt-repository 'deb http://archive.ubuntu.com/ubuntu trusty universe'
RUN apt-get update
RUN apt install -y \
	php7.3 \
	php-cli \
	php7.3-gd \
	php7.3-json \
	php7.3-curl \
	php7.3-xml \
	php7.3-mysql \
	php7.3-zip php7.3-soap php7.3-mbstring php7.3-xdebug php7.3-intl

RUN apt-get install -y \
	build-essential \
	automake \
	pkg-config \
	unzip \
	pv \
	wget \
	vim \
	git \
	gcc \
	ssh \
	curl \
	nginx \
	sudo \
	ruby-full \
	locales \
	make


RUN useradd -m rods && echo "rods:root" | chpasswd && adduser rods sudo
RUN chown rods:rods -R /home/rods
USER rods

EXPOSE 22 80 443
