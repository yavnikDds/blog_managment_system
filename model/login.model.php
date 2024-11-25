<?php

class LOGIN
{
    public $PDO = null;
    public function __construct($PDO)
    {
        $this->PDO = $PDO;
    }
    public function read_single_user_data($email, $password)
    {
        $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        try {
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo "error:" . $e->getMessage();
        }
    }
}
