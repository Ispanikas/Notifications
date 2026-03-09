<?php
declare(strict_types=1);

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

function qp(string $key, string $default = ''): string {
    if (!isset($_GET[$key])) {
        return $default;
    }
    $v = $_GET[$key];
    if (is_array($v)) {
        // Prevent array injection (e.g. ?url[]=x)
        return $default;
    }
    $v = trim((string)$v);
    return $v !== '' ? $v : $default;
}

function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function val(string $value): string {
    return $value !== '' ? h($value) : '<span class="muted">N/A</span>';
}

// Zscaler redirect query parameters
$url         = qp('url');
$referer     = qp('referer');
$reason      = qp('reason');
$reason_code = qp('reasoncode');
$timebound   = qp('timebound');
$action      = qp('action');
$kind        = qp('kind');
$rule        = qp('rule');
$cat         = qp('cat');
$user        = qp('user');
$locid       = qp('locid');
$lang        = qp('lang', 'en_US');
$zsq_raw     = qp('zsq');

// Extract RID from zsq (Zscaler commonly appends a literal "zsq" suffix)
$rid = $zsq_raw;
if ($rid !== '' && preg_match('/^(.*)zsq$/', $rid, $m)) {
    $rid = $m[1];
}

$html_lang = strtolower(substr($lang, 0, 2));
if (!preg_match('/^[a-z]{2}$/', $html_lang)) {
    $html_lang = 'en';
}

$timebound_label = $timebound;
if ($timebound === '1') {
    $timebound_label = 'Yes';
} elseif ($timebound === '0') {
    $timebound_label = 'No';
}
?>
<!DOCTYPE html>
<html lang="<?php echo h($html_lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="60;url=https://filecheck.zscaler.com/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – Sandbox URLs</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #242424;
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .logo img {
            display: block;
            margin: 0 auto 16px;
            max-width: 360px;
            width: 100%;
            height: auto;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #2b2b2b;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 { color: #5bc0de; margin-top: 0; }
        p { font-size: 16px; line-height: 1.45; }
        a { color: #ffcc00; text-decoration: none; }
        a:hover { text-decoration: underline; }
        ul { padding-left: 20px; }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            margin-top: 12px;
            margin-bottom: 12px;
        }
        .btn {
            display: block;
            text-align: center;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 700;
            background: #5bc0de;
            color: #1a1a1a;
        }
        .note, .small {
            color: #c8c8c8;
            font-size: 13px;
        }
        .callout {
            margin-top: 16px;
            background-color: #333333;
            padding: 12px;
            border: 1px solid #444444;
        }
        .details {
            margin-top: 20px;
            background-color: #333333;
            padding: 10px;
            border: 1px solid #444444;
        }
        .details p {
            font-size: 14px;
            margin: 6px 0;
            word-break: break-word;
        }
        .muted { color: #a9a9a9; }
        code {
            background: #1f1f1f;
            padding: 2px 6px;
            border-radius: 4px;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
        </div>

        <h1>Access Restricted – Sandbox URL</h1>

        <p>You're attempting to use a third-party file sandboxing or checking service that is not permitted. To ensure consistent security controls and privacy protection, please use our approved Zscaler FileCheck service.</p>

        <p class="note">You’ll be redirected automatically in 60 seconds.</p>

        <div class="grid">
            <a class="btn" href="https://filecheck.zscaler.com/" target="_blank" rel="noopener">Go to Zscaler FileCheck</a>
        </div>

        <h2>Why this change?</h2>
        <ul>
            <li>Centralized scanning with company-approved security policies.</li>
            <li>Reduced risk of data exposure to untrusted third parties.</li>
            <li>Aligned with our Acceptable Use and Data Protection policies.</li>
        </ul>

        <div class="callout">
            <strong>New to FileCheck?</strong>
            Review the official Zscaler guide on how to use the Sandbox Scanning Portal:
            <br>
            <a href="https://help.zscaler.com/zia/using-sandbox-scanning-portal" target="_blank" rel="noopener">Using the Sandbox Scanning Portal – ZIA Help</a>
        </div>

        <div class="details">
            <h2>Support Information</h2>
            <p><strong>Attempted URL:</strong> <code><?php echo val($url); ?></code></p>
            <p><strong>Reason:</strong> <?php echo val($reason); ?> <span class="muted">(<?php echo val($reason_code); ?>)</span></p>
            <p><strong>Action:</strong> <?php echo val($action); ?></p>
            <p><strong>Policy Kind:</strong> <?php echo val($kind); ?></p>
            <p><strong>Category:</strong> <?php echo val($cat); ?></p>
            <p><strong>Rule ID:</strong> <?php echo val($rule); ?></p>
            <p><strong>User:</strong> <?php echo val($user); ?></p>
            <p><strong>Location ID:</strong> <?php echo val($locid); ?></p>
            <p><strong>Referer:</strong> <code><?php echo val($referer); ?></code></p>
            <p><strong>Time-bound:</strong> <?php echo val($timebound_label); ?></p>
            <p><strong>Language:</strong> <?php echo val($lang); ?></p>
            <p><strong>ZSQ:</strong> <?php echo val($zsq_raw); ?></p>
            <p><strong>RID (parsed):</strong> <?php echo val($rid); ?></p>
        </div>
    </div>
</body>
</html>
