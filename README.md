# INTRA Studio - TALL Stack Project

Progetto web per INTRA studio realizzato con il TALL stack (Tailwind CSS, Alpine.js, Laravel, Livewire).

## Stack Tecnologico

- **Laravel 12** - Framework PHP
- **Livewire 3** - Componenti dinamici
- **Tailwind CSS 4** - Framework CSS
- **Alpine.js** - Framework JavaScript leggero

## Installazione

1. Clona il repository
2. Installa le dipendenze PHP:
```bash
composer install
```

3. Installa le dipendenze Node:
```bash
npm install
```

4. Copia il file `.env.example` in `.env`:
```bash
cp .env.example .env
```

5. Genera la chiave dell'applicazione:
```bash
php artisan key:generate
```

6. Esegui le migrazioni:
```bash
php artisan migrate
```

7. Compila gli asset:
```bash
npm run build
```

8. Avvia il server di sviluppo:
```bash
php artisan serve
```

E in un altro terminale per il watch degli asset:
```bash
npm run dev
```

## Struttura del Progetto

- `resources/views/layouts/app.blade.php` - Layout principale
- `resources/views/home.blade.php` - Pagina home con tutte le sezioni
- `resources/css/app.css` - Stili Tailwind
- `resources/js/app.js` - Script Alpine.js

## Sezioni Implementate

- ✅ Header con logo e navigazione
- ✅ Sezione Hero con immagine e dettagli progetto
- ✅ Sezione Quote con sfondo beige
- ✅ Galleria immagini con paginazione
- ✅ Sezione sviluppo progetto con team e mappa
- ✅ Footer con workflow e informazioni

## Personalizzazione

I colori principali utilizzati sono definiti in Tailwind:
- Dark Blue: `#1a2332`
- Orange Brown: `#c97d60`
- Beige: `#f5e6d3`

Puoi modificarli nel file `tailwind.config.js` o direttamente nelle classi Tailwind.
