# Ping App – Laravel + Vue 3

Jednoduchá ukážková aplikácia pozostávajúca z backendu (Laravel) a frontendu (Vue 3).  
Backend prijíma údaje (uuid, battery_percent) a ukladá ich do databázy.  
Frontend obsahuje jednoduchý formulár na odoslanie týchto dát.

---

## Funkčnosť

- POST /api/ping
- prijíma:
  - uuid (string)
  - battery_percent (number)
- údaje sa ukladajú do tabuľky pings
- odpoveď: {"status":"ok"}
- frontend umožňuje hodnoty zadať a odoslať

---

# Backend (Laravel)

## 1. Inštalácia

'''
cd backend
composer install
'''

## 2. Konfigurácia .env

'''
cp .env.example .env
'''

Používa sa SQLite:

'''
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
'''

Ak databáza neexistuje:

'''
mkdir -p database
touch database/database.sqlite
'''

## 3. Migrácie

'''
php artisan migrate
'''

## 4. Spustenie backendu

'''
php artisan serve --host=0.0.0.0 --port=8000
'''

Backend beží na:
 INFO  Server running on [http://0.0.0.0:8000].

## 5. Test API (PowerShell) - kopirovat do jedneho riadku

'''
Invoke-RestMethod -Uri "http://localhost:8000/api/ping" -Method POST -Headers @{
  "Content-Type" = "application/json"
} -Body '{"uuid":"test-device","battery_percent":80}'
'''


Očakávaná odpoveď:
```
status
------
ok
```



# Frontend (Vue 3)

## 1. Inštalácia
'''
cd frontend
npm install
'''

## 2. Spustenie
'''
npm run dev
'''

Frontend beží na:
http://localhost:5173/

## 3. Použitie
- Zadaj UUID (ľubovoľný text).
- Zadaj Battery percent (0–100).
- Klikni na Send.
- Pri úspechu sa zobrazí "Ping sent successfully".

---

# Overenie uložených dát

## 1. Cez Tinker

'''
cd backend
php artisan tinker
'''

V Tinker-i:

```
App\Models\Ping::all()->toArray();
```

## 2. Cez Endpoint /api/pings

'''
http://localhost:8000/api/pings (Pretty-print: checked)
'''

# Vývojové vetvy

- feature/backend-setup
- feature/frontend-setup

Obe vetvy sú zmergované do main.  
V repozitári je vidieť celý priebeh implementácie.