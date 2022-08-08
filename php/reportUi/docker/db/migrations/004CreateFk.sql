# 1. for data integrity
# 2. for indexes in join. MySQL creates this indexes automatically for foreign keys. In PostgreSQL we have to do this explicitly.
ALTER TABLE `log`  ADD FOREIGN KEY (`user_id`)   REFERENCES `user` (`id`);
ALTER TABLE `user` ADD FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
