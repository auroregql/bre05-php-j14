<?php

class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        $host = 'db.3wa.io';      
        $dbname = 'auroregicquelcolleu_phpj14'; 
        $user = 'auroregicquelcolleu';  
        $password = '514b3eda307289da5b9ccb0a4735bcd4';

        try {
            $this->db = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $password
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}

?>