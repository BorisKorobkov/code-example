INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `street`, `postcode`, `place`) VALUES
(1,	'admin',	'admin',	'admin@example.com',	'Administrator',	NULL,	NULL,	NULL),
(2,	'Guy',	'Fawkes',	'GuyFawkes@example.com',	'Guy Fawkes',	NULL,	NULL,	'York, England');


INSERT INTO `entry` (`id`, `user_id`, `title`, `text`, `datetime`) VALUES
(1,	1,	'Title 3',	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam\r\nnonummy nibh euismod tincidunt ut laoreet dolore.',	'2020-12-30 20:00:00'),
(2,	2,	'Title 1',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nWhy do we use it?\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n',	'2021-01-11 20:03:36');

INSERT INTO `comment` (`id`, `entry_id`, `name`, `email`, `url`, `remark`, `datetime`) VALUES
(1,	2,	'Max',	NULL,	NULL,	'I think the post is very good, keep it up!',	'2021-01-01 06:12:39'),
(2,	2,	'Anonimous',	NULL,	NULL,	'Hi',	'2021-01-01 07:13:14'),
(3,	1,	'Max',	NULL,	NULL,	'I think the post is very good, keep it up!',	'2021-01-01 06:12:39');

