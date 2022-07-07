<?php
include '../Connexion.php';
class Question
{
    private $idQuestion;
    private $reponse;
    private $quest;
    private $idLecon;
    
    function __construct($quest, $reponse, $idLecon)
    {
        $this->quest = $quest;
        $this->reponse = $reponse;
        $this->idLecon = $idLecon;
    }
    
    function getIdQuestion(){
        return $this->idQuestion;
    }
    function setIdQuestion($idQuestion){
        $this->idQuestion=$idQuestion;
    }
    function getReponse(){
        return $this->reponse;
    }
    function setReponse($reponse){
        $this->reponse=$reponse;
    }
    function getQuest(){
        return $this->quest;
    }
    function setQuest($quest){
        $this->quest=$quest;
    }
    function getIdLecon(){
        return $this->idLecon;
    }
    function setIdLecon($idLecon){
        $this->idLecon=$idLecon;
    }
    

    function addQuestion(){
        $pdo = connecDataBase();
        $data = [
            ':quest' => $this->quest,
            ':reponse' => $this->reponse,
            ':idLecon' => $this->idLecon,
        ];
        $sql = "INSERT INTO question (quest,reponse,idLecon) VALUES (:quest,:reponse,:idLecon)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
    function deleteQuestion($idQuestion){
        $pdo = connecDataBase();
        $data = [
            ':idQuestion'=>$idQuestion,
        ];
        $sql = "DELETE FROM Question WHERE idQuestion=:idQuestion";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
    function updateQuestion($reponse, $quest){
        $pdo = connecDataBase();
        $data = [
            ':idQuestion'=>$this->idQuestion,
            ':reponse'=>$reponse,
            ':quest'=>$quest,
        ];
        $sql = "UPDATE Question SET question=:question, reponse=:reponse WHERE idQuestion=:idQuestion";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }
}

?>