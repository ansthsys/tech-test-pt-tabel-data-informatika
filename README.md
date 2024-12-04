# tech-test-pt-tabel-data-informatika

## Jawaban soal

- Soal Teori: Branch [feature/soal-teori](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-teori) file [./SOAL_TEORI.md](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/blob/feature/soal-teori/SOAL_TEORI.md)
- Soal 1: Branch [feature/soal-1](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-1)
- Soal 2: Branch [feature/soal-2](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-2)
- Soal 3: Branch [feature/soal-3](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-3) file [./server/SOAL_3.sql](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/blob/feature/soal-3/server/SOAL_3.sql)
- Soal 4: Branch [feature/soal-4](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-4)
- Soal 5: Branch [feature/soal-5](https://github.com/ansthsys/tech-test-pt-tabel-data-informatika/tree/feature/soal-5)


## Tech Stack

**Client:** Vue

**Server:** Lumen

**Database:** MySQL

## System Requirement

**Client:** 
- Node v20.17.0
- NPM v10.8.2

**Server:** 
- PHP v8.3.11
- Composer v2.4.1

## Running Server Local

Clone the project

```bash
  git clone https://github.com/ansthsys/tech-test-pt-tabel-data-informatika.git
```

Go to the project directory

```bash
  cd tech-test-pt-tabel-data-informatika
```

Switch to branch feature/soal-1

```bash
  git checkout git checkout feature/soal-1
```

Go to the server root directory

```bash
  cd server
```

Install dependencies

```bash
  composer install
```

Create and setup environment

```bash
  cp .env.example .env
```

```.env
  APP_ENV=local
  APP_DEBUG=true
  APP_KEY=fill with random string
  
  APP_LOCALE=en
  APP_FALLBACK_LOCALE=en
  
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=fill with database name
  DB_USERNAME=fill with database username
  DB_PASSWORD=fill with database password
  
  JWT_SECRET=
```

```bash
  php artisan migrate --seed
  php artisan jwt:secret
```

Start the server

```bash
  php -S localhost:8000 -t public
```

## Running Client Local

Open new terminal and switch to branch feature/soal-2

```bash
  git checkout git checkout feature/soal-2
```

Go to the client root directory

```bash
  cd client
```

Install dependencies

```bash
  npm install
```

Start the server

```bash
  npm run dev
```
