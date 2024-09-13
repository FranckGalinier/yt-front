<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = mysqli_connect("127.0.0.1", "admin", "admin", "ytdlt", 3307);


while(true) {

    $query = "SELECT * FROM `download` WHERE `telecharger` = 0 ORDER BY `id` LIMIT 1";

    $result = mysqli_query($mysqli, $query);

    switch ($result->num_rows) {
        case 0:
        echo "Il n y a plus de fichier a télécharger\n";
        echo "Attente 10s avant rescan\n\n";
        sleep(10);
        break;
        case 1:
            /* Récupère un tableau associatif */
            while ($row = mysqli_fetch_row($result)) {

            echo "Telechargement et conversion de lien YT\n";
            
            $output = shell_exec('/home/FP_ERN_DEV/.local/bin/yt-dlp '.$row[2].' -x --audio-format mp3 --audio-quality 0');
            echo "---\n";
            echo "$output";
            echo "Telechargement terminé\n";
            mysqli_query($mysqli, 'UPDATE `download` SET `telecharger` = 1 WHERE `id` = \''.$row[0].'\';');
            echo "Fichier marqué téléchargé dans la BDD\n";
            }
            break;
        case 2:
            echo "Catastrophe.\n";
            exit("Erreur SQL.");
            break;
        default:
            echo "Catastrophe.\n";
            exit("Erreur Inconnue");
            break;
    }

}
