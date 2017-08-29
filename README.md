# API Moodify

API renvoyant les données nécessaires à l'utilisation de l'application [Moodify](https://github.com/It-DreamTeam/Vox-Populi-Application)

## Utilisation

- Connexion : ```[POST] /api/connect?email={emailUser}&password={passwordUser}```
    -> Retourne 0 en ```return_code``` avec les infos de user dans l'objet ```returns.user``` si l'utilisateur a été trouvé. Sinon, renvoi une erreur.

- Inscription : ```[POST] /api/register?firstname={firstname}&lastname={lastname}&email={emailUser}&password={passwordUser}&password_confirm={password_confirm}```
    -> Retourne 0 en ```return_code``` avec les infos de user dans l'objet ```returns.user``` si l'utilisateur a été créé. Sinon, renvoi une erreur.

- Page d'accueil : ```[GET] /home/{ville}?{token}```
    -> Retourne :
    - La météo
    - 4 recettes au hasard
    - 1 série au hasard
    - 1 boisson alcoolisée et 1 boisson non alcoolisée (en fonction de la météo)
    - 1 activité (en fonction de la météo)
    
    Exemple RETOUR http://api.moodify.dev/api/home/lyon :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "weather":{  
             "ville":"lyon",
             "condition":"Fortement nuageux",
             "condition_key":"fortement-nuageux",
             "tmp":23,
             "humidity":57
          },
          "drink_alcohol":{  
             "name":"Absolut Greyhound",
             "url_video":"PvIwGPrfY0s"
          },
          "drink_not_alcohol":{  
             "name":"Citrus Cream",
             "url_video":"BltwKmZnukI"
          },
          "activity":[  
             "Karting",
             "Bowling"
          ],
          "recipe":{  
             "recipe_id":"8608",
             "title":"Christmas Fruitcake",
             "image":"http:\/\/static.food2fork.com\/463105646.jpg",
             "source_url":"http:\/\/allrecipes.com\/Recipe\/Christmas-Fruitcake\/Detail.aspx"
          },
          "series":{  
             "title":"Ce soir tout est permis",
             "description":"Ce soir, tout est permis sur les ondes de V T\u00e9l\u00e9 ! L'\u00e9mission de vari\u00e9t\u00e9, anim\u00e9e de main de ma\u00eetre par \u00c9ric Salvail, permet \u00e0 des artistes de s'\u00e9clater en relevant des d\u00e9fis loufoques impliquant l'improvisation, le mime, le lip sync et m\u00eame la danse et la contorsion ! Sous la direction de l'animateur, les invit\u00e9s sont amen\u00e9s \u00e0 se d\u00e9passer et \u00e0 faire rire le public pr\u00e9sent en studio et \u00e0 la maison.",
             "image":"https:\/\/www.betaseries.com\/images\/fonds\/poster\/291294.jpg"
          }
       }
    }
    ```   
    
- Si la précédente requête ne fonctionne pas (à cause de l'API météo retournant une erreur), faire appel à une autre API météo [OpenWeatherMap](https://openweathermap.org/weather-conditions) : ```[GET] /home2/{ville}?{token}```

- "Je veux manger du {ingredient}" : ```[GET] /recipes/{ingredient}```
    -> Retourne 4 recettes aléatoires avec l'ingrédient {ingredient}
    
    Exemple RETOUR http://api.moodify.dev/api/recipes/framboise :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "recipes":[  
             {  
                "recipe_id":"3f0484",
                "title":"Lambic Sangra Recipe",
                "image":"http:\/\/static.food2fork.com\/lambic_sangria_6008fe5.jpg",
                "source_url":"http:\/\/www.chow.com\/recipes\/26241-lambic-sangria"
             },
             {  
                "recipe_id":"e6a700",
                "title":"White chocolate & raspberry cheesecake",
                "image":"http:\/\/static.food2fork.com\/171622_MEDIUMe2fc.jpg",
                "source_url":"http:\/\/www.bbcgoodfood.com\/recipes\/171622\/white-chocolate-and-raspberry-cheesecake"
             },
             {  
                "recipe_id":"47835",
                "title":"Broiled Stone Fruit with Sweet Cream",
                "image":"http:\/\/static.food2fork.com\/broiledfruit3dae.jpg",
                "source_url":"http:\/\/www.101cookbooks.com\/archives\/000178.html"
             },
             {  
                "recipe_id":"53161",
                "title":"Spring Berry Champagne Cocktail",
                "image":"http:\/\/static.food2fork.com\/mare_spring_berry_champagne_cocktail_hc2d0.jpg",
                "source_url":"http:\/\/www.bonappetit.com\/recipes\/2003\/04\/spring_berry_champagne_cocktail"
             }
          ]
       }
    }
    ```
    
- "Je veux boire une boisson {type_boisson}" : ```[GET] /drinks/{type_boisson}```
    -> Retourne 1 boisson alcoolisée et 1 boisson non alcoolisée aléatoires de type {type_boisson} (type_boisson = fraiche, épicée, ...)
    
    Exemple RETOUR http://api.moodify.dev/api/drinks/spicy} :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "drink_alcohol":{  
             "name":"Cino",
             "url_video":"5NgPaDvspWc"
          },
          "drink_not_alcohol":{  
             "name":"Brandy Crusta",
             "url_video":"Qgpw1KREbcQ"
          }
       }
    }
    ```   
    
- "Je veux voir une série" : ```[GET] /serie/```
    -> Retourne une série aléatoire
    
    Exemple RETOUR http://api.moodify.dev/api/serie} :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "series":{  
             "title":"Van Loc : un grand flic de Marseille",
             "description":"George N'Guyen Van Loc interpr\u00e8te son propre personnage, inspecteur puis commissaire de police \u00e0 Marseille, baptis\u00e9 \"Le Chinois\" par la mafia locale.",
             "image":null
          }
       }
    }
    ```  
    
- "Je veux boire une boisson {type_boisson}" : ```[GET] /drinks/{type_boisson}```
    -> Retourne 1 boisson alcoolisée et 1 boisson non alcoolisée aléatoires de type {type_boisson} (type_boisson = fraiche, épicée, ...)
    
    Exemple RETOUR http://api.moodify.dev/api/drinks/spicy} :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "drink_alcohol":{  
             "name":"Cino",
             "url_video":"5NgPaDvspWc"
          },
          "drink_not_alcohol":{  
             "name":"Brandy Crusta",
             "url_video":"Qgpw1KREbcQ"
          }
       }
    }
    ```   
    
- "Je veux faire une activité " : ```[GET] /activity/```
    -> Retourne 2 activités aléatoires
    
    Exemple RETOUR http://api.moodify.dev/api/activity :
    ```bash
    {  
       "return_code":0,
       "error":"",
       "returns":{  
          "activity":[  
             "Lire",
             "Soir\u00e9e entre amis \u00e0 la maison"
          ]
       }
    }
    ```  
    

## Installation

1. Avoir une vagrant avec apache, php, mysql ([Script Installation Vagrant](https://github.com/It-DreamTeam/Vox-Populi-Install)) avec virtualhost et réécriture url activé
2. Télécharger le projet
3. Télécharger les vendors du projet

```bash
composer install
```

## Base de données

1. Télécharger et installer la BDD :

```bash
CREATE DATABASE `cook` /*!40100 DEFAULT CHARACTER SET utf8 */;
SELECT * FROM cook.activity;
```

```bash
CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `weather` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

```bash
INSERT INTO activity (id,name,weather) VALUES(1,'Sortir entres amis','Sunny');
INSERT INTO activity (id,name,weather) VALUES(2,'Aller boire un verre','Sunny');
INSERT INTO activity (id,name,weather) VALUES(3,'Courir','Sunny');
INSERT INTO activity (id,name,weather) VALUES(4,'Faire du vélo','Sunny');
INSERT INTO activity (id,name,weather) VALUES(5,'Piscine','Sunny');
INSERT INTO activity (id,name,weather) VALUES(6,'Pêcher','Sunny');
INSERT INTO activity (id,name,weather) VALUES(7,'Football / BasketBall','Sunny');
INSERT INTO activity (id,name,weather) VALUES(8,'Mécanique','Sunny');
INSERT INTO activity (id,name,weather) VALUES(9,'Aller au zoo','Sunny');
INSERT INTO activity (id,name,weather) VALUES(10,'Mini golf','Sunny');

INSERT INTO activity (id,name,weather) VALUES(11,'Boire un verre en terrasse','Windy');
INSERT INTO activity (id,name,weather) VALUES(12,'Musée','Windy');
INSERT INTO activity (id,name,weather) VALUES(13,'Karting','Windy');
INSERT INTO activity (id,name,weather) VALUES(14,'Billard','Windy');
INSERT INTO activity (id,name,weather) VALUES(15,'Bowling','Windy');
INSERT INTO activity (id,name,weather) VALUES(16,'Jouer à un jeu de société','Windy');
INSERT INTO activity (id,name,weather) VALUES(17,'Jouer d’un instrument de musique','Windy');

INSERT INTO activity (id,name,weather) VALUES(18,'Cinéma','Rainy');
INSERT INTO activity (id,name,weather) VALUES(19,'Soirée entre amis à la maison','Rainy');
INSERT INTO activity (id,name,weather) VALUES(20,'Journée au spa','Rainy');
INSERT INTO activity (id,name,weather) VALUES(21,'Billard/Bowling','Rainy');
INSERT INTO activity (id,name,weather) VALUES(22,'Lire','Rainy');
INSERT INTO activity (id,name,weather) VALUES(23,'Jouer à la play','Rainy');
INSERT INTO activity (id,name,weather) VALUES(24,'Jouer d’un instrument de musique','Rainy');
INSERT INTO activity (id,name,weather) VALUES(25,'Faire des patisseries','Rainy');
INSERT INTO activity (id,name,weather) VALUES(26,'Yoga','Rainy');
INSERT INTO activity (id,name,weather) VALUES(27,'Aller à l’aquarium','Rainy');

INSERT INTO activity (id,name,weather) VALUES(28,'Journée à la montagne','Snow');
INSERT INTO activity (id,name,weather) VALUES(29,'Ski','Snow');
INSERT INTO activity (id,name,weather) VALUES(30,'Cinéma','Snow');
INSERT INTO activity (id,name,weather) VALUES(31,'Journée cocooning','Snow');
INSERT INTO activity (id,name,weather) VALUES(32,'Lire','Snow');
INSERT INTO activity (id,name,weather) VALUES(33,'Jouer à la play','Snow');
INSERT INTO activity (id,name,weather) VALUES(34,'Jouer à un jeu de société','Snow');
INSERT INTO activity (id,name,weather) VALUES(35,'Jouer d’un instrument de musique','Snow');
INSERT INTO activity (id,name,weather) VALUES(36,'Prendre un bain reposant','Snow');
INSERT INTO activity (id,name,weather) VALUES(37,'Cuisiner','Snow');
INSERT INTO activity (id,name,weather) VALUES(38,'Faire des patisseries','Snow');
INSERT INTO activity (id,name,weather) VALUES(39,'Patinoire','Snow');
INSERT INTO activity (id,name,weather) VALUES(40,'Yoga','Snow');
```

```bash
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `social_id` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `token_id` varchar(32) DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
```


## Crédits

Hackaton VoxPopuli IT-AKADEMY - Moodify 2017