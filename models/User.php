<?php
require_once ("Model.php");
class User extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }
    public function checkEmailExists($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}
?>