module Glossaire pour xoops
---------------------------
Ce module pemet de g�rer des Glossaire ou Lexiques.
Il prend en charge 
- les cat�gories avec colorations diff�renci�es
- L'exportation des d�fintions par c�t�gories y compris les images des d�finitions
- L'importation dans une nouvelle categorie ou une existante 
  d'une cat�gorie export�e par ce module ou un de ses clones.
  Les images sont �galement import�es si elles existent.
- Lexikon : L'importation dans une nouvelle categorie ou une existante 
  d'une cat�gorie du module "Lexikon"
- Le clonage sans conflit

Chaque d�fitnion comprned :
- un terme
- Une d�finition courte avec prise en chage d'une mis en forme pour les acronymes
- Une d�finition
- une zone de r�f�rences
- 0 ou plusieurs URLs (voir aussi)
- Une image pour chaque d�finition
- un Status : Inactif, Propos�, Soumis

Conception :
----------
La structure du module a �t� r�alis�e grace au module "moduleBuilder"
https://github.com/XoopsModules25x/modulebuilder

---------------------------------------------------
Installation: 
------------
avant d'installer le module il faut installer les frameworks :
- "jjd-Framework"
	https://github.com/JJDai54/JJD-Framework
- "highslide version 5.0.0.0" (le dossier doit etre renomm� en ""highslide" 
	http://highslide.com/
- "trierTableauHTML"
	https://github.com/JJDai54/trierTableauHTML

Ensuite le module s'installe comme tous les modules Xoops.

Contact : 
-------
https://github.com/JJDai54
http://jubile.fr

en pr�vision :
------------
Importation de fichiers CSV
Fichier li�s (PDF, ZIP,TXT, ...)

