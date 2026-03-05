<?php
function queryParam(string $key): string
{
    return isset($_GET[$key]) ? (string) $_GET[$key] : '';
}

$url = queryParam('url');
$referer = queryParam('referer');
$reason = queryParam('reason');
$reason_code = queryParam('reasoncode');
$timebound = queryParam('timebound');
$action = queryParam('action');
$kind = queryParam('kind');
$rule = queryParam('rule');
$cat = queryParam('cat');
$user = queryParam('user');
$locid = queryParam('locid');
$lang = queryParam('lang');
$zsq = queryParam('zsq');
$zsq_parts = explode('zsq', $zsq, 2);
$sm_rid = $zsq_parts[0];
?>
<!DOCTYPE html>
<html lang="en">
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
        h1 { color: #5bc0de; }
        p { font-size: 16px; }
        a { color: #ffcc00; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-top: 12px; }
        .btn {
            display: block; text-align: center; padding: 12px 16px; border-radius: 8px; font-weight: 700;
            background: #5bc0de; color: #1a1a1a;
        }
        .note { color: #c8c8c8; font-size: 13px; }
        .details {
							 
            margin-top: 20px; background-color: #333333;
						  
            padding: 10px; border: 1px solid #444444;
        }
        .details p { font-size: 14px; margin: 5px 0; }
        ul { padding-left: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
        <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
        </div>
        <h1>Access Restricted – Sandbox URL</h1>
        <p>You're attempting to use a third-party file sandboxing or checking service that is not permitted. To ensure consistent security controls and privacy protection, please use our approved Zscaler FileCheck service.</p>
        <p class="small">You’ll be redirected automatically in 60 seconds.</p>
        <a class="cta" href="https://filecheck.zscaler.com/" target="_blank" rel="noopener">Go to Zscaler FileCheck</a>

        <div class="useful-links">
            <h2>Why this change?</h2>
            <ul>
                <li>Centralized scanning with company-approved security policies.</li>
                <li>Reduced risk of data exposure to untrusted third parties.</li>
                <li>Aligned with our Acceptable Use and Data Protection policies.</li>
            </ul>
        </div>

                <!-- Guide suggestion -->
        <div class="note-box">
            <strong>New to FileCheck?</strong> Review the official Zscaler guide on how to use the Sandbox Scanning Portal:
            <br><a href="https://help.zscaler.com/zia/using-sandbox-scanning-portal" target="_blank" rel="noopener">Using the Sandbox Scanning Portal – ZIA Help</a>
        </div>

        <div class="details">
            <h2>Support Information:</h2>
            <p><strong>Attempted URL:</strong> <?php echo htmlspecialchars($url); ?></p>
            <p><strong>Reason:</strong> <?php echo htmlspecialchars($reason); ?> (<?php echo htmlspecialchars($reason_code); ?>)</p>
            <p><strong>Action Taken:</strong> <?php echo htmlspecialchars($action); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($cat); ?></p>
            <p><strong>Rule:</strong> <?php echo htmlspecialchars($rule); ?></p>
            <p><strong>User:</strong> <?php echo htmlspecialchars($user); ?></p>
            <p><strong>Policy Kind:</strong> <?php echo htmlspecialchars($kind); ?></p>
            <p><strong>Location ID:</strong> <?php echo htmlspecialchars($locid); ?></p>
            <p><strong>Language:</strong> <?php echo htmlspecialchars($lang); ?></p>
            <p><strong>ZSQ:</strong> <?php echo htmlspecialchars($zsq); ?></p>
            <p><strong>Referer:</strong> <?php echo htmlspecialchars($referer); ?></p>
            <p><strong>Time-bound:</strong> <?php echo htmlspecialchars($timebound); ?></p>
        </div>
    </div>
</body>

</html>


