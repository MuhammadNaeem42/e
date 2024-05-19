# Use the official PHP image as a base image
FROM php:8.1-cli

# Set the working directory
WORKDIR /app

# Copy the current directory contents into the container
COPY . /app

# Install any needed packages specified in a composer.json file
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 8000
EXPOSE 8000

# Command to run PHP's built-in web server
CMD ["php", "-S", "0.0.0.0:8000"]
