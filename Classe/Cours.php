<?php
include '../Connexion.php';
class Cours
{
    public $idCours;
    public $nom;


    function __construct($nom) 
    {
        $this->nom = $nom;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }


    //Recupérer la liste des leçons du cours
    function getListLecons(){
        $pdo = connecDataBase();
        $req = 'SELECT L.* FROM Lecon L, Cours C WHERE C.idCours = L.idCours';
        $pdoStatement = $pdo->query($req);
        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

//Ajouter un cours
    function addCours(){
        $pdo = connecDataBase();
        $data = [
            ':nom' => $this->nom
        ];
        $sql = "INSERT INTO Cours (nom) VALUES (:nom)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }

    function deleteCours($idCours){
        
        //Supprimer la leçon pour pouvoir supprimer le cours
        $listeLecons = getListLecons();
        foreach($listeLecons as $lecon){
            deleteLecon($lecon['idLecon']);
        }

        $pdo = connecDataBase();
        //Bind les données pour pouvoir les rajouter dans la requête 
        $data = [
            ':idCours'=>$idCours,
        ];
        //Créer la requête
        $sql = "DELETE FROM Cours WHERE idCours=:idCours";
        $stmt= $pdo->prepare($sql);
        //Envoyer la requête avec les binds que l'on à créé précédement
        $stmt->execute($data);
    }
    //Modifier les valeurs du cours 
    function updateCours($nom, $sujet){
        $pdo = connecDataBase();
        $data = [
            ':idCours'=>$this->idCours,
            ':nom'=>$nom,
            ':sujet'=>$sujet,
        ];
        $sql = "UPDATE Cours SET nom=:nom, sujet=:sujet WHERE idCours=:idCours";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
    }


    //Pouvoir supprimer une leçon dans les cours
    function deleteLecon($id){
        $lecon = new Lecon('','');
        $lecon.deleteLecon($id);
    }
    
}
?>