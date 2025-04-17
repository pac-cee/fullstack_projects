<?php
trait ValidationTrait {
    public function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    public function isNumber($val) {
        return is_numeric($val);
    }
}
class User {
    use ValidationTrait;
}
$u = new User();
echo $u->isEmail('test@example.com') ? 'Valid' : 'Invalid';
