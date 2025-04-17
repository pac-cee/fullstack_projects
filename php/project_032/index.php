<?php
class Validator {
    public static function isString($val) {
        return is_string($val);
    }
    public static function isNumber($val) {
        return is_numeric($val);
    }
    public static function isEmail($val) {
        return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
    }
}
// Example usage
echo Validator::isEmail('alice@example.com') ? "Valid" : "Invalid";
