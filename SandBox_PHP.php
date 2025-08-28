<?php
$url = $_GET['url'];
$referer = $_GET['referer'];
$reason = $_GET['reason'];
$reason_code = $_GET['reasoncode'];
$timebound = $_GET['timebound'];
$action = $_GET['action'];
$kind = $_GET['kind'];
$rule = $_GET['rule'];
$cat = $_GET['cat'];
$user = $_GET['user'];
$lang = $_GET['lang'];
$zsq = explode("zsq", $_GET['zsq']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=https://filecheck.zscaler.com/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – Sandbox URLs</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #2b2b2b;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 { color: #5bc0de; }
        p { font-size: 16px; }
        a { color: #ffcc00; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .cta {
            display: inline-block; margin-top: 12px; padding: 10px 16px;
            background: #5bc0de; color: #1a1a1a; border-radius: 6px; font-weight: 600;
        }
        .useful-links { margin-top: 20px; }
        .details {
            margin-top: 20px; background-color: #333333;
            padding: 10px; border: 1px solid #444444;
        }
        .details p { font-size: 14px; margin: 5px 0; }
        .small { color: #c8c8c8; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Access Restricted – Sandbox URL</h1>
        <p>You're attempting to use a third-party file sandboxing or checking service that is not permitted. To ensure consistent security controls and privacy protection, please use our approved Zscaler FileCheck service.</p>
        <p class="small">You’ll be redirected automatically in 5 seconds.</p>
        <a class="cta" href="https://filecheck.zscaler.com/" target="_blank" rel="noopener">Go to Zscaler FileCheck</a>

        <div class="useful-links">
            <h2>Why this change?</h2>
            <ul>
                <li>Centralized scanning with company-approved security policies.</li>
                <li>Reduced risk of data exposure to untrusted third parties.</li>
                <li>Aligned with our Acceptable Use and Data Protection policies.</li>
            </ul>
        </div>

        <div class="details">
            <h2>Support Information:</h2>
            <p><strong>Attempted URL:</strong> <?php echo htmlspecialchars($url); ?></p>
            <p><strong>Reason:</strong> <?php echo htmlspecialchars($reason); ?> (<?php echo htmlspecialchars($reason_code); ?>)</p>
            <p><strong>Action Taken:</strong> <?php echo htmlspecialchars($action); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($cat); ?></p>
            <p><strong>Rule:</strong> <?php echo htmlspecialchars($rule); ?></p>
            <p><strong>User:</strong> <?php echo htmlspecialchars($user); ?></p>
            <p><strong>Referer:</strong> <?php echo htmlspecialchars($referer); ?></p>
            <p><strong>Time-bound:</strong> <?php echo htmlspecialchars($timebound); ?></p>
        </div>
    </div>
</body>
</html>