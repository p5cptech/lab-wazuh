<?php
require('../config/db.php');

// Mengambil Statistik Data
// 1. Total Artikel
$q_blog  = mysqli_query($conn, "SELECT COUNT(*) as total FROM blog_posts");
$res_blog = mysqli_fetch_assoc($q_blog);

// 2. Total User
$q_user  = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$res_user = mysqli_fetch_assoc($q_user);

// 3. Total Tools (Opsional: diasumsikan ada tabel tools atau dihitung manual)
// Jika belum ada tabel tools, kita set manual atau hitung dari folder tools
$total_tools = 5; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Wazuh Security Lab</title>
    <style>
        /* ===== BASE STYLES ===== */
        :root {
            --bg-dark: #050b1e;
            --bg-card: rgba(10, 20, 50, 0.9);
            --accent: #5da9ff;
            --text: #ffffff;
            --text-dim: #9fb3ff;
            --border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

        body {
            margin: 0;
            background: radial-gradient(circle at top, #0a1b3d, #050b1e);
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== SIDEBAR & HEADER ===== */
        .header {
            height: 70px;
            background: rgba(5, 11, 30, 0.8);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 40px;
            backdrop-filter: blur(10px);
        }

        .header .logo { font-size: 20px; font-weight: bold; letter-spacing: 1px; }
        .header .logo span { color: var(--accent); }

        /* ===== MAIN LAYOUT ===== */
        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-msg { margin-bottom: 30px; }
        .welcome-msg h1 { margin: 0; font-size: 28px; }
        .welcome-msg p { color: var(--text-dim); margin-top: 5px; }

        /* ===== DASHBOARD GRID ===== */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
        }

        .stat-card:hover {
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .stat-card h2 {
            font-size: 16px;
            color: var(--text-dim);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .value {
            font-size: 48px;
            font-weight: bold;
            margin: 15px 0;
            display: block;
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            bottom: 20px;
            font-size: 60px;
            opacity: 0.1;
            color: var(--accent);
        }

        .btn-manage {
            display: inline-block;
            text-decoration: none;
            color: var(--accent);
            font-weight: 600;
            font-size: 14px;
            border-top: 1px solid var(--border);
            padding-top: 15px;
            width: 100%;
        }

        /* ===== QUICK TOOLS SECTION ===== */
        .section-title { margin-bottom: 20px; font-size: 20px; border-left: 4px solid var(--accent); padding-left: 15px; }
        
        .tools-list {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .tool-item {
            background: rgba(255,255,255,0.05);
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            border: 1px solid transparent;
            transition: 0.2s;
        }

        .tool-item:hover { background: rgba(93,169,255,0.2); border-color: var(--accent); }

    </style>
</head>
<body>

<div class="header">
    <div class="logo">🛡️ WAZUH<span>LAB</span>_ADMIN</div>
</div>

<div class="main-container">
    
    <div class="welcome-msg">
        <h1>Dashboard Control</h1>
        <p>Selamat datang kembali, Administrator. Monitor dan kelola infrastruktur lab Anda.</p>
    </div>

    <div class="grid-stats">
        
        <div class="stat-card">
            <h2>Blog & Artikel</h2>
            <span class="value"><?= $res_blog['total']; ?></span>
            <div class="icon">📝</div>
            <a href="manage_blog.php" class="btn-manage">Kelola Artikel →</a>
        </div>

        <div class="stat-card">
            <h2>User Terdaftar</h2>
            <span class="value"><?= $res_user['total']; ?></span>
            <div class="icon">👥</div>
            <a href="manage_users.php" class="btn-manage">Kelola Pengguna →</a>
        </div>

        <div class="stat-card">
            <h2>Security Tools</h2>
            <span class="value"><?= $total_tools; ?></span>
            <div class="icon">🛠️</div>
            <a href="../tools/index.php" class="btn-manage">Lihat Semua Tools →</a>
        </div>

    </div>

    <h3 class="section-title">Quick Lab Access</h3>
    <div class="tools-list">
        <a href="../tools/net-check.php" class="tool-item">🌐 Network Checker</a>
        <a href="../tools/net.php" class="tool-item">🔍 Port Scanner</a>
        <a href="blog_add.php" class="tool-item">➕ Tulis Artikel</a>
        <a href="../profile/user.php" class="tool-item">👤 Profil Saya</a>
        <a href="../logout.php" class="tool-item" style="color: #ff5d5d;">🔴 Logout</a>
    </div>

</div>

</body>
</html>