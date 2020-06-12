--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_id` int(8) NOT NULL AUTO_INCREMENT,
  `person` varchar(50) NOT NULL,
  `person_id` int(8) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
);
