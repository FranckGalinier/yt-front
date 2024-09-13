<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // connexion à la base de donnée
    $mysqli = mysqli_connect("127.0.0.1", "admin", "admin", "ytdlt", 3307);

    // installation de yt-dlp et autre dépendances
    shell_exec('chmod +x ./install.sh');
    shell_exec('./install.sh');

    // récupération du chemin de yt-dlp
    $path = trim(shell_exec('which yt-dlp'));

while(true) {
    // récupération du fichier à télécharger dans la BDD
    $query = "SELECT * FROM `download` WHERE `telecharger` = 0 ORDER BY `id` LIMIT 1";

    // exécution de la requête
    $result = mysqli_query($mysqli, $query);

    switch ($result->num_rows) {
        case 0:// aucun fichier à télécharger
        echo "Il n y a plus de fichier a télécharger\n";
        echo "Attente 10s avant rescan\n\n";
        sleep(10);
        break;
        case 1:// un fichier à télécharger
            /* Récupère un tableau associatif */
            while ($row = mysqli_fetch_row($result)) {

            echo "Telechargement et conversion de lien YT\n";
            
            $output = shell_exec($path.' '.$row[2].' -x --audio-format mp3 --audio-quality 0');
            echo "---\n";
            echo "$output";
            echo "Telechargement terminé\n";
            mysqli_query($mysqli, 'UPDATE `download` SET `telecharger` = 1 WHERE `id` = \''.$row[0].'\';');
            echo "Fichier marqué téléchargé dans la BDD\n";
            }
            break;
        case 2://erreur
            echo "Catastrophe.\n";
            exit("Erreur SQL.");
            break;
        default:
            echo "Catastrophe.\n";
            exit("Erreur Inconnue");
            break;
    }

}
