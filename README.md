# Stock Simulator

Projekt studencki polegający na implementacji symulacji rynku giełdowego.  
Aplikacja umożliwia użytkownikom handel akcjami w czasie rzeczywistym (symulowanym), analizę zmian cen oraz porównywanie wyników inwestycyjnych.

Projekt został wykonany bez użycia frameworków backendowych i frontendowych, w celu pełnego zrozumienia mechanizmów działania aplikacji webowych.

## 1. Cel projektu

Celem projektu jest:

- zaprojektowanie i implementacja aplikacji webowej w architekturze MVC,
- symulacja rynku akcji z automatycznie zmieniającymi się cenami,
- obsługa portfela inwestycyjnego użytkownika,
- realizacja transakcji kupna i sprzedaży,
- analiza zmian wartości w czasie (24h change),
- stworzenie rankingu użytkowników (leaderboard).

## 2. Wykorzystane technologie

- Backend: PHP 8.x (bez frameworków)
- Frontend: HTML5, CSS3, JavaScript (Vanilla)
- Baza danych: PostgreSQL
- Konteneryzacja: Docker, Docker Compose
- Automatyzacja zadań: cron (osobny kontener)
- Architektura: MVC + Repository + Service Layer

## 3. Instrukcja uruchomienia

### 3.1 Wymagania

- Docker
- Docker Compose

### 3.2 Uruchomienie projektu

```bash
docker compose up --build
```

Po uruchomieniu:

- aplikacja dostępna jest pod adresem http://localhost
- baza danych inicjalizowana jest automatycznie (plik init.sql)
- symulacja rynku działa w tle (cron uruchamiany co 5 minut)

## 4. Dane testowe

### 4.1 Użytkownicy testowi

| Email | Hasło |
|---|---|
| alice@test.com | test123 |
| bob@test.com | test123 |

### 4.2 Akcje (przykładowe)

- BTC – Bitcoin
- ETH – Ethereum
- AAPL – Apple Inc.
- TSLA – Tesla Inc.

## 6. Architektura aplikacji

Aplikacja została podzielona na następujące warstwy:

- Controllers – obsługa żądań HTTP i logiki aplikacyjnej
- Repositories – komunikacja z bazą danych
- Services – logika biznesowa (transakcje, symulacja rynku)
- Views – warstwa prezentacji
- Cron container – zadania cykliczne (symulacja cen, snapshoty portfeli)

Diagram architektury zostanie dostarczony w osobnym pliku.

## 7. Symulacja rynku

- ceny akcji aktualizowane są automatycznie co 5 minut
- zmiana ceny losowana jest w zakresie -1% do +1%
- każda zmiana zapisywana jest w tabeli historii cen
- cyklicznie zapisywane są snapshoty wartości portfeli użytkowników

## 8. Funkcjonalności aplikacji

- rejestracja i logowanie użytkowników
- osobny layout dla logowania i rejestracji
- dashboard z listą akcji
- szybkie transakcje (Quick Trade)
- ekran szczegółów akcji z wykresem
- portfel użytkownika
- leaderboard użytkowników
- zmiana 24h dla akcji i użytkowników
- komunikaty flash
- ochrona tras (401 / 403)
- wyłączone cache przeglądarki dla danych finansowych

## 9. Scenariusz testowy

### 9.1 Logowanie

- Wejście na /login
- Logowanie użytkownika testowego
- Przekierowanie do dashboardu

### 9.2 Rejestracja

- Wejście na /register
- Utworzenie nowego konta
- Wyświetlenie komunikatu flash
- Logowanie na nowo utworzone konto

### 9.3 Dashboard

- Wyświetlenie listy akcji
- Sprawdzenie aktualnych cen i zmiany 24h
- Przejście do ekranu szczegółów akcji

### 9.4 Transakcje

- Kupno akcji (BUY)
- Aktualizacja salda i portfela użytkownika
- Sprzedaż akcji (SELL)
- Weryfikacja zmian w portfelu

### 9.5 Leaderboard

- Wyświetlenie rankingu użytkowników
- Sprawdzenie łącznej wartości portfela
- Sprawdzenie zmiany 24h

### 9.6 Autoryzacja

- Wylogowanie użytkownika
- Próba wejścia na chronioną trasę (np. /dashboard)
- Przekierowanie do strony logowania (401)

## 10. Checklist – zakres realizacji

- [x] Architektura MVC bez frameworków
- [x] PostgreSQL + Docker
- [x] Osobny kontener cron
- [x] Automatyczna symulacja rynku
- [x] Historia cen akcji
- [x] Snapshoty portfeli użytkowników
- [x] 24h change (akcje i użytkownicy)
- [x] Transakcje BUY / SELL
- [x] Flash messages
- [x] Oddzielny layout auth
- [x] Leaderboard
- [x] Ochrona tras
  
