module Glossaire pour xoops
---------------------------
Ce module pemet de gérer des Glossaire ou Lexiques.
Il prend en charge 
- les catégories avec colorations différenciées
- L'exportation des défintions par cétégories y compris les images des définitions
- L'importation dans une nouvelle categorie ou une existante 
  d'une catégorie exportée par ce module ou un de ses clones.
  Les images sont également importées si elles existent.
- Lexikon : L'importation dans une nouvelle categorie ou une existante 
  d'une catégorie du module "Lexikon"
- Le clonage sans conflit

Chaque défitnion comprned :
- un terme
- Une définition courte avec prise en chage d'une mis en forme pour les acronymes
- Une définition
- une zone de références
- 0 ou plusieurs URLs (voir aussi)
- Une image pour chaque définition
- un Status : Inactif, Proposé, Soumis

Conception :
----------
La structure du module a été réalisée grace au module "moduleBuilder"
https://github.com/XoopsModules25x/modulebuilder

---------------------------------------------------
Installation: 
------------
avant d'installer le module il faut installer les frameworks :
- "jjd-Framework"
	https://github.com/JJDai54/JJD-Framework
- "highslide version 5.0.0.0" (le dossier doit etre renommé en ""highslide" 
	http://highslide.com/
- "trierTableauHTML"
	https://github.com/JJDai54/trierTableauHTML

Ensuite le module s'installe comme tous les modules Xoops.

Contact : 
-------
https://github.com/JJDai54
http://jubile.fr

en prévision :
------------
Importation de fichiers CSV
Fichier liés (PDF, ZIP,TXT, ...)

