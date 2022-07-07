


<html lang="fr">
    <h1>Saisie des question de la leçon</h1>
<form action="ControllerLecon.php" method="post">
 <p class="blocktext">
    <a>Question :</a>
 </br>
 <textarea type="text" name="cours" style="text-align : center" ></textarea>
</br>
</br>
<a>Reponse :</a>
</br>
<input type="text" name="nom">
</br>
</br>
<input type="submit" name="question" value="retourner aux leçon">
<input type="submit" name="question" value="Ajouter Question">
<input type="submit" name="question" value="Cours fini">
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