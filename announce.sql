
  DROP TABLE IF EXISTS `announce`;
  --
  -- Table `item` structure
  --
  CREATE TABLE `announce` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `user_id` INT NOT NULL, 
  `title` VARCHAR(100) NOT NULL, 
  `registration_number` VARCHAR(100) NOT NULL, 
  `brand` VARCHAR(100) NOT NULL, 
  `model` VARCHAR(100) NOT NULL, 
  `color` VARCHAR(100) NOT NULL, 
  `power` INT NOT NULL,
  `kilometers` INT NOT NULL,
  `daily_price` INT NOT NULL,
  `picture` VARCHAR(100) NOT NULL,
  `year` INT NOT NULL,
  `rate` float NULL,
  PRIMARY KEY (`id`)
);
  -- Content of table `item`
  --
INSERT INTO
  `announce` (`id`, `user_id`, `title`, `registration_number`, `brand`, `model`, `color`, `power`, `kilometers`, `daily_price`, `picture`, `year`, `rate`)
VALUES
  (1, '1', 'Ma super mégane à louer', 'AB-468-TG', 'Renault', 'Megane', 'Grey', 110, 85000, 35, 'assets/images/megane.jpg', 2015, 4.9),
  (2, '2', 'Twingo', 'WI-196-JD', 'Renault', 'Twingo', 'Red', 20, 230000, 8, 'assets/images/twingo.jpg', 1999, 4.8);
