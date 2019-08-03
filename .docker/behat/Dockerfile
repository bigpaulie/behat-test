FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt update && apt upgrade -y && apt dist-upgrade -y
RUN apt install -y php-cli php-gd php-mbstring php-zip php-json php-xml php-mysql php-curl php-bcmath git-core unzip curl chromium-browser wget

RUN wget https://getcomposer.org/composer.phar && chmod +x composer.phar && mv composer.phar /usr/bin/composer

EXPOSE 9222
CMD ["chromium-browser", "--disable-gpu", "--headless", "--remote-debugging-address=0.0.0.0", "--remote-debugging-port=9222", "--no-sandbox"]