# German and english names shouldn't be mixed. All names should be in the same language.
# English is preferable, because PHP and MySQL are in english.

ALTER TABLE `benutzer` RENAME TO `user`;
ALTER TABLE `mandant` RENAME TO `client`;

ALTER TABLE `user` CHANGE `mandant` `client_id` int(11) NOT NULL;
