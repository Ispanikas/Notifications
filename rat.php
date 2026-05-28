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

$CONTINUE_ACTION_URL = 'https://gateway.zscloud.net:443/_sm_ctn';

// Fixed approved destination for the auto-redirect nudge
$REDIRECT_URL = 'https://www.teamviewer.com/';
?>
<!DOCTYPE html>
<html lang="<?php echo h($html_lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60;url=<?php echo h($REDIRECT_URL); ?>">
    <title>Access Restricted &ndash; Remote Access Tools</title>
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
        .btn {
            display: block;
            width: auto;
            text-align: center;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 700;
            background: #5bc0de;
            color: #1a1a1a;
            border: 0;
            cursor: pointer;
            margin-top: 10px;
            box-sizing: border-box;
            text-decoration: none;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .grid .btn {
            flex: 1 1 200px;
            margin-top: 0;
        }
        .note {
            color: #c8c8c8;
            font-size: 13px;
        }
        .callout {
            margin-top: 20px;
            background-color: #333333;
            padding: 12px;
            border-left: 4px solid #5bc0de;
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
        .continue { margin-top: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
        </div>

        <h1>Access Restricted &ndash; Remote Access Tools (RAT)</h1>
        <p>The tool you attempted to access is not approved. Many public remote access tools can expose systems to elevated risk.</p>
        <p>We advise using only the following enterprise-approved solutions:</p>

        <div class="grid">
            <a class="btn" href="https://www.teamviewer.com/" target="_blank" rel="noopener">TeamViewer</a>
            <a class="btn" href="https://www.goto.com/" target="_blank" rel="noopener">GoTo</a>
        </div>

        <p class="note">You&rsquo;ll be redirected to <strong>TeamViewer</strong> automatically in 60 seconds, or choose another approved option above.</p>

        <h2>Why only these?</h2>
        <ul>
            <li>Hardened security configurations and enterprise controls.</li>
            <li>Vendor support, patch cadence, and audit capabilities.</li>
            <li>Alignment with our compliance and monitoring requirements.</li>
        </ul>

        <!-- "Continue" button (caution policy: permits a continue action) -->
        <form class="continue" method="GET" action="<?php echo h($CONTINUE_ACTION_URL); ?>">
            <input type="hidden" name="_sm_url" value="<?php echo h($url); ?>">
            <input type="hidden" name="_sm_rid" value="<?php echo h($rid); ?>">
            <input type="hidden" name="_sm_cat" value="<?php echo h($cat); ?>">
            <button class="btn" type="submit">Continue to previous destination</button>
        </form>

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
