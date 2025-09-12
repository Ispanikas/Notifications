<?php
// -------- read incoming (no notices in PHP 8) --------
$url         = $_GET['url']        ?? '';
$referer     = $_GET['referer']    ?? '';
$reason      = $_GET['reason']     ?? '';
$reason_code = $_GET['reasoncode'] ?? '';
$timebound   = $_GET['timebound']  ?? '';
$actionTaken = $_GET['action']     ?? '';
$kind        = $_GET['kind']       ?? '';
$rule        = $_GET['rule']       ?? '';
$cat         = $_GET['cat']        ?? '';
$user        = $_GET['user']       ?? '';
$lang        = $_GET['lang']       ?? '';
$zsq         = $_GET['zsq']        ?? '';   // <-- send back unchanged

// -------- build values exactly how Zscaler expects --------
// Decode url/cat so the browser will encode them once on submit (avoids double-encoding & signature mismatches).
$sm_url = $url !== '' ? rawurldecode($url) : '';
$sm_cat = $cat !== '' ? rawurldecode($cat) : '';
$sm_rid = $zsq; // keep '...zsq' suffix

// Change this if your tenant uses a different cloud (e.g., gateway.zscloud.net)
$gatewayHost = 'gateway.zscaler.net';

$e = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Access Restricted – AI Services</title>
<style>
  body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#242424;color:#f0f0f0;margin:0;padding:20px;}
  .logo img{display:block;margin:0 auto 16px;max-width:360px;width:100%;height:auto;}
  .container{max-width:700px;margin:50px auto;background:#2b2b2b;padding:20px;box-shadow:0 0 15px rgba(0,0,0,.5);}
  h1{color:#5bc0de;} p{font-size:16px;} a{color:#ffcc00;text-decoration:none;} a:hover{text-decoration:underline;}
  .btn{display:inline-block;text-align:center;padding:12px 16px;border-radius:8px;font-weight:700;background:#5bc0de;color:#1a1a1a;border:0;cursor:pointer;}
  .details{margin-top:20px;background:#333;padding:10px;border:1px solid #444;}
  .details p{font-size:14px;margin:5px 0;} ul{padding-left:20px;} form{margin-top:16px;}
</style>
</head>
<body>
<div class="container">
  <div class="logo">
    <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
  </div>
  <h1>Access Restricted – AI Services</h1>
  <p>You are attempting to access a public generative AI service. Please follow these guidelines to protect privacy, security, and compliance.</p>

  <h2>Responsible AI Use Guidelines</h2>
  <ul>
    <li><strong>Privacy & Cyber-Security:</strong> never input confidential data.</li>
    <li><strong>Validate outputs</strong> before using them.</li>
    <li><strong>Compliance:</strong> share responsibly.</li>
    <li><strong>Disclose AI assistance</strong> when applicable.</li>
    <li><strong>Keep human oversight</strong> in the loop.</li>
  </ul>

  <div class="useful-links">
    <strong>Suggestion:</strong> Prefer <strong>Corporate Copilot</strong> when possible.
    <br><a class="btn" href="https://m365.cloud.microsoft.mcas.ms/chat/" target="_blank" rel="noopener">Open Corporate Copilot</a>
  </div>

  <!-- Continue: let the browser encode ONCE -->
  <form id="continue_action" method="GET" action="https://<?= $e($gatewayHost) ?>/_sm_ctn">
    <input type="hidden" name="_sm_url" value="<?= $e($sm_url) ?>">
    <input type="hidden" name="_sm_rid" value="<?= $e($sm_rid) ?>">
    <input type="hidden" name="_sm_cat" value="<?= $e($sm_cat) ?>">
    <input type="submit" value="Continue" id="submitButton" class="btn">
  </form>

  <div class="details">
    <h2>Support Information:</h2>
    <p><strong>Attempted URL:</strong> <?= $e($url) ?></p>
    <p><strong>Reason:</strong> <?= $e($reason) ?> (<?= $e($reason_code) ?>)</p>
    <p><strong>Action Taken:</strong> <?= $e($actionTaken) ?></p>
    <p><strong>Category:</strong> <?= $e($cat) ?></p>
    <p><strong>Rule:</strong> <?= $e($rule) ?></p>
    <p><strong>User:</strong> <?= $e($user) ?></p>
    <p><strong>Referer:</strong> <?= $e($referer) ?></p>
    <p><strong>Time-bound:</strong> <?= $e($timebound) ?></p>
  </div>
</div>
</body>
</html>
