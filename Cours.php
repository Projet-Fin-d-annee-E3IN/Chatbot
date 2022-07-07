<?php
    require 'Connexion.php';
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

        function addCours($nom, $sujet, $quest){
            $pdo = connecDataBase();
            $data = [
                'nom' => $nom,
                'sujet' => $sujet,
            ];
            $sql = "INSERT INTO Cours (nom, sujet) VALUES (:nom, :sujet)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);
            $data = [
                'lecon' => $lecon,
            ];

            $pdo = connecDataBase();
            $sql = "INSERT INTO Lecon (apprentissage) VALUES (:lecon)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute($data);
            if(getIdLecon() != NULL)
            {
                $data = [
                    'idLecon' => $quest.getIdLecon(),
                    'question' => $ques.getQuestion(),
                    'reponse' => $quest.getReponse(),
                ];
            }
            else {
                $data = [
                    'idLecon' => 'NULL',
                    'question' => $ques.getQuestion(),
                    'reponse' => $quest.getReponse(),
                ];
            }
            $pdo = connecDataBase();
            $sql = "INSERT INTO Question () VALUES (:lecon)";
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