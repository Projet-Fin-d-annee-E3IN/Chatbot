<?php
include '../Connexion.php';
    class Cours
    {
        public $idCours;
        public $nom;
        public $lecon;


        function __construct($nom) 
        {
            $this->nom = $nom;
            $this->lecon = [];
        }

        public function getNom(){
            return $this->nom;
        }

        public function setNom($nom){
            $this->nom = $nom;
        }

        function addCours(){
            $pdo = connecDataBase();
            $data = [
                ':nom' => $this->nom,
            ];
            $sql = "INSERT INTO Cours (nom) VALUES (:nom)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);
        }
        function deleteCours($id){
            
        }
        function updateCours($id, $nom, $sujet, $quest){

        }
        function listeCours(){

        }

        function addQuestion($quest){
            $pdo = connecDataBase();
            // Definir lorsque l'on de ne veut pas modifier une valeur
            if($nom == NULL){
                $nom = getNom();
            }
            if($sujet == NULL){
                $sujet = getSujet();
            }
            if($sujet == NULL){
                $quest = getQuestion();
            }
            $data = [
                'nom' => $nom,
                'sujet' => $sujet,
                'quest' => $quest,
            ];
        }

        function getQuestion(){

        }
        
    }
?>