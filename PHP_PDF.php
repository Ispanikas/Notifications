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
?>
<!DOCTYPE html>
<html lang="<?php echo h($html_lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – PDF/Document Editing</title>
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

        <h1>Access Restricted</h1>

        <p>It appears you're trying to access an online PDF/Document editing service that isn't permitted by our policies. Using such services can pose security risks, including potential exposure of sensitive data to third-party platforms that may not meet our security standards.</p>

        <p>To ensure your data remains protected and compliant with our Acceptable Use Policy, please use trusted and secure tools like <strong>Adobe Acrobat</strong> or <strong>Microsoft Word</strong> for PDF/Document editing. These tools work locally and help minimize the risk of unauthorized access or data leakage.</p>

        <p>By using approved applications, you help safeguard both your personal information and company data.</p>

        <div class="useful-links">
            <h2>Recommended Links</h2>
            <ul>
                <li><a href="https://support.microsoft.com/en-us/office/edit-a-pdf-b2d1d729-6b79-499a-bcdb-233379c2f63a" target="_blank" rel="noopener">Edit a PDF with MS Word</a></li>
                <li><a href="https://support.microsoft.com/en-us/office/convert-or-save-to-pdf-7d88593b-d509-4225-a05a-076723a40beb" target="_blank" rel="noopener">Convert or Save to PDF with MS Word</a></li>
            </ul>
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
