FROM php:8.3.10

# Install system dependencies and PHP extensions
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    curl \
    python3 \
    python3-pip \
    libpng-dev \
    libzip-dev \
 && docker-php-ext-install pdo_mysql gd zip \
 && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Install required Python packages
RUN pip3 install --break-system-packages --no-cache-dir \
    pandas \
    mysql-connector-python \
    pysd \
    requests

# Set working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install PHP dependencies (ignoring ext-zip requirement)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-req=ext-zip

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8000
ENTRYPOINT ["docker-entrypoint.sh"]