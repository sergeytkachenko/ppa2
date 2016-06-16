
INSERT INTO `users` (`id`, `name`, `email`, `birthday`, `is_active`) VALUES
(1, 'test', 'test@mail.com', '2016-06-01', b'1'),
(2, 'ivan', 'ivan@mail.com', '2015-08-01', b'0');

INSERT INTO `groups` (`id`, `title`) VALUES
	(1, 'all users'),
	(2, 'portal users'),
	(3, 'methodists'),
	(4, 'admins');

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 2, 3),
	(4, 2, 4);
