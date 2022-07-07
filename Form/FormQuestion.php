
<?php require_once '../Connexion.php'?> 

<html lang="fr">
    <h1>Saisie des question de la leçon</h1>
<form action="FormQuestion.traitement.php" method="post">
 <p class="blocktext">
 <select name="lecon" id="cours">
    <?php
    $listNotion = listNotion(); 
    foreach ($listNotion as $notion):
        ?>

        <option value="<?php echo $notion['idLecon'] ?>">
            <?php echo $notion['nomLecon'] ?>
        </option>

        <?php endforeach; ?>
</select>
<br>
    <a>Question :</a>
 </br>
 <textarea type="text" name="quest" style="text-align : center" ></textarea>
</br>
</br>
<a>Reponse :</a>
</br>
<input type="text" name="reponse">
</br>
</br>
<input type="submit" name="FormQuestion" value="retourner aux leçon">
<input type="submit" name="FormQuestion" value="Ajouter Question">
<input type="submit" name="FormQuestion" value="Cours fini">
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
        padding: 50px;
    max-width: 100%;
    border-radius: 2px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
    }
</style>