<?php
/**
 * GitHub Webhook Auto-Deploy
 * Azienda Agricola Lamacupa
 *
 * Posizionare questo file FUORI dalla cartella wp-content, es:
 * /var/www/vhosts/tuodominio.it/httpdocs/deploy-hook.php
 *
 * Configurazione: impostare le costanti qui sotto e il Secret su GitHub.
 */

// ─── CONFIGURAZIONE ──────────────────────────────────────────────────────────

// Segreto scelto da te — deve corrispondere esattamente a quello impostato su GitHub
define('WEBHOOK_SECRET', 'INSERISCI_UN_SEGRETO_QUI');

// Ramo che deve triggerare il deploy (il nostro branch di sviluppo)
define('DEPLOY_BRANCH', 'claude/gifted-johnson-v76oeu');

// Percorso assoluto alla cartella del tema sul server
// Trovalo in Plesk: Siti Web & Domini → Gestione File → wp-content/themes/lamacupa
define('THEME_PATH', '/var/www/vhosts/tuodominio.it/httpdocs/wp-content/themes/lamacupa');

// File di log (lasciare vuoto '' per disabilitare il log)
define('LOG_FILE', __DIR__ . '/deploy.log');

// Email per notifiche deploy (lasciare vuoto per disabilitare)
define('NOTIFY_EMAIL', '');

// ─── FINE CONFIGURAZIONE ─────────────────────────────────────────────────────

// Blocca accesso diretto senza payload
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$payload_raw = file_get_contents('php://input');

// Verifica firma GitHub
$signature_header = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
if (empty($signature_header)) {
    http_response_code(401);
    log_deploy('ERRORE: Firma mancante nella richiesta.');
    exit('Unauthorized');
}

$expected = 'sha256=' . hash_hmac('sha256', $payload_raw, WEBHOOK_SECRET);
if (!hash_equals($expected, $signature_header)) {
    http_response_code(401);
    log_deploy('ERRORE: Firma non valida. Possibile richiesta non autorizzata.');
    exit('Unauthorized');
}

// Decodifica payload
$payload = json_decode($payload_raw, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    log_deploy('ERRORE: Payload JSON non valido.');
    exit('Bad Request');
}

// Controlla che sia il branch corretto
$pushed_branch = isset($payload['ref']) ? str_replace('refs/heads/', '', $payload['ref']) : '';
if ($pushed_branch !== DEPLOY_BRANCH) {
    http_response_code(200);
    log_deploy("INFO: Push ricevuto per il branch '{$pushed_branch}' — ignorato (deploy solo per " . DEPLOY_BRANCH . ").");
    exit('Branch ignorato');
}

// Verifica che la cartella del tema esista
if (!is_dir(THEME_PATH)) {
    http_response_code(500);
    log_deploy('ERRORE: Cartella tema non trovata: ' . THEME_PATH);
    exit('Theme path not found');
}

// Esegui git pull
$cmd = sprintf(
    'cd %s && git fetch origin && git reset --hard origin/%s 2>&1',
    escapeshellarg(THEME_PATH),
    escapeshellarg(DEPLOY_BRANCH)
);

$output = shell_exec($cmd);
$commit = isset($payload['after']) ? substr($payload['after'], 0, 7) : 'n/a';
$pusher = $payload['pusher']['name'] ?? 'unknown';

log_deploy("OK: Deploy completato. Branch: " . DEPLOY_BRANCH . " | Commit: {$commit} | Push di: {$pusher}\n{$output}");

// Notifica email opzionale
if (!empty(NOTIFY_EMAIL)) {
    $subject = '[Lamacupa] Deploy completato — commit ' . $commit;
    $body    = "Deploy automatico eseguito con successo.\n\nBranch: " . DEPLOY_BRANCH . "\nCommit: {$commit}\nPush di: {$pusher}\n\nOutput git:\n{$output}";
    mail(NOTIFY_EMAIL, $subject, $body);
}

http_response_code(200);
echo json_encode(['status' => 'ok', 'commit' => $commit]);

// ─── FUNZIONI ────────────────────────────────────────────────────────────────

function log_deploy(string $message): void {
    if (empty(LOG_FILE)) return;
    $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
    file_put_contents(LOG_FILE, $line, FILE_APPEND | LOCK_EX);
}
