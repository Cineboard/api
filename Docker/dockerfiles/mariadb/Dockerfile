FROM alpine:3.7
LABEL maintainer="GB 'gionniboy' Pullarà  <info@firegarden.co>" architecture="AMD64/x86_64" version="10.1" date="2018.04.04"
RUN (apk add --no-cache mariadb mariadb-client)
ENV DB_CONFIGFILE=/etc/mysql/my.cnf
ENV DB_DATAPATH=/var/lib/mysql
ENV DB_ROOTPASS=rootpass
COPY files/envstart.sh /usr/local/bin
EXPOSE 3306
VOLUME ["/var/lib/mysql"]
ENTRYPOINT ["sh", "/usr/local/bin/envstart.sh"]

