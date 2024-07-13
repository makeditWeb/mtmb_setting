# Dockerfile

# 베이스 이미지 설정
FROM php:8.0-cli

# 작업 디렉토리 설정
WORKDIR /app

# 필요한 추가 패키지 설치 등의 작업 수행 가능
# 예시로 composer 설치
RUN apt-get update && apt-get install -y \
    git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 호스트 머신의 소스 코드를 컨테이너로 복사
COPY . /app

# PHP CLI로 실행할 명령어 지정 (예: PHP 파일 실행)
CMD ["php", "index.php"]
