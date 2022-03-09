




CREATE TABLE  `items` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
   `image` varchar(255) NOT NULL
  `descr` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `items` (`id`, `name`, `image`, `descr`, `price`) VALUES
(2, 'camera', '1.jpg','nikoin camera', '500'),
(3, 'harddisk ',  '2.jpg','ssd hard', '500' ),
(4, 'laptope',  '3.jpg','lenvo laptop', '300'),
(5, ' wach',  '4.jpg','rolex wach', '300');

ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

  