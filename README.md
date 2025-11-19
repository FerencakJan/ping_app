ZADANIE:
Vytvorte malú ukážkovú aplikáciu

Backend (Laravel)

endpoint POST /api/ping
request body:
·    

uuid (string)
battery_percent (number)
endpoint uloží tieto údaje do databázy do tabuľky pings so stĺpcami:
id, uuid, battery_percent, created_at
response: {"status":"ok"}
(Nie je potrebné riešiť login / autentifikáciu / UI pre listing.)




Frontend (Vue 3)

jednoduchý formulár s 2 inputmi (uuid, battery_percent) + tlačidlo “Send”
po kliknutí cez fetch odošle request na backend endpoint POST /api/ping

Výstup
odkaz na GitHub repo
README ako projekt spustiť (docker alebo lokál)