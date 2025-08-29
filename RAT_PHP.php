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
    <!-- Default to TeamViewer after 60s; users can pick AnyDesk or GoTo below -->
    <meta http-equiv="refresh" content="60;url=https://www.teamviewer.com/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – Remote Access Tools</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
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
        <h1>Access Restricted – Remote Access Tools (RAT)</h1>
        <p>The tool you attempted to access is not approved. Many public remote access tools have lower security specifics and can expose systems to elevated risk.</p>
        <p>We allow only the following enterprise-approved solutions:</p>

        <div class="grid">
            <a class="btn" href="https://www.teamviewer.com/" target="_blank" rel="noopener">TeamViewer</a>
            <a class="btn" href="https://anydesk.com/" target="_blank" rel="noopener">AnyDesk</a>
            <a class="btn" href="https://www.goto.com/" target="_blank" rel="noopener">GoTo</a>
        </div>

        <p class="note">You’ll be redirected to <strong>TeamViewer</strong> automatically in 6 seconds, or choose another approved option above.</p>

        <h2>Why only these?</h2>
        <ul>
            <li>Hardened security configurations and enterprise controls.</li>
            <li>Vendor support, patch cadence, and audit capabilities.</li>
            <li>Alignment with our compliance and monitoring requirements.</li>
        </ul>
        
        <form id="continue_action" method="GET" action="https://gateway.zscaler.net:443/_sm_ctn">
                <input type="hidden" name="_sm_url" value="<?php $_GET['url'];?>">
                <input type="hidden" name="_sm_rid" value="<?php split('zsq', $_GET['zsq']);?>">
                <input type="hidden" name="_sm_cat" value="<?php $_GET['cat'];?>">
                <input type="submit" value="Continue" id="submitButton">
            </form> 

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


