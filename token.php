<?php

class CsrfTokenManager {
    const MAX_AGE = 60 * 0.1; 

    public static function generateToken() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time(); 
        return $token;
    }

    public static function verifyToken($token) {
        if (!isset($_SESSION['csrf_token'], $_SESSION['csrf_token_time'])) {
            return false;
        }

        $token_age = time() - $_SESSION['csrf_token_time'];
        if ($token === $_SESSION['csrf_token'] && $token_age < self::MAX_AGE) {
            unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);
            return true;
        }
        return false;
    }
}
?>
