# syntax=docker

FROM alpine:3.12

# image maintainer
LABEL maintainer="Janosch Kocsis <jk@coloso.de>"


# ADD group and user to www-data
RUN addgroup -S www-data \
    && adduser -S -G www-data www-data

# Install tools required for project
# Run `docker build --no-cache .` to update dependencies
RUN apk add --update nginx

# Command to clear cache memory
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

# Add configuration to nginx server
ADD nginx.conf /etc/nginx/
ADD symfony.conf /etc/nginx/conf.d/default.conf

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

# Indicates the ports on which a container listens for connections.
EXPOSE 80

# Instruction used to run nginx container
CMD ["nginx"]