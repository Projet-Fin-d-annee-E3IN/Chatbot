<?php
include '../Connexion.php';

class Lecon
{
    public $idLecon;
    public $nomLecon;
    public $text;
    public $idCours;
    
    function __construct($nomLecon,$text,$idCours) 
    {
        $this->nomLecon = $nomLecon;
        $this->text = $text;
        $this->idCours = $idCours;
    }

    function getIdLecon(){
        return $this->idLecon;
    }

    function setIdLecon($idLecon){
        $this->idLecon=$idLecon;
    }

    function getText(){
        return $this->text;
    }
    
    function setText($text){
        $this->text=$text;
    }

    function getIdCours(){
        return $this->idCours;
    }
    
    function setIdCours($idCours){
        $this->idCours=$idCours;
    }
    //Récupérer la liste des questions lié à l'exercice
    function getListQuestions(){
        $pdo = connecDataBase();
        $req = 'SELECT Q.* FROM Lecon L, Question Q WHERE Q.idLecon = L.idLecon';
        $pdoStatement = $pdo->query($req);
        return  $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    //Créer une leçon
    function addQuestion()
    {
        $pdo = connecDataBase();
        $data = [
            ':nomLecon' => $this->nomLecon,
            ':text' => $this->text,
            ':idCours' => $this->idCours,
        ];
        $sql = "INSERT INTO lecon (nomLecon,text,idCours) VALUES (:nomLecon,:text,:idCours)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
    //Supprimer une leçon
    function deleteLecon($idLecon)
    {
        //Supprimer les questions pour pouvoir supprimer la leçon
        $listeQuestions = getListQuestions();
        foreach($listeQuestions as $quest){
            deleteQuestion($quest['idQuest']);
        }

        $pdo = connecDataBase();
        $data = [
            ':idLecon'=>$idLecon,
        ];
        $sql = "DELETE FROM Lecon WHERE idLecon=:idLecon";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);

    }
    //Modifier la leçon
    function updateLecon(){
        $pdo = connecDataBase();
        $data = [
            ':idLecon'=>$this->idLecon,
            ':text'=>$this->text,  
        ];
        $sql = "UPDATE Lecon SET text=:text WHERE idLecon=:idlecon";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
}


?>