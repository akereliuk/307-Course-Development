CREATE TABLE `survey_answers` (
  `id` CHAR(13) NOT NULL,
  `name` VARCHAR(100) DEFAULT NULL,
  `hours` ENUM ('1','4','7') NOT NULL,
  `major` ENUM ('BUS','SOC','SCI','ART','ENG','OTH') NOT NULL,
  `media` SET ('FB', 'TW', 'TT', 'LI', 'PI') NOT NULL,
  `feedback` VARCHAR(400),
  PRIMARY KEY (`id`)
);