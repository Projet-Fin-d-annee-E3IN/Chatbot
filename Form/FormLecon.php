<?php require_once '../Connexion.php'?> 


<html lang="fr">
    <h1>Saisie des leçon du cours</h1>
<form action="FormLecon.traitement.php" method="post">
 <p class="blocktext">
 <a>Selectionner a quelle cours appartien cette lecon</a>
 <br>
 <br>
 <select name="cours" id="cours">
    <?php
    $listCours = listCours(); 
    foreach ($listCours as $cours):
        ?>

        <option value="<?php echo $cours['idCours'] ?>">
            <?php echo $cours['nom'] ?>
        </option>

        <?php endforeach; ?>
</select>
<br>
<br>
    <a>Nom de la leçon :</a>
 </br>
    <input type="text" name="nomLecon">
</br>
</br>
<a>Veuillez saisir le cours :</a>
</br>
    <textarea type="text" name="textLecon" style="text-align : center" ></textarea>
</br>
</br>
<input type="submit" name="lecon" value="Autre leçon">
<input type="submit" name="lecon" value="Question Leçon">
<input type="submit" name="lecon" value="Cours fini">
</p>
</form>	


</html>

<style>
    h1{
        text-align: center
    }

    p.blocktext{
        text-align: center;
    }
    textarea{
        padding: 100px;
    max-width: 100%;
    border-radius: 2px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
    }
</style>