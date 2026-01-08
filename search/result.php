<?php
$q = $_GET['q'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search | Wazuh Security Lab</title>

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
    font-weight: 600;
    font-size: 16px;
}

.header .brand span {
    font-size: 20px;
    color: #5da9ff;
}

/* ===== SEARCH FORM ===== */
.search-form {
    max-width: 900px;
    margin: 50px auto 20px;
    padding: 0 20px;
}

.search-input {
    display: flex;
    background: rgba(10, 20, 50, 0.95);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,.6);
}

.search-input input {
    flex: 1;
    padding: 14px 18px;
    font-size: 15px;
    border: none;
    outline: none;
    background: transparent;
    color: #ffffff;
}

.search-input input::placeholder {
    color: #9fb3ff;
}

.search-input button {
    background: linear-gradient(135deg, #5da9ff, #3f7cff);
    border: none;
    padding: 0 26px;
    color: #000;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
}

.search-input button:hover {
    opacity: .9;
}

/* ===== SEARCH RESULT ===== */
.search-container {
    max-width: 900px;
    margin: 20px auto 70px;
    padding: 0 20px;
}

.search-box {
    background: rgba(10, 20, 50, 0.92);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 14px;
    padding: 34px;
    box-shadow: 0 25px 50px rgba(0,0,0,.6);
    backdrop-filter: blur(10px);
}

.search-box h2 {
    margin: 0 0 8px;
    font-size: 22px;
}

.search-meta {
    font-size: 13px;
    color: #9fb3ff;
    margin-bottom: 26px;
}

/* ===== KEYWORD ===== */
.search-keyword {
    background: rgba(93,169,255,.15);
    border-left: 4px solid #5da9ff;
    padding: 14px 18px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 28px;
}

/* ===== EMPTY ===== */
.search-empty {
    background: rgba(255,255,255,.04);
    border: 1px dashed rgba(255,255,255,.15);
    border-radius: 10px;
    padding: 28px;
    text-align: center;
    color: #b8c7ff;
}

.search-empty span {
    font-size: 36px;
    display: block;
    margin-bottom: 12px;
}

/* ===== HR ===== */
hr {
    border: none;
    border-top: 1px solid rgba(255,255,255,.08);
    margin: 30px 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .search-box {
        padding: 24px;
    }

    .search-input button {
        padding: 0 18px;
    }
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="brand">
        <span>🛡️</span> Wazuh Security Lab
    </div>
</div>

<!-- SEARCH FORM -->
<form class="search-form" method="GET">
    <div class="search-input">
        <input type="text" name="q" placeholder="Cari log, alert, payload, keyword..." value="<?php echo $q; ?>">
        <button type="submit">Search</button>
    </div>
</form>

<!-- RESULT -->
<?php if ($q !== ''): ?>
<div class="search-container">
    <div class="search-box">

        <h2>🔎 Hasil Pencarian</h2>
        <div class="search-meta">Security Search Module • SOC Lab</div>

        <div class="search-keyword">
            Anda mencari keyword:
            <strong><?php echo $q; ?></strong>
        </div>

        <hr>

        <div class="search-empty">
            <span>📭</span>
            Tidak ditemukan hasil yang cocok dengan keyword tersebut.
        </div>

    </div>
</div>
<?php endif; ?>

</body>
</html>
