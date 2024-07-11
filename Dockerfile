# 베이스 이미지 선택
FROM php:8.1-apache

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 소스 코드 복사
COPY . .

# 포트 개방 (Apache 기본 포트는 80)
EXPOSE 80
