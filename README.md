# yt-front

### Cloner le projet sur votre ordi
git clone git@github.com:FranckGalinier/yt-front.git

cd yt-front

code .

### Dans vs code ouvrir un terminal et taper les commandes ci-dessous
cd ytdlt

docker compose up --build

### Dans un autre terminal revenir dans le fichier ytdlt

cd ytdlt

### installer des dépendances dans symfony
docker exec -it apache_ytdlt composer install

 cd ..
 
 php downloader.php
 
 ### Maintenant allez sur http://localhost dans votre navigateur préférée,
 copier coller l'url d'un lien Youtube dans l'input de votre localhost et appuyé sur Download
