<?php
//'user' à modifier en remplaçant par le nom de la table (ctrl+d pour modifier plusieurs, Alt pour déselectionner)

class familierManager
{
    private $pdo;

    const ADDRESS = 'mysql:host=localhost;dbname=hackaton2'; //Valeur du dbname à modifier en fonction du nom de la base de donnée
    const USER = 'adrien';
    const PASS = 'adrien';

    public function __construct()
    {
        try {
            $this->pdo = new PDO(self::ADDRESS, self::USER, self::PASS, array(PDO::ATTR_PERSISTENT => true));
        } catch (\Throwable $th) {
            die('error sql connection' . $th);
        }
    }


    public function readAll()
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM familier'); //user à modifier => nom de la table
            $pdoStatement->execute();
            $contact = $pdoStatement->fetchAll();
            return $contact;
        } catch (\Throwable $th) {
            die('error readAll connection' . $th);
        }
    }

    public function read($pseudo)
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM familier WHERE nom_familier = ?');
            $pdoStatement->execute([$pseudo]);
            $contact = $pdoStatement->fetch();
            return $contact;
        } catch (\Throwable $th) {
            die('error read connection' . $th);
        }
    }

    public function create($pseudo, $pass, $date) // parametre à renseigner => nom des champs (ctrl+d pour modifier dans execute)
    {
        try {
            $pdoStatement = $this->pdo->prepare('INSERT INTO hero(pseudo,pass,d) VALUES (?,?,?)');
            $pdoStatement->execute([$pseudo, $pass, $date]);
            echo 'profil créé';
        } catch (\Throwable $th) {
            die('error create connection' . $th);
        }
    }

    public function update($pseudo, $pass, $d) // parametre à renseigner => nom des champs (ctrl+d pour modifier dans execute)
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE hero SET pass=?,d=? WHERE pseudo = ?');
            $pdoStatement->execute([$pass, $d, $pseudo]);
            echo 'profil mis à jour';
        } catch (\Throwable $th) {
            die('error uptade connection' . $th);
        }
    }
}
