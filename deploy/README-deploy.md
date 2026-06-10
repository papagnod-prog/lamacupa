# Guida Deploy Automatico — Lamacupa

## Come funziona

Ogni volta che viene fatto un `git push`, GitHub invia una notifica al tuo server.
Lo script `webhook.php` riceve la notifica, verifica che sia autentica, ed esegue `git pull` in automatico.

**Risultato:** il tema si aggiorna sul sito in pochi secondi, senza intervento manuale.

---

## Step 1 — Trovare il percorso in Plesk

1. Accedi al **Pannello Plesk**
2. Vai su **Siti Web & Domini** → seleziona il tuo dominio
3. Clicca su **Gestione File**
4. Naviga in: `httpdocs/wp-content/themes/`
5. Il percorso completo mostrato in alto è il tuo percorso base, es:
   `/var/www/vhosts/lamacupa.it/httpdocs/`
6. Il percorso del tema sarà:
   `/var/www/vhosts/lamacupa.it/httpdocs/wp-content/themes/lamacupa`

---

## Step 2 — Configurare webhook.php

Apri `webhook.php` e modifica le costanti:

```php
define('WEBHOOK_SECRET', 'scegli-una-password-sicura');   // es. "Lamacupa2024!AbcXyz"
define('THEME_PATH', '/var/www/vhosts/lamacupa.it/httpdocs/wp-content/themes/lamacupa');
define('NOTIFY_EMAIL', 'tua@email.it');  // opzionale, per ricevere notifiche
```

---

## Step 3 — Caricare il file sul server via Plesk

1. In **Gestione File** Plesk, vai nella root del sito (`httpdocs/`)
2. Clicca **Carica file** e carica `webhook.php`
3. Il file deve essere raggiungibile all'URL:
   `https://tuodominio.it/webhook.php`

---

## Step 4 — Clonare il tema sul server (prima volta)

Connettiti via **SSH** al VPS (in Plesk: *Accesso SSH* o usa un client come PuTTY/Terminal):

```bash
# Vai nella cartella temi
cd /var/www/vhosts/tuodominio.it/httpdocs/wp-content/themes/

# Clona il repository
git clone https://github.com/papagnod-prog/lamacupa.git lamacupa

# Verifica
ls lamacupa/
```

Se il repository è privato, usa un Personal Access Token GitHub:
```bash
git clone https://YOUR_TOKEN@github.com/papagnod-prog/lamacupa.git lamacupa
```

---

## Step 5 — Configurare il Webhook su GitHub

1. Vai su **github.com/papagnod-prog/lamacupa**
2. **Settings** → **Webhooks** → **Add webhook**
3. Compila:
   - **Payload URL**: `https://tuodominio.it/webhook.php`
   - **Content type**: `application/json`
   - **Secret**: la stessa stringa che hai messo in `WEBHOOK_SECRET`
   - **Which events**: seleziona "Just the push event"
4. Clicca **Add webhook**

GitHub mostrerà una spunta verde ✅ se tutto funziona.

---

## Verifica che funzioni

1. Fai una modifica qualsiasi al tema (anche un commento)
2. Fai commit + push
3. Controlla il log sul server:
   ```bash
   cat /var/www/vhosts/tuodominio.it/httpdocs/deploy.log
   ```
4. Dovresti vedere una riga come:
   `[2024-01-15 10:30:22] OK: Deploy completato. Branch: claude/gifted-johnson-v76oeu | Commit: a1b2c3d`

---

## Risoluzione problemi

| Problema | Soluzione |
|---|---|
| GitHub mostra errore 401 | Il `WEBHOOK_SECRET` non corrisponde |
| GitHub mostra errore 500 | Il `THEME_PATH` è sbagliato |
| `git pull` non funziona | SSH: eseguire `git config --global safe.directory THEME_PATH` |
| Il log non si crea | Verificare i permessi della cartella: `chmod 755 httpdocs/` |
