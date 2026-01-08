<?php
// =====================================
// TOOLS DASHBOARD - VULNERABLE LAB
// List ALL .php files inside /tools
// =====================================

// ❌ No authentication check (intentional)

// Ambil semua file .php di folder tools
$toolsDir = __DIR__;
$tools = [];

foreach (scandir($toolsDir) as $item) {
    if ($item === '.' || $item === '..') continue;

    $fullPath = $toolsDir . '/' . $item;

    // ✅ hanya file .php
    if (is_file($fullPath) && pathinfo($item, PATHINFO_EXTENSION) === 'php') {
        // ❌ include index.php sendiri (intentional info disclosure)
        $tools[] = $item;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tools Dashboard | Security Lab</title>

<style>
/* ===== BASE ===== */
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

body {
    margin: 0;
    min-height: 100vh;
    background: radial-gradient(circle at top, #0a1b3d, #050b1e);
    color: #ffffff;
}

/* ===== HEADER ===== */
.header {
    height: 64px;
    padding: 0 28px;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #050b1e, #0a1b3d);
    border-bottom: 1px solid rgba(255,255,255,.08);
}

.header .brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 600;
}

.header .brand span {
    font-size: 20px;
    color: #5da9ff;
}

/* ===== PAGE ===== */
.page-wrapper {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
}

.page-title {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 6px;
}

.page-subtitle {
    font-size: 13px;
    color: #9fb3ff;
    margin-bottom: 30px;
}

/* ===== GRID ===== */
.tools-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 22px;
}

/* ===== CARD ===== */
.tool-card {
    background: rgba(10, 20, 50, 0.95);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,.6);
    transition: .25s;
    position: relative;
    overflow: hidden;
}

.tool-card:hover {
    transform: translateY(-6px);
    border-color: rgba(93,169,255,.4);
}

/* ===== TOOL ICON ===== */
.tool-icon {
    font-size: 34px;
    margin-bottom: 12px;
}

/* ===== TOOL TITLE ===== */
.tool-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 6px;
}

/* ===== TOOL DESC ===== */
.tool-desc {
    font-size: 13px;
    color: #9fb3ff;
    margin-bottom: 18px;
    line-height: 1.5;
}

/* ===== BUTTON ===== */
.tool-btn {
    display: inline-block;
    padding: 9px 16px;
    background: linear-gradient(135deg, #5da9ff, #3f7cff);
    border-radius: 10px;
    color: #000;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

/* ===== EMPTY ===== */
.empty {
    text-align: center;
    padding: 80px 20px;
    color: #9fb3ff;
    opacity: .7;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .page-title {
        font-size: 22px;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="brand">
        <span>🛠️</span> Security Tools Lab
    </div>
</div>

<!-- CONTENT -->
<div class="page-wrapper">

    <div class="page-title">Tools Dashboard</div>
    <div class="page-subtitle">
        Auto-discovered PHP tools inside <code>/tools</code>
    </div>

    <?php if ($tools): ?>
    <div class="tools-grid">

        <?php foreach ($tools as $tool): ?>
        <div class="tool-card">
            <div class="tool-icon">⚙️</div>

            <!-- ❌ No escaping (intentional XSS vector) -->
            <div class="tool-title"><?= $tool ?></div>

            <div class="tool-desc">
                PHP Tool loaded from <code>/tools/<?= $tool ?></code>
            </div>

            <a href="<?= $tool ?>" class="tool-btn">
                Open Tool →
            </a>
        </div>
        <?php endforeach; ?>

    </div>
    <?php else: ?>
        <div class="empty">
            No PHP tools found.
        </div>
    <?php endif; ?>

</div>

</body>
</html>
