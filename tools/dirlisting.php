<?php
/**
 * RECON AUTOMATION TOOL - LAB PENTEST
 * Feature: Auto-switch HTTPS/HTTP & Command Injection Vulnerable
 */

$output_dir = "results/";
if (!is_dir($output_dir)) {
    mkdir($output_dir, 0777, true);
}

$scan_log = "";
$domain = $_POST['domain'] ?? '';
$mode = $_POST['mode'] ?? 'subdomain';

if (isset($_POST['run_scan'])) {
    if (!empty($domain)) {
        // --- LOGIKA FLEKSIBEL PROTOKOL ---
        $target = $domain;
        
        // Hapus http:// atau https:// jika user mengetik manual agar tidak double
        $clean_domain = preg_replace('#^https?://#', '', $target);

        if ($mode == 'subdomain') {
            // Subfinder biasanya hanya butuh domain mentah
            $command = "subfinder -d $clean_domain -silent";
        } else {
            // Untuk Gobuster & Dirsearch, kita utamakan HTTPS
            // Kita gunakan skema https:// sebagai default
            $url = "https://" . $clean_domain;
            
            if ($mode == 'gobuster') {
                // Gobuster dengan opsi -k (skip TLS verification) agar lebih fleksibel
                $command = "gobuster dir -u $url -w /usr/share/wordlists/dirb/common.txt -q -t 10 -k";
            } elseif ($mode == 'dirsearch') {
                // Dirsearch otomatis mencoba mendeteksi, tapi kita paksa ke HTTPS dulu
                $command = "dirsearch -u $url -e php,html,js,txt -t 20 --random-agent";
            }
        }

        $scan_log = "Target Detected: $clean_domain\n";
        $scan_log .= "Executing command: $command\n";
        $scan_log .= "================================================\n\n";
        
        // ❌ VULNERABLE: shell_exec tanpa escapeshellarg() memungkinkan RCE
        // Contoh payload bypass: google.com ; cat /etc/passwd
        $scan_log .= shell_exec($command . " 2>&1");

        // --- FALLBACK LOGIC (Sederhana) ---
        // Jika output kosong (kemungkinan HTTPS gagal), beri saran di log
        if (strlen($scan_log) < 200 && ($mode == 'gobuster' || $mode == 'dirsearch')) {
            $scan_log .= "\n[!] Hint: If scan failed, the target might not support HTTPS. \n";
            $scan_log .= "[!] Try checking if http://" . $clean_domain . " is the correct endpoint.";
        }
    } else {
        $scan_log = "Error: Masukkan domain target!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Enum Tool | Wazuh Lab</title>
    <style>
        :root { --bg: #050b1e; --card-bg: rgba(10, 20, 50, 0.95); --accent: #5da9ff; --text: #ffffff; }
        body { margin: 0; min-height: 100vh; background: radial-gradient(circle at top, #0a1b3d, #050b1e); color: var(--text); font-family: 'Segoe UI', sans-serif; padding: 40px; display: flex; align-items: center; }
        .container { max-width: 850px; margin: auto; background: var(--card-bg); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(15px); box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
        h2 { color: var(--accent); margin-bottom: 25px; text-align: center; font-weight: 800; letter-spacing: 1px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #9fb3ff; font-size: 13px; text-transform: uppercase; font-weight: 600; }
        input, select { width: 100%; padding: 14px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: white; outline: none; transition: 0.3s; }
        input:focus { border-color: var(--accent); box-shadow: 0 0 10px rgba(93, 169, 255, 0.3); }
        button { width: 100%; padding: 16px; background: linear-gradient(135deg, #5da9ff, #3f7cff); border: none; border-radius: 10px; color: white; font-weight: 800; cursor: pointer; margin-top: 10px; transition: 0.3s; }
        button:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(63, 124, 255, 0.4); }
        .terminal { margin-top: 30px; background: #000; padding: 20px; border-radius: 12px; border-left: 4px solid var(--accent); box-shadow: inset 0 0 20px rgba(0,0,0,0.5); }
        pre { margin: 0; color: #00ff9d; font-family: 'Consolas', 'Monaco', monospace; font-size: 13px; white-space: pre-wrap; line-height: 1.5; }
        .status-bar { font-size: 11px; color: #5da9ff; margin-bottom: 20px; text-align: center; opacity: 0.7; }
    </style>
</head>
<body>

<div class="container">
    <h2>📡 RECON COMMAND CENTER</h2>
    <div class="status-bar">PROTOCOLS: HTTPS (PRIORITY) | HTTP (FALLBACK)</div>

    <form method="POST">
        <div class="form-group">
            <label>Target Domain / Hostname</label>
            <input type="text" name="domain" placeholder="example.com" value="<?= htmlspecialchars($domain) ?>" required>
        </div>

        <div class="form-group">
            <label>Execution Mode</label>
            <select name="mode">
                <option value="subdomain" <?= $mode == 'subdomain' ? 'selected' : '' ?>>Subfinder (Passive Subdomain)</option>
                <option value="gobuster" <?= $mode == 'gobuster' ? 'selected' : '' ?>>Gobuster (Directory Fuzzing)</option>
                <option value="dirsearch" <?= $mode == 'dirsearch' ? 'selected' : '' ?>>Dirsearch (Advanced Analysis)</option>
            </select>
        </div>

        <button type="submit" name="run_scan">EXECUTE RECON</button>
    </form>

    <?php if ($scan_log): ?>
        <div class="terminal">
            <pre><?= htmlspecialchars($scan_log) ?></pre>
        </div>
    <?php endif; ?>
</div>

</body>
</html>