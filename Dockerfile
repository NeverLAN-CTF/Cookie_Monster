FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy web files
COPY web/ .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Add metadata
LABEL maintainer="Zane Durkin <zane@neverlanctf.org>"
LABEL description="Cookie Monster CTF Challenge"
LABEL version="1.0.0"

# Start Apache
CMD ["apache2-foreground"]
