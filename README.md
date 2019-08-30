# TestWe

##Étape 1 : Installation
1. Fork le projet
2. Installer les dependances
3. Créez la base de donnée 'test'
4. Créez les tables en ligne de commande ou via le fichier datas/test-cinemahd-database.sql
5. Importez les données situées dans le fichier datas/test-cinemahd-datas.sql

Rendu: Un repository git avec le code corrigé et vos modifications.
 
##Étape 2: Correction

On a trouvé plusieurs bugs dans l'application qui ont été remontés par les utilisateurs.
Grâce aux retours que nous avons reçus, identifiez puis corrigez les divers problèmes sur l'application.

Voilà les retours utilisateur:
 - Lors de l'ajout d'une personne à un film, on voit une erreur dans la console Chrome: "Echec de l'ajout de la personne". On ne sait pas pourquoi elle s'affiche parce que tout fonctionne normalement.
 - Et quand on essaie de créer une salle (room), on a une erreur qui nous en empêche.
 - Dans la liste des personnes, quand on essaie de supprimer une personne, le formulaire de création s'affiche à la place. Et quand on veut modifier une personne, les changements ne sont pas sauvegardés.
 - Lorqu'on essaie de créer une scéance en 3D, la scéance créée n'est pas en 3D. Et si on crée une scéance sans salle, on a une erreur quand on veut afficher la liste des scéances.
 - Enfin, on ne peux pas afficher la liste des films d'une personne, on a une erreur.
 
##Étape 3: Évolution

Maintenance que les problèmes ont été résolus, on peux rajouter de nouvelle fonctionnalité. Une fonctionnalité qui nous a été demandé plusieurs fois est de pouvoir retirer une personne d'un film.
Ajoutez cette fonctionnalité dans la modification d'un film.


##Voilà toute la documentation sur l'application actuelle:

####Url Films :
 - /movie/ 
 - /movie/create
 - /movie/edit/{id}
 - /movie/delete/{id}
 
####Url des types de film :
 - /type/ 
 - /type/create
 - /type/edit/{id}
 - /type/delete/{id}

####Url des personnes :
 - /person/
 - /person/create
 - /person/edit/{id}
 - /person/delete/{id}
 - /person/{id}/movies

####Url des salles :
 - /room/
 - /room/create
 - /room/edit/{id}
 - /room/delete/{id}

####Url des scéances :
 - /showing/
 - /showing/create
 - /showing/edit/{id}
 - /showing/delete/{id}