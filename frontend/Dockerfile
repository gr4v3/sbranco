FROM centos:7
LABEL maintainer="Fábio Menezes <fabiomenezes.tc24@gmail.com>"

RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum -y install yum-utils
RUN yum-config-manager --enable remi-php74
RUN yum -y update
RUN yum -y install php php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mcrypt php-mbstring php-curl php-xml php-pear php-bcmath php-json
RUN yum -y install unzip httpd mod_fcgid supervisor
RUN mkdir /run/php-fpm/

WORKDIR /etc/
ADD conf/php.ini php.ini
ADD conf/supervisord.conf supervisord.conf

WORKDIR /etc/httpd
ADD conf/apache/httpd.conf conf/httpd.conf
ADD conf/apache/00-base.conf conf.modules.d/00-base.conf
ADD conf/apache/00-dav.conf conf.modules.d/00-dav.conf
ADD conf/apache/00-lua.conf conf.modules.d/00-lua.conf
ADD conf/apache/00-mpm.conf conf.modules.d/00-mpm.conf
ADD conf/apache/00-proxy.conf conf.modules.d/00-proxy.conf
ADD conf/apache/01-cgi.conf conf.modules.d/01-cgi.conf
RUN rm -f /etc/httpd/conf.d/welcome.conf

WORKDIR /var/www/html

CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]