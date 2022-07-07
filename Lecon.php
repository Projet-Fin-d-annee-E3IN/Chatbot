<?php
include 'Connexion.php';
class Lecon
{
    public $idLecon;
    public $text;
    public $idCours;
    function __construct($text,$idCours) 
    {
        // $this->idLecon = $idLecon;
        $this->text = $text;
        $this->idCours = $idCours;
    }
    
    function addQuestion($text,$idCours)
    {
        $pdo = connecDataBase();
        $data = [
            ':text' => $text,
            ':idCours' => $idCours,
        ];
        $sql = "INSERT INTO lecon (text,idCours) VALUES (:text,:idCours)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
    function deleteQuestion($idLecon)
    {
        $pdo = connecDataBase();
        $data = [
            'idLecon'=>$idLecon,
        ];
        $sql = "DELETE FROM Lecon WHERE idLecon=:idLecon";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
    function updateQuestion($idLecon,$text){
        $pdo = connecDataBase();
        $data = [
            'idLecon'=>$idLecon,
            'text'=>$text,  
        ];
        $sql = "UPDATE Lecon SET text=:text WHERE idLecon=:idlecon";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }



    
}

function listCours() {
    $lesLecons = array();
    $pdo = connecDataBase();
    
    if ($pdo != NULL)
    {
        $req = 'SELECT * FROM cours';
        $pdoStatement = $pdo->query($req);
        $lesLecons = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesLecons;
}


?>