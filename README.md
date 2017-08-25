# API Moodify

API renvoyant les données nécessaires à l'utilisation de l'application [Moodify](https://github.com/It-DreamTeam/Vox-Populi-Application)

## Utilisation

- Authentification : ```[GET] /api/getToken?email={emailUser}&password={passwordUser}```
    -> Retourne un token (à mettre dans les requetes ci-dessous)

- Page d'accueil : ```[GET] /home/{ville}?{token}```
    -> Retourne :
    - La météo
    - 4 recettes au hasard
    - 1 série au hasard
    - 1 boisson alcoolisé et 1 boisson non alcoolisé (en fonction de la météo)
    - 1 activité (en fonction de la météo)
    
- Si la précédente requête ne fonctionne pas (à cause de l'API météo retournant une erreur), faire appel à une autre API météo [OpenWeatherMap](https://openweathermap.org/weather-conditions) : ```[GET] /home2/{ville}?{token}```
    


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