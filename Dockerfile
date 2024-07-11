# 베이스 이미지 선택
FROM php:8.1-apache

# Composer 설치
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 소스 코드 복사
COPY . .

# Composer 종속성 설치
RUN composer install

# Apache 모듈 설정 (필요한 경우)
RUN a2enmod rewrite

# Apache 설정 파일 복사 (필요 시)
# COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# 포트 개방 (Apache 기본 포트는 80)
EXPOSE 80

# Apache 시작
CMD ["apache2-foreground"]
