<?php
// Pengaturan target dan hasil
$output = "";
$target = $_POST['target'] ?? '';
$options = $_POST['options'] ?? '-F'; // Default: Fast Scan

if (isset($_POST['scan'])) {
    if (!empty($target)) {
        // VULNERABLE: Input $target dan $options langsung dimasukkan ke fungsi system()
        // Ini memungkinkan Command Injection, contoh target: 127.0.0.1 ; cat /etc/passwd
        $command = "nmap " . $options . " " . $target;
        
        // Menangkap output perintah
        ob_start();
        system($command);
        $output = ob_get_clean();
    } else {
        $output = "Silakan masukkan IP Address atau Domain target.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nmap Web | Wazuh Security Lab</title>
    <style>
        /* ===== BASE STYLES ===== */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top, #0a1b3d, #050b1e);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ===== CONTAINER (RGBA THEME) ===== */
        .container {
            width: 90%;
            max-width: 800px;
            background: rgba(10, 20, 50, 0.9);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        h2 {
            margin-top: 0;
            color: #5da9ff;
            text-align: center;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .description {
            text-align: center;
            color: #9fb3ff;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* ===== FORM STYLES ===== */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        label {
            font-size: 13px;
            color: #5da9ff;
            font-weight: bold;
        }

        input[type="text"], select {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #5da9ff;
            background: rgba(255, 255, 255, 0.1);
        }

        button {
            padding: 15px;
            background: linear-gradient(135deg, #5da9ff, #3f7cff);
            border: none;
            border-radius: 8px;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(93, 169, 255, 0.4);
        }

        /* ===== OUTPUT BOX ===== */
        .terminal {
            margin-top: 30px;
            background: #000;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #5da9ff;
            overflow-x: auto;
        }

        pre {
            margin: 0;
            color: #00ff00; /* Hijau terminal klasik */
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 11px;
            color: #4c5d8a;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🛠️ Nmap Web Diagnostic</h2>
    <p class="description">Security Testing Module - Wazuh SOC Lab</p>

    <form method="POST">
        <div class="input-group">
            <label>Target IP / Domain</label>
            <input type="text" name="target" placeholder="Contoh: 192.168.1.1 atau google.com" value="<?= htmlspecialchars($target) ?>">
        </div>

        <div class="input-group">
            <label>Scan Options</label>
            <select name="options">
                <option value="-F" <?= $options == '-F' ? 'selected' : '' ?>>Fast Scan (-F)</option>
                <option value="-sV" <?= $options == '-sV' ? 'selected' : '' ?>>Service Version Detection (-sV)</option>
                <option value="-O" <?= $options == '-O' ? 'selected' : '' ?>>OS Detection (-O)</option>
                <option value="-p-" <?= $options == '-p-' ? 'selected' : '' ?>>All Ports (-p-)</option>
                <option value="-A" <?= $options == '-A' ? 'selected' : '' ?>>Aggressive Scan (-A)</option>
            </select>
        </div>

        <button type="submit" name="scan">START NETWORK SCAN</button>
    </form>

    <?php if ($output): ?>
        <div class="terminal">
            <pre><?= $output ?></pre>
        </div>
    <?php endif; ?>

    <div class="footer">
        &copy; 2026 MRAHMATT74 Security Lab | For Educational Purposes Only
    </div>
</div>

</body>
</html>