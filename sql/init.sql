CREATE DATABASE `cakephp_twitter` DEFAULT CHARACTER SET utf8;;
use cakephp_twitter

-- usersテーブル作成
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255),
  `photo` varchar(255),
  `photo_dir` varchar(255),
  `password` varchar(255) NOT NULL,
  `role` varchar(20),
  `body` text NOT NULL,
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `users` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD UNIQUE (`email`);
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` MODIFY `email` varchar(255) DEFAULT '' NOT NULL;
ALTER TABLE `users` MODIFY `password` varchar(255) DEFAULT '' NOT NULL;
ALTER TABLE `users` MODIFY `photo_dir` varchar(255) DEFAULT NULL;

-- 管理者ユーザー作成 // ここではパスワードを"sample"とｓる
INSERT INTO `users` (`email`, `name`, `photo`, `photo_dir`, `password`, `role`, `body`)
    VALUES ("admin@mail.com", "Administrator", "管理者.png", "1", "$2a$10$UE.ilc/yVqAxh/tuW0Z.OOIt6QeU3L/jn/NjVqLdQaiFd0PdSamBi", "admin", "すべての編集・削除権限を有する管理者");

INSERT INTO `users` (`email`, `name`, `photo`, `photo_dir`, `role`)
    VALUES ("hoge@hoge.com", "hogehoge", "Twitter_icon3.png", "2", "author");
INSERT INTO `users` (`email`, `name`, `photo`, `photo_dir`, `role`)
    VALUES ("huga@huga.com", "hugahuga", "Twitter_icon.png", "3", "author");
INSERT INTO `users` (`email`, `name`, `photo`, `photo_dir`, `role`)
    VALUES ("iizawa@mail.com", "iizawa", "Twitter_icon2.jpeg", "4", "author");


-- tweetsテーブル作成
CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_tweet_id` int(11),
  `content` varchar(110) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `tweets` ADD PRIMARY KEY (`id`);
ALTER TABLE `tweets` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- テストレコード挿入 // tweets
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("1", "サンプルツイート001", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("1", "サンプルツイート002", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("2", "サンプルツイート003", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("2", "サンプルツイート004", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("2", "サンプルツイート005", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("3", "サンプルツイート006", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("4", "サンプルツイート007", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("4", "サンプルツイート008", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("4", "サンプルツイート009", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("4", "サンプルツイート010", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `created`, `updated`) VALUES ("1", "さんぷる011", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("1", "さんぷる012", "2", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("1", "さんぷる013", "2", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("1", "hogehoge", "6", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("1", "サンプルツイート015", "5", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("2", "サンプルツイート016", "7", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("2", "楽しい", "7", now(), now());
INSERT INTO `tweets` (`user_id`, `content`, `reply_tweet_id`, `created`, `updated`) VALUES ("3", "嬉しい", "7", now(), now());


-- favoriteテーブル作成
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255),
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `favorites` ADD PRIMARY KEY (`tweet_id`, `user_id`);

-- テストレコード挿入 // favorites
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("17", "1", "Administrator");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("17", "2", "hogehogehoge");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("18", "1", "Administrator");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("18", "3", "hugahuga");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("16", "1", "Administrator");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("16", "2", "hogehogehoge");
INSERT INTO `favorites` (`tweet_id`, `user_id`, `user_name`) VALUES ("16", "3", "hugahuga");

