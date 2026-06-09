# Lamacupa WordPress Theme

Tema personalizzato per **Azienda Agricola Lamacupa** – produttori di olio extravergine d'oliva biologico di alta qualità dalla Puglia e Basilicata.

---

## Requisiti di Sistema

- **PHP** 7.4 o superiore (raccomandato 8.1+)
- **WordPress** 6.0 o superiore
- **MySQL** 5.7+ / MariaDB 10.3+

---

## Plugin Richiesti

Installa e attiva i seguenti plugin prima di attivare il tema:

| Plugin | Versione | Scopo |
|--------|----------|-------|
| **WooCommerce** | 8.x+ | Shop / e-commerce prodotti |
| **Contact Form 7** | 5.x+ | Form di contatto |
| **Classic Editor** _(opzionale)_ | ultima | Se preferisci l'editor classico al blocco |
| **Yoast SEO** _(consigliato)_ | ultima | SEO e sitemap |
| **WP Rocket / LiteSpeed Cache** _(consigliato)_ | ultima | Performance e caching |

---

## Installazione del Tema

1. Copia la cartella `lamacupa/` in `/wp-content/themes/`.
2. Accedi a **Aspetto → Temi** nel pannello WordPress.
3. Individua il tema **Lamacupa** e clicca **Attiva**.

---

## Configurazione Iniziale

### 1. Logo
- Vai su **Aspetto → Personalizza → Identità del sito**.
- Carica il logo dell'azienda (consigliato: PNG con sfondo trasparente, min 400×200px).

### 2. Menu di Navigazione

Vai su **Aspetto → Menu** e crea due menu:

**Menu Principale** (posizione: `Menu Principale`)

Aggiungi le seguenti pagine nell'ordine:
```
Home (link personalizzato → /)
Chi Siamo
La Nostra Terra
Gli Orci
Premi
Olioturismo
Prodotti (pagina WooCommerce Shop)
Contatti
```

**Menu Footer** (posizione: `Menu Footer`)

Stesso elenco oppure versione ridotta.

### 3. Pagina Home (Front Page)

- Vai su **Impostazioni → Lettura**.
- Seleziona **Una pagina statica**.
- **Pagina iniziale**: crea una pagina chiamata `Home` (il template `front-page.php` viene caricato automaticamente).
- **Pagina degli articoli**: opzionale – crea una pagina `Blog`.

---

## Creazione delle Pagine con i Slug Corretti

Crea le seguenti pagine in **Pagine → Aggiungi nuova**. Il **template** viene selezionato in "Attributi di pagina → Modello" nella sidebar destra.

| Titolo Pagina | Slug (Permalink) | Template |
|---------------|-----------------|----------|
| Chi Siamo | `chi-siamo` | Chi Siamo |
| La Nostra Terra | `la-nostra-terra` | La Nostra Terra |
| Gli Orci | `gli-orci` | Gli Orci |
| Premi | `premi` | Premi |
| Olioturismo | `olioturismo` | Olioturismo |
| Contatti | `contatti` | Contatti |

> **Nota sui permalink**: assicurati che la struttura permalink sia impostata su qualcosa diverso da "Normale". Consigliato: **Nome articolo** (`/%postname%/`). Vai su **Impostazioni → Permalink**.

---

## Configurazione WooCommerce

1. Vai su **WooCommerce → Configurazione** e completa il wizard iniziale.
2. Crea una pagina chiamata **Prodotti** con slug `prodotti` e impostala come pagina shop in **WooCommerce → Impostazioni → Prodotti → Pagine → Pagina del negozio**.
3. Imposta la **valuta** su Euro (€).
4. Aggiungi i prodotti in **Prodotti → Aggiungi nuovo**.

### Immagini Prodotti Consigliate
- **Immagine prodotto principale**: min 900×900px
- **Galleria prodotto**: min 600×600px
- **Formati supportati**: JPG, WebP

---

## Configurazione Contact Form 7

1. Vai su **Contact → Aggiungi modulo**.
2. Crea un modulo con:
   - ID: `contact` (oppure usa l'ID numerico nel shortcode)
   - Titolo: `Contact form`
3. Nella pagina Contatti, il shortcode usato è:
   ```
   [contact-form-7 id="contact" title="Contact form"]
   ```
   Se il tuo modulo ha un ID numerico diverso, aggiorna il shortcode in `page-contatti.php` riga ~47 oppure direttamente nell'editor della pagina.

**Campi consigliati nel form CF7:**
```
[text* your-name placeholder "Nome e Cognome"]
[email* your-email placeholder "Email"]
[tel your-phone placeholder "Telefono"]
[select* your-subject "Ordini e prodotti" "Prenotazione visite" "Informazioni generali" "Grossisti e HoReCa" "Stampa e media" "Altro"]
[textarea* your-message placeholder "Il tuo messaggio"]
[acceptance acceptance-consent]Ho letto la [link privacy-policy "Privacy Policy"][/acceptance]
[submit "Invia Messaggio"]
```

---

## Google Maps (pagina Contatti)

Nella pagina contatti è presente un placeholder per la mappa. Per sostituirlo con una vera mappa Google:

1. Vai su [Google Maps Embed](https://www.google.com/maps/embed/v1/place?key=TUA_API_KEY&q=Montescaglioso,MT).
2. Genera l'URL embed dalle impostazioni di Google Maps.
3. In `page-contatti.php` (circa riga 170), sostituisci il div `.map-placeholder` con:
   ```html
   <iframe
       class="map-embed"
       src="TUO_URL_EMBED_GOOGLE_MAPS"
       allowfullscreen
       loading="lazy"
       referrerpolicy="no-referrer-when-downgrade"
   ></iframe>
   ```

---

## Immagini Richieste

Posiziona le immagini nella cartella `/assets/images/` all'interno della cartella tema.
Il tema usa queste immagini come background CSS:

| Nome file | Utilizzo | Dimensioni consigliate |
|-----------|----------|----------------------|
| `hero-bg.jpg` | Hero della home page | 1920×1080px |
| `olioturismo-bg.jpg` | Banner olioturismo + hero pagina | 1920×800px |
| `chi-siamo-bg.jpg` | Hero pagina Chi Siamo | 1440×700px |
| `terra-bg.jpg` | Hero pagina La Nostra Terra | 1440×700px |
| `terra-cta-bg.jpg` | Banner CTA pagina La Nostra Terra | 1440×700px |
| `orci-bg.jpg` | Hero pagina Gli Orci | 1440×700px |
| `premi-bg.jpg` | Hero pagina Premi | 1440×700px |
| `og-image.jpg` | Open Graph / social sharing | 1200×630px |

> Se le immagini non vengono fornite, il tema mostra gradienti di colore come fallback.

---

## Struttura File del Tema

```
lamacupa/
├── style.css                    # Header tema + CSS principale
├── functions.php                # Configurazione tema, enqueue, WooCommerce
├── index.php                    # Template fallback (blog, ricerca, archivi)
├── front-page.php               # Home page
├── page.php                     # Template pagina generica
├── page-chi-siamo.php           # Pagina Chi Siamo
├── page-la-nostra-terra.php     # Pagina La Nostra Terra
├── page-gli-orci.php            # Pagina Gli Orci
├── page-premi.php               # Pagina Premi
├── page-olioturismo.php         # Pagina Olioturismo
├── page-contatti.php            # Pagina Contatti
├── header.php                   # Header (nav, hamburger, logo)
├── footer.php                   # Footer (3 colonne, social, copyright)
├── assets/
│   ├── css/
│   │   └── main.css             # Stili aggiuntivi + override WooCommerce
│   ├── js/
│   │   └── main.js              # Sticky nav, mobile menu, scroll, animazioni
│   └── images/                  # Immagini tema (da caricare manualmente)
└── woocommerce/
    ├── archive-product.php      # Shop page template
    └── content-product.php      # Product card in loop
```

---

## Personalizzazione Colori

I colori principali sono definiti come variabili CSS in `:root` all'inizio di `style.css`:

```css
--color-olive-dark:  #5C6B2E
--color-olive-light: #8B9A3A
--color-earth-light: #C4A882
--color-earth-dark:  #8B6914
--color-cream:       #F5F0E8
--color-text:        #2C2C2C
```

Modifica queste variabili per adattare la palette a future esigenze.

---

## Lingue

Il tema include il text domain `lamacupa`. Per aggiungere traduzioni:

1. Crea la cartella `/wp-content/themes/lamacupa/languages/`.
2. Usa **Loco Translate** (plugin) oppure **WP-CLI** per generare i file `.pot`, `.po`, `.mo`.

---

## Performance

- Le Google Fonts vengono caricate con `display=swap` per evitare FOIT.
- Le immagini nei template usano `loading="lazy"` dove applicabile.
- Il JS è caricato nel footer (`true` come quinto parametro di `wp_enqueue_script`).
- Si consiglia l'uso di un plugin di caching (WP Rocket, LiteSpeed, W3 Total Cache).

---

## Supporto e Manutenzione

Per assistenza tecnica sul tema, fare riferimento al repository del progetto o contattare lo sviluppatore.

---

*Tema versione 1.0.0 – Creato per Azienda Agricola Lamacupa*
