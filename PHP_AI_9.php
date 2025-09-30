<?php
declare(strict_types=1);

/**
 * Caution / Responsible AI landing with Zscaler "Continue" integration
 * PHP 8+
 *
 * Key points:
 * - Uses the same host that served the page (action="/_sm_ctn") — no hardcoded POP.
 * - Preserves tokens exactly as received.
 * - Accepts both legacy (url,zsq,cat) and default (_sm_url,_sm_rid,_sm_cat) query names.
 * - Submits a top-level GET with only the three required params.
 */

// Basic security headers for the page itself (safe defaults; adjust as needed)
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('X-Frame-Options: DENY');

// Helper: first matching key from $_GET
$first = function(array $keys, string $default = ''): string {
    foreach ($keys as $k) {
        if (isset($_GET[$k]) && $_GET[$k] !== '') {
            // Cast scalars/arrays to string safely; Zscaler sends scalars
            return is_array($_GET[$k]) ? '' : (string)$_GET[$k];
        }
    }
    return $default;
};

// HTML escaper
$e = static fn(?string $v): string => htmlspecialchars((string)($v ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

// Required tokens for Continue
$sm_url = $first(['_sm_url', 'url']);
$sm_rid = $first(['_sm_rid', 'zsq']);   // Do NOT alter/normalize this token
$sm_cat = $first(['_sm_cat', 'cat']);

// Optional fields for display only
$reason      = $first(['reason']);
$reason_code = $first(['reasoncode']);
$actionTaken = $first(['action']);
$rule        = $first(['rule']);
$user        = $first(['user']);
$referer     = $first(['referer']);
$timebound   = $first(['timebound']);
$lang        = $first(['lang'], 'en');

// Optionally, you can show a warning if any of the three required tokens are missing
$missingTokens = [];
if ($sm_url === '') $missingTokens[] = '_sm_url/url';
if ($sm_rid === '') $missingTokens[] = '_sm_rid/zsq';
if ($sm_cat === '') $missingTokens[] = '_sm_cat/cat';
?>
<!DOCTYPE html>
<html lang="<?php echo $e($lang); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – AI Services</title>
    <style>
        :root {
            --bg: #242424;
            --panel: #2b2b2b;
            --ink: #f0f0f0;
            --muted: #c8c8c8;
            --accent: #5bc0de;
            --link: #ffcc00;
            --border: #444444;
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji", sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 760px;
            margin: 40px auto;
            background-color: var(--panel);
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.4);
        }
        .logo img {
            display: block;
            margin: 0 auto 16px;
            max-width: 320px;
            width: 100%;
            height: auto;
        }
        h1 { color: var(--accent); margin: 0 0 8px; font-size: 1.6rem; }
        h2 { color: var(--accent); font-size: 1.1rem; margin: 20px 0 8px; }
        p { font-size: 15px; line-height: 1.5; margin: 8px 0; }
        ul { margin: 8px 0 0; padding-left: 20px; }
        li { margin: 6px 0; }
        a { color: var(--link); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .btn {
            display: inline-block;
            text-align: center;
            padding: 12px 16px;
            border-radius: 10px;
            font-weight: 700;
            background: var(--accent);
            color: #101010;
            border: none;
            cursor: pointer;
        }
        .btn[disabled] {
            opacity: .6;
            cursor: not-allowed;
        }
        .note { color: var(--muted); font-size: 13px; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; margin: 14px 0 4px; }
        .details {
            margin-top: 20px;
            background-color: #333333;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
        }
        .kv { display: grid; grid-template-columns: 160px 1fr; gap: 6px 12px; }
        .kv div { font-size: 14px; }
        .warn {
            margin: 12px 0 0;
            padding: 10px 12px;
            border-radius: 10px;
            background: #4a2a2a;
            border: 1px solid #7a4242;
            color: #ffdede;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container" role="main">
        <div class="logo">
            <!-- Replace with your hosted asset or remove -->
            <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
        </div>

        <h1>Access Restricted – AI Services</h1>
        <p>You are attempting to access a public generative AI service. Please follow these guidelines to protect privacy, security, and compliance.</p>

        <h2>Responsible AI Use Guidelines</h2>
        <ul>
            <li><strong>Always Think Privacy &amp; Cyber-Security:</strong> Public AI platforms are public spaces. Anything you input can persist and be discoverable. <em>Never</em> provide confidential company data or sensitive information.</li>
            <li><strong>Always Check the Quality:</strong> AI outputs can be incomplete or incorrect. Validate all results before using them.</li>
            <li><strong>Always Think Compliance:</strong> Generative AI platforms may learn from user inputs. Once shared, you do not control how data may be reused, which can introduce legal and financial risk.</li>
            <li><strong>Always Label the Source of Data:</strong> If AI assisted your work, disclose it (e.g., “generated by use of ChatGPT”).</li>
            <li><strong>Always Use Responsibly:</strong> AI can boost efficiency, but relying on it for everything without human oversight raises business and ethical concerns.</li>
        </ul>

        <div class="actions">
            <a class="btn" href="https://m365.cloud.microsoft.mcas.ms/chat/" target="_blank" rel="noopener noreferrer">Open Corporate Copilot</a>

            <!-- Zscaler Continue: same host, top-level GET, only the 3 params -->
            <form id="continue_action" method="GET" action="https://gateway.zscalerbeta.net:443/_sm_ctn">
                <input type="hidden" name="_sm_url" value="<?php echo $e($sm_url); ?>">
                <input type="hidden" name="_sm_rid" value="<?php echo $e($sm_rid); ?>">
                <input type="hidden" name="_sm_cat" value="<?php echo $e($sm_cat); ?>">
                <input type="submit" value="Continue" class="btn" <?php echo $missingTokens ? 'disabled' : ''; ?>>
            </form>
        </div>

        <?php if ($missingTokens): ?>
            <div class="warn" role="alert">
                Missing required token(s): <strong><?php echo $e(implode(', ', $missingTokens)); ?></strong>.
                This page should be reached via a Zscaler caution link that includes these parameters.
            </div>
        <?php endif; ?>

        <div class="details" aria-label="Support information">
            <h2>Support Information</h2>
            <div class="kv">
                <div><strong>Attempted URL:</strong></div><div><?php echo $e($sm_url); ?></div>
                <div><strong>Reason:</strong></div><div><?php echo $e($reason); ?><?php echo $reason_code !== '' ? ' ('.$e($reason_code).')' : ''; ?></div>
                <div><strong>Action Taken:</strong></div><div><?php echo $e($actionTaken); ?></div>
                <div><strong>Category:</strong></div><div><?php echo $e($sm_cat); ?></div>
                <div><strong>Rule:</strong></div><div><?php echo $e($rule); ?></div>
                <div><strong>User:</strong></div><div><?php echo $e($user); ?></div>
                <div><strong>Referer:</strong></div><div><?php echo $e($referer); ?></div>
                <div><strong>Time-bound:</strong></div><div><?php echo $e($timebound); ?></div>
                <div><strong>Request ID (_sm_rid/zsq):</strong></div><div><?php echo $e($sm_rid); ?></div>
            </div>
            <p class="note">If you experience a loop, ensure the Continue button submits to <code>/&#95;sm_ctn</code> on the same host that served this page and that all three fields are present and unmodified.</p>
        </div>
    </div>
</body>
</html>
