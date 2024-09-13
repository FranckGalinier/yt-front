# yt-front
###Cloner le projet sur votre ordi
git clone git@github.com:FranckGalinier/yt-front.git

cd yt-front
code .
###Dans vs code ouvrir un terminal et taper les commandes ci-dessous
cd ytdlt
docker compose up --build
###dans un autre terminal revenir dans le fichier ytdlt
cd ytdlt
###installer des dépendances
docker exec -it apache_ytdlt composer install
 cd ..
 php downloader.php
 ### Maintenant allez sur localhost de votre ordiateur et rnetrez l'url youtube de votre choix 

