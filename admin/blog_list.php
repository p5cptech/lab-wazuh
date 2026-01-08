<?php
require('../config/db.php');

// Mengambil total statistik untuk dashboard
$total_posts = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM blog_posts"));
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users"));
$recent_posts = mysqli_query($conn, "SELECT title, created_at FROM blog_posts ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Wazuh Security Lab</title>
    <style>
        :root {
            --bg-body: #050b1e;
            --bg-card: rgba(10, 20, 50, 0.9);
            --accent: #5da9ff;
            --text-main: #ffffff;
            --text-dim: #9fb3ff;
            --border: rgba(255, 255, 255, 0.1);
        }

        body {
            margin: 0;
            background: radial-gradient(circle at top, #0a1b3d, var(--bg-body));
            color: var(--text-main);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: rgba(5, 11, 30, 0.95);
            border-right: 1px solid var(--border);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand span { color: var(--accent); }

        .nav-menu { list-style: none; padding: 0; margin: 0; }
        .nav-item { margin-bottom: 10px; }
        .nav-link {
            text-decoration: none;
            color: var(--text-dim);
            padding: 12px 15px;
            display: block;
            border-radius: 8px;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(93, 169, 255, 0.1);
            color: var(--accent);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .header-main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-card h3 { margin: 0; font-size: 2rem; color: var(--accent); }
        .stat-card p { margin: 5px 0 0; color: var(--text-dim); text-transform: uppercase; font-size: 0.8rem; }

        /* Tools Grid */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .section-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 25px;
        }

        .section-card h4 { margin-top: 0; border-bottom: 1px solid var(--border); padding-bottom: 15px; }

        .recent-list { list-style: none; padding: 0; }
        .recent-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }

        .tool-link {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.05);
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            margin-bottom: 10px;
            transition: 0.2s;
        }
        .tool-link:hover { background: var(--accent); color: #000; }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><span>🛡️</span> Wazuh SOC Lab</div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="#" class="nav-link active">📊 Dashboard</a></li>
            <li class="nav-item"><a href="manage_blog.php" class="nav-link">📝 Manage Blog</a></li>
            <li class="nav-item"><a href="manage_users.php" class="nav-link">👥 User Management</a></li>
            <li class="nav-item"><a href="../tools/net-check.php" class="nav-link">🛠️ Security Tools</a></li>
            <li class="nav-item" style="margin-top: 50px;"><a href="logout.php" class="nav-link" style="color: #ff5d5d;">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-main">
            <h2>Welcome, Admin 🚀</h2>
            <span><?php echo date('l, d F Y'); ?></span>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3><?php echo $total_posts; ?></h3>
                <p>Total Articles</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $total_users; ?></h3>
                <p>Registered Users</p>
            </div>
            <div class="stat-card">
                <h3>Active</h3>
                <p>System Status</p>
            </div>
        </div>

        <div class="tools-grid">
            <div class="section-card">
                <h4>Recent Blog Posts</h4>
                <ul class="recent-list">
                    <?php while($row = mysqli_fetch_assoc($recent_posts)): ?>
                    <li class="recent-item">
                        <span><?php echo $row['title']; ?></span>
                        <small style="color: var(--text-dim);"><?php echo date('d M', strtotime($row['created_at'])); ?></small>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <a href="manage_blog.php" style="color: var(--accent); font-size: 0.8rem; text-decoration: none;">View All →</a>
            </div>

            <div class="section-card">
                <h4>Security Tools Shortcut</h4>
                <a href="../tools/net.php" class="tool-link">🌐 Network Scanner</a>
                <a href="../tools/net-check.php" class="tool-link">🔍 IP Checker</a>
                <a href="../public/uploads/exploit.php" class="tool-link" style="border: 1px dashed #ff5d5d;">💀 Exploit Test (Vuln)</a>
            </div>
        </div>
    </div>

</body>
</html>