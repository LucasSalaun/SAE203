<?php
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $appareil = get_appareil($agent);
    $OS = get_OS($agent);
    $date = date("d/m/Y");
    $date_lettre = date("l F Y");
    $heure = date("H:i:s");
    $UserIp = getenv('REMOTE_ADDR');

    function get_appareil($agent){
        $mobiles = ['android','mobile','iphone','ipad','phone'];
        $ordinateurs = ['windows','macintosh','linux'];

        foreach ($mobiles as $device){
            if(stripos($agent, $device) != false ){
                return 'Mobile';
            }
        }

        foreach($ordinateurs as $device){
            if(stripos($agent, $device) != false){
                return 'Ordinateur';
            }
        }

        return 'Appareil Inconnu';
    } 

    function get_OS($agent){
        $liste_OS = array( 'android' => 'Android',
        'iphone' => 'iOS',
        'ipad' => 'iOS',
        'windows' => 'Windows OS',
        'linux' => 'Linux OS',
        'macintosh' => 'Mac OS');

        foreach($liste_OS as $key => $val){
            if(stripos($agent, $key)){
            return $val;
            }
        }

        return 'OS inconnu';
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil — SAE203</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- HEADER COMMUN -->
    <header>
        <nav>
            <p><strong>Navigation :</strong></p>
            <a href="index.php">Accueil</a>
            <a href="connexion/index.html">Connexion</a>
            <a href="inscription/index.html">Inscription</a>
            <a href="private/index.html">Administration</a>
        </nav>
    </header>

    <main>
        <h1>Bienvenue</h1>
        
        <!-- ZONE DYNAMIQUE : date et heure -->
        <section class="info-dynamique">
            <p>Nous sommes le : <span class="placeholder-date"><?= $date_lettre ?></span></p>
            <p>Il est : <span class="placeholder-heure"><?= $heure ?></span></p>
        </section>

        <!-- ZONE DYNAMIQUE : OS -->
        <section class="info-dynamique">
            <p>Votre systeme d'exploitation : <span class="placeholder-OS"><?= $OS ?></span></p>
        </section>

        <!-- ZONE DYNAMIQUE : IP -->
        <section class="info-dynamique">
            <p>Votre adresse IP : <span class="placeholder-OS"><?= $UserIp ?></span></p>
        </section>

        <!-- ZONE DYNAMIQUE : type de terminal -->
        <section class="info-dynamique">
            <p>Vous utilisez un : <span class="placeholder-device"><?= $appareil ?></span></p>
        </section>
    </main>

    <!-- FOOTER COMMUN -->
    <footer>
        <p>Groupe Ollivier-Leleu-Salaun — 2026</p>
    </footer>
</body>
</html>

<!-- A FAIRE SUR NOUVELLE VM 
 
Dans le terminal :

    htpasswd -c /etc/apache2/pass admin
    mdp : lannion

Dans apache2.conf

    <Directory "/var/www/html/private">
    AuthType Basic
    AuthName "Veuillez saisir votre mot de login/passe"
    AuthUserFile "/etc/apache2/pass"
    Require valid-user
    </Directory>

Dans site available/000-default
dans la partie VitualHost

    ErrorDocument 404 /errors/404.html
  	ErrorDocument 403 /errors/403.html
  	ErrorDocument 500 /errors/500.html


-->