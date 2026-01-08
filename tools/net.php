<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRAHMATT74 | Security Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --terminal-bg: #0f172a;
            --terminal-text: #38bdf8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(to right, #2563eb, #3b82f6);
            color: white;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card-header p {
            margin: 8px 0 0;
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .card-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.875rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        button {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #1d4ed8;
        }

        .result-container {
            margin-top: 24px;
            background-color: var(--terminal-bg);
            border-radius: 8px;
            padding: 16px;
            position: relative;
        }

        .result-header {
            color: #94a3b8;
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .result-header::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
            margin-right: 8px;
            box-shadow: 15px 0 0 #fbbf24, 30px 0 0 #22c55e;
        }

        pre {
            font-family: 'Fira Code', monospace;
            color: var(--terminal-text);
            margin: 0;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Network Diagnostic Tool</h2>
            <p>MRAHMATT74 | Security Lab System</p>
        </div>
        
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="target">Host / IP Address</label>
                    <input type="text" id="target" name="target" placeholder="e.g. 8.8.8.8" required>
                </div>
                <button type="submit">Execute Ping Check</button>
            </form>

            <?php if (isset($_POST['target'])): ?>
                <div class="result-container">
                    <div class="result-header">Terminal Output</div>
                    <pre><?php 
                        $target = $_POST['target'];
                        // VULNERABLE: Menjalankan command injection untuk testing Wazuh
                        system("ping -c 3 " . $target); 
                    ?></pre>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        &copy; 2026 MRAHMATT74 Security Lab. For Educational Purposes Only.
    </footer>
</div>

</body>
</html>