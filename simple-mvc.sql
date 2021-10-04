
  DROP TABLE IF EXISTS `users`;
  --
  -- Table `item` structure
  --
  CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `firstname` VARCHAR(100) NOT NULL, 
  `lastname` VARCHAR(100) NOT NULL, 
  `username` VARCHAR(100) NOT NULL, 
  `password` VARCHAR(100) NOT NULL, 
  `role` VARCHAR(100) NOT NULL, 
  `birthday` DATE NOT NULL, 
  `address` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `postal_code` INT NOT NULL,
  `phone` VARCHAR(100) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
);
  -- Content of table `item`
  --
INSERT INTO
  `users` (`id`, `firstname`, `lastname`, `username`, `password`, `role`, `birthday`, `address`, `city`, `postal_code`, `phone`, `rate`)
VALUES
  (1, 'Irons', 'Jeremy', 'JIrons', 'abcd1234', 'USER', '09/01/1973', '13 rue du poteau carré', 'Clichy', 92000, '05 06 07 19 23', 4.5),
  (2, 'Dalton', 'Joe', 'JD', 'abcd1234', 'USER', '09/01/1933', '2 rue des pommiers', 'Texas', 45120, '01 23 45 67 89', 5);
