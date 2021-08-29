CREATE TABLE  `users` (
 `id` INT(40) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `firstname` VARCHAR(256) NOT NULL,
 `lastname` VARCHAR(256) NOT NULL,
 `contact_number` VARCHAR(256) NOT NULL,
 `email` VARCHAR(256) NOT NULL,
 `username` VARCHAR(256) NOT NULL,
 `password` VARCHAR(256) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = latin1;

-- Creating existing account seed for login
INSERT INTO `users`(`firstname`, `lastname`, `email`, `contact_number`, `username`, `password`) VALUES ('admin', 'admin', 'admin@admin.com', '123456789', 'admin', MD5('admin'));
