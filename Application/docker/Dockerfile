FROM php:7.0-fpm 
RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/* 
RUN apt-get install -y git
#RUN apt-get -y install util-linux
RUN docker-php-ext-install pdo_mysql 
# RUN composer require phpmailer/phpmailer ^6.6
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local/' -xvzf -
ENV PATH="/usr/local/go/bin:$PATH"
#ENV PATH $PATH:/usr/local/go/bin
#RUN export PATH=/usr/local/go/bin:$Path
#RUN source ~/.profile
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail

#RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail
#RUN echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > /usr/local/etc/php/php.ini