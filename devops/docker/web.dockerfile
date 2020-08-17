FROM nginx:1.17.3
RUN apt-get update -y && apt-get install -y openssl zip unzip vim nginx-extras
RUN rm etc/nginx/sites-enabled/default
ADD devops/nginx/nginx.conf /etc/nginx/conf.d/default.conf