--
-- Table structure for table `cpq_table
--
-- screening_name, cost, qaly, cpq, get_id

CREATE TABLE `cpq_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `get_id` int(11) NOT NULL,
  `screening_name` varchar(255),
  `cost` int(11),
  `qaly` int(11),
  `cpq` int(11),
  PRIMARY KEY (`cpq`)
)