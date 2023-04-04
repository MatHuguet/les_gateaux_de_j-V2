<?php $title = "Connection"; 





?>
<div class='admin-accueil'>
    <h1>Bienvenue sur votre espace d'administration</h1>
    <h2>Veuillez saisir vos identifiants pour vous connecter</h2>

    <form method='POST' action='php_script/adminConnectScript.php' class='connect-form'>
        <div class='admin-name'>
            <label for='username'>Nom d'administrateur :
                <input type='text' id='username' name='username' value=''>
            </label>
        </div>
        <div class='password'>
            <label for='password'> Mot de passe :
                <input type='password' id='password' name='password' value=''>
            </label>
        </div>
        <div class='submit'>
            <label for='submit'> Se connecter :
                <input type='submit' id='submit' value='Valider' name='submit'>
            </label>
        </div>
</div>
</form>