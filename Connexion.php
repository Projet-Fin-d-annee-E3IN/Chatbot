<?php

class Connexion {
	private $login;
	private $pass;
	private $connec;

	public function __construct($db, $login ='root', $pass=''){
		$this->login = $login;
		$this->pass = $pass;
		$this->db = $db;
		$this->connexion();
	}

	private function connexion(){
    
        try
        {
            // On se connecte à MySQL
            $mysqlClient = new PDO('mysql:host=localhost;dbname=projetlab;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
                die('Erreur : '.$e->getMessage());
        }
        
        // Si tout va bien, on peut continuer
        
        // On récupère tout le contenu de la table recipes
        $sqlQuery = 'SELECT * FROM cours';
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        
        // On affiche chaque recette une à un
         foreach ($recipes as $recipe) {
            ?>
                <p><?php echo $recipe['author']; ?></p>
            <?php
            }        
	}

	public function q($sql,Array $cond = null){
		$stmt = $this->connec->prepare($sql);

		if($cond){
			foreach ($cond as $v) {
				$stmt->bindParam($v[0],$v[1],$v[2]);
			}
		}

		$stmt->execute();

		return $stmt->fetchAll();
		$stmt->closeCursor();
		$stmt=NULL;
	}


}