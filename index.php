<?php
// Mendapatkan alamat IP Server untuk link Wazuh
$server_ip = $_SERVER['SERVER_ADDR'] ?? '127.0.0.1';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRAHMATT74 | Security Operations Center</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-deep: #020617;
            --card-bg: rgba(15, 23, 42, 0.6);
            --accent-blue: #38bdf8;
            --accent-purple: #818cf8;
            --danger: #f43f5e;
            --success: #10b981;
            --warning: #fbbf24;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-deep);
            background-image: 
                radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(129, 140, 248, 0.05) 0px, transparent 50%);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Navbar with Glassmorphism */
        .navbar {
            position: fixed;
            top: 0; width: 100%;
            z-index: 1000;
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1.2rem 0;
        }

        .nav-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .nav-menu { list-style: none; display: flex; gap: 2rem; }
        .nav-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .nav-menu a:hover { color: var(--accent-blue); }

        /* Hero Section */
        .container { max-width: 1200px; margin: 120px auto 60px; padding: 0 2rem; }

        .hero { text-align: center; margin-bottom: 5rem; }
        .hero h1 { 
            font-size: clamp(2.5rem, 5vw, 4rem); 
            font-weight: 800; 
            margin-bottom: 1rem;
            letter-spacing: -2px;
        }
        .hero p { color: var(--text-secondary); font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .pulse {
            width: 8px; height: 8px;
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Grid & Cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
            opacity: 0; transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(56, 189, 248, 0.4);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .card:hover::before { opacity: 1; }

        .card-category {
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--accent-blue);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            display: block;
        }

        .card h3 { font-size: 1.5rem; margin-bottom: 1rem; font-weight: 700; }
        .card p { color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 2rem; flex-grow: 1; }

        .btn {
            background: var(--text-primary);
            color: var(--bg-deep);
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            text-align: center;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .btn:hover { background: var(--accent-blue); color: #fff; }

        /* SIEM Special Card */
        .siem-card {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(129, 140, 248, 0.1));
            border: 1px solid rgba(56, 189, 248, 0.3);
        }
        
        .btn-siem {
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple));
            color: #fff;
        }

        /* Footer */
        footer {
            margin-top: 100px;
            padding: 40px;
            text-align: center;
            border-top: 1px solid var(--glass-border);
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .container { margin-top: 100px; }
        }
    </style>
</head>
<body>

    <nav class="navbar animate__animated animate__fadeInDown">
        <div class="nav-container">
            <div class="logo">MRAHMATT<span>.SOC</span></div>
            <ul class="nav-menu">
                <li><a href="#">Simulations</a></li>
                <li><a href="#">Wazuh Rules</a></li>
                <li><a href="#">Lab Logs</a></li>
                <li><a href="#">Documentation</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="hero animate__animated animate__fadeIn">
            <div class="status-pill">
                <div class="pulse"></div> Wazuh Agent 001: Connected
            </div>
            <h1>Security Lab <br><span style="color: var(--accent-blue)">Environment</span></h1>
            <p>Platform simulasi serangan terkendali untuk pengujian deteksi SIEM, Integritas File, dan Respon Insiden.</p>
        </div>

        <div class="grid">
            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                <span class="card-category">OWASP A01:2021</span>
                <h3>Broken Access Control</h3>
                <p>Simulasi bypass login melalui SQL Injection dan IDOR. Pantau bagaimana Wazuh mendeteksi pola <i>single quote</i> dan <i>boolean-based</i>.</p>
                <a href="auth/login.php" class="btn">Launch Portal</a>
            </div>

            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <span class="card-category">OWASP A03:2021</span>
                <h3>Injection Commands</h3>
                <p>Eksekusi perintah sistem melalui alat diagnostik. Uji visibilitas perintah seperti <code>cat /etc/shadow</code> di terminal Wazuh.</p>
                <a href="tools/net.php" class="btn">Diagnostics Tool</a>
            </div>

            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                <span class="card-category">OWASP A05:2021</span>
                <h3>Local File Inclusion</h3>
                <p>Uji kerentanan Path Traversal. Pantau alert log krtis ketika aplikasi mencoba mengakses direktori sensitif di luar root web.</p>
                <a href="files/view_doc.php?file=readme.txt" class="btn">File Browser</a>
            </div>

            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <span class="card-category">Injection</span>
                <h3>Reflected XSS</h3>
                <p>Simulasi pencurian sesi melalui script injection di URL. Validasi aturan <i>cross-site scripting</i> pada modul WAF Wazuh.</p>
                <a href="search/result.php?q=Cari+Sesuatu" class="btn">Search Engine</a>
            </div>

            <div class="card animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                <span class="card-category">File Integrity</span>
                <h3>Web Shell Upload</h3>
                <p>Gunakan portal ini untuk mengunggah file. Skenario ideal untuk menguji <b>Real-time FIM</b> dan deteksi malware otomatis.</p>
                <a href="public/uploads.php" class="btn">Upload Center</a>
            </div>

            <div class="card siem-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                <span class="card-category" style="color: var(--accent-purple)">Centralized Monitoring</span>
                <h3>Wazuh Dashboard</h3>
                <p>Pusat kendali monitoring. Lihat visualisasi log, korelasi event, dan tingkat keparahan (severity) dari serangan yang dilakukan.</p>
                <a href="https://<?php echo $server_ip; ?>:8443" target="_blank" class="btn btn-siem">Open SIEM Console</a>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2024 MRAHMATT74 Security Lab. Built for Educational Pentesting and SIEM Detection Research.
    </footer>

</body>
</html>