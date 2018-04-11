-- Dumping data for table `user`
LOCK TABLES `user` WRITE;
INSERT INTO `user`
  (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,'Giovanni',NOW(),NOW(),NULL),
  (2,'Alessia',NOW(),NOW(),NULL),
  (3,'Enrico',NOW(),NOW(),NULL),
  (4,'Cristina',NOW(),NOW(),NULL);
UNLOCK TABLES;

-- Dumping data for table `category`
LOCK TABLES `category` WRITE;
INSERT INTO `category`
  (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,'Thriller',NOW(),NOW(),NULL),
  (2,'Pulp',NOW(),NOW(),NULL),
  (3,'Fantasy',NOW(),NOW(),NULL),
  (4,'Adventure',NOW(),NOW(),NULL),
  (5,'Drama',NOW(),NOW(),NULL);
UNLOCK TABLES;

-- Dumping data for table `library`
LOCK TABLES `library` WRITE;
INSERT INTO `library`
  (`id`, `user_id`, `title`, `director`, `rating`, `viewed`,
    `url`, `tags`,`notes`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,1,'Pulp Fiction','Tarantino',9,1,'https://pulpfiction.testurl.com','blood, amazing, killing, drugs',"The path of the righteous man is beset on all sides by the inequities of the selfish and the tyranny of evil men. Blessed is he, who in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy my brothers. And you will know my name is the Lord when I lay my vengeance upon thee.",NOW(),NOW(),NULL),
  (2,2,'Memento','Nolan',8,1,'https://memento.testurl.org','wtf, ramless, ramception',"where i'm arrived? i do a photo to remember instead used notes.",NOW(),NOW(),NULL),
  (3,1,'Fight Club','Fincher',9,1,'https://fightclub.testurl.org','wtf, fight, schizoid',"1st RULE: You do not talk about FIGHT CLUB. 2nd RULE: You DO NOT talk about FIGHT CLUB...8th RULE: If this is your first night at FIGHT CLUB, you HAVE to fight.",NOW(),NOW(),NULL),
  (4,3,'Seven Samurai','Kurosawa',8,0,'https://sevensamurai.testurl.org','japan, samurai, ninja, pirates','Akira Kurosawa is a BIG BOSS of cinematography',NOW(),NOW(),NULL),
  (5,1,'Inglorius Basterds','Tarantino',9,1,'https://ingloriusbasterds.testurl.org','nazi, ww2, blood, killing','GURLOMI GURLAMI NGULAMI',NOW(),NOW(),NULL);
UNLOCK TABLES;

-- Dumping data for table `library_category`
LOCK TABLES `library_category` WRITE;
INSERT INTO `library_category`
  (`id`, `library_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,1,2,NOW(),NOW(),NULL),
  (2,1,5,NOW(),NOW(),NULL),
  (3,2,1,NOW(),NOW(),NULL),
  (4,2,5,NOW(),NOW(),NULL),
  (5,3,5,NOW(),NOW(),NULL),
  (6,4,4,NOW(),NOW(),NULL),
  (7,4,5,NOW(),NOW(),NULL),
  (8,5,2,NOW(),NOW(),NULL);
UNLOCK TABLES;
