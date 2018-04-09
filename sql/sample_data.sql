-- Dumping data for table `user`
LOCK TABLES `user` WRITE;
INSERT INTO `user`
  (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,'giovanni', NOW(), NOW(), NOW()),
  (2,'alessia', NOW(), NOW(), NOW()),
  (3,'enrico', NOW(), NOW(), NOW()),
  (4,'cristina', NOW(), NOW(), NOW());
UNLOCK TABLES;

-- Dumping data for table `category`
LOCK TABLES `category` WRITE;
INSERT INTO `category`
  (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,'thriller',NOW(),NOW(),NOW()),
  (2,'pulp',NOW(),NOW(),NOW()),
  (3,'fantasy',NOW(),NOW(),NOW()),
  (4,'adventure',NOW(),NOW(),NOW()),
  (5,'drama',NOW(),NOW(),NOW());
UNLOCK TABLES;

-- Dumping data for table `library`
LOCK TABLES `library` WRITE;
INSERT INTO `library`
  (`id`, `user_id`, `title`, `director`, `rating`, `viewed`,
    `url`, `tags`,`notes`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,1,'pulp fiction','tarantino',9,1,'https://pulpfiction.testurl.com','blood, amazing, killing, drugs',"The path of the righteous man is beset on all sides by the inequities of the selfish and the tyranny of evil men. Blessed is he, who in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy my brothers. And you will know my name is the Lord when I lay my vengeance upon thee.",NOW(),NOW(),NOW()),
  (2,2,'memento','nolan',8,1,'https://memento.testurl.org','wtf, ramless, ramception',"where i'm arrived? i do a photo to remember instead used notes.",NOW(),NOW(),NOW()),
  (3,1,'fight club','fincher',9,1,'https://fightclub.testurl.org','wtf, fight, schizoid',"1st RULE: You do not talk about FIGHT CLUB. 2nd RULE: You DO NOT talk about FIGHT CLUB...8th RULE: If this is your first night at FIGHT CLUB, you HAVE to fight.",NOW(),NOW(),NOW()),
  (4,3,'seven samurai','kurosawa',8,0,'https://sevensamurai.testurl.org','japan, samurai, ninja, pirates','Akira Kurosawa is a BIG BOSS of cinematography',NOW(),NOW(),NOW()),
  (5,1,'inglorius basterds','tarantino',9,1,'https://ingloriusbasterds.testurl.org','nazi, ww2, blood, killing','GURLOMI GURLAMI NGULAMI',NOW(),NOW(),NOW());
UNLOCK TABLES;

-- Dumping data for table `library_category`
LOCK TABLES `library_category` WRITE;
INSERT INTO `library_category`
  (`id`, `library_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
  (1,1,2,NOW(),NOW(),NOW()),
  (2,1,5,NOW(),NOW(),NOW()),
  (3,2,1,NOW(),NOW(),NOW()),
  (4,2,5,NOW(),NOW(),NOW()),
  (5,3,5,NOW(),NOW(),NOW()),
  (6,4,4,NOW(),NOW(),NOW()),
  (7,4,5,NOW(),NOW(),NOW()),
  (8,5,2,NOW(),NOW(),NOW());
UNLOCK TABLES;
