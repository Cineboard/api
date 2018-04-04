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
  (1,1,'pulp fiction','tarantino',9,1,NOW(),NOW(),NOW(),NOW(),NOW(),NOW()),
  (2,1,'memento','nolan',8,1,NOW(),NOW(),NOW(),NOW(),NOW(),NOW()),
  (3,2,'fight club','fincher',9,1,NOW(),NOW(),NOW(),NOW(),NOW(),NOW()),
  (4,2,'seven samurai','kurosawa',8,0,NOW(),NOW(),NOW(),NOW(),NOW(),NOW());
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
  (7,4,5,NOW(),NOW(),NOW());
UNLOCK TABLES;


