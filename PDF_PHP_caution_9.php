<?php
// Retrieve GET parameters dynamically
$url = $_GET['url'] ?? ''; // The original URL the user tried to access
$referer = $_GET['referer'] ?? '';
$reason = $_GET['reason'] ?? '';
$reason_code = $_GET['reasoncode'] ?? '';
$timebound = $_GET['timebound'] ?? '';
$action = $_GET['action'] ?? '';
$kind = $_GET['kind'] ?? '';
$rule = $_GET['rule'] ?? '';
$cat = $_GET['cat'] ?? '';
$user = $_GET['user'] ?? '';
$lang = $_GET['lang'] ?? '';
$zsq = isset($_GET['zsq']) ? preg_split('/zsq/', $_GET['zsq']) : [];

// Dynamically extract session and token data from the GET parameters (Zscaler will provide these)
$ordtok = $_GET['_ordtok'] ?? ''; // _ordtok comes from Zscaler's session data
$sm_rid = $_GET['_sm_rid'] ?? ''; // _sm_rid is also generated dynamically
$orig_url = $_GET['_orig_url'] ?? $url;  // Fallback to the original URL if not provided
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – PDF Editing</title>
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
        <h1>Access Restricted</h1>
        <p>It appears you're trying to access a restricted URL.</p>
        <p>To ensure your data remains protected and complies with our Acceptable Use Policy, please use trusted and secure tools like Adobe Acrobat or Microsoft Word for PDF editing. These tools work locally and help minimize the risk of unauthorized access or data leakage.</p>
        <p>By using approved applications, you help safeguard both your personal information and company data.</p>

        <form id="continue_action" method="GET" action="https://gateway.zscalerbeta.net:443/_sm_ccik">
            <!-- Pass necessary parameters to Zscaler -->
            <input type="hidden" name="_ordtok" value="<?php echo $ordtok; ?>">
            <input type="hidden" name="_sm_rid" value="<?php echo $sm_rid; ?>">
            <input type="hidden" name="_orig_url" value="<?php echo $orig_url; ?>">
            <input type="hidden" name="_sm_url" value="<?php echo $url; ?>">
            <input type="hidden" name="_sm_cat" value="<?php echo $cat; ?>">
            <input class="btn" type="submit" value="Continue to previous destination" id="submitButton">
        </form>

        <div class="details">
            <h2>Support Information:</h2>
            <p><strong>Attempted URL:</strong> <?php echo $url; ?></p>
            <p><strong>Reason:</strong> <?php echo $reason; ?> (<?php echo $reason_code; ?>)</p>
            <p><strong>Action Taken:</strong> <?php echo $action; ?></p>
            <p><strong>Category:</strong> <?php echo $cat; ?></p>
            <p><strong>Rule:</strong> <?php echo $rule; ?></p>
            <p><strong>User:</strong> <?php echo $user; ?></p>
            <p><strong>Referer:</strong> <?php echo $referer; ?></p>
            <p><strong>Time-bound:</strong> <?php echo $timebound; ?></p>
        </div>
    </div>
</body>
</html>
