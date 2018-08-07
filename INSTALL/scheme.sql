CREATE DATABASE IF NOT EXISTS pureftpd;

CREATE TABLE `ftpd` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `User` varchar(16) NOT NULL DEFAULT '',
    `status` enum('0','1') NOT NULL DEFAULT '0',
    `Password` varchar(64) NOT NULL DEFAULT '',
    `Uid` varchar(11) NOT NULL DEFAULT '2001',
    `Gid` varchar(11) NOT NULL DEFAULT '2001',
    `Dir` varchar(128) NOT NULL DEFAULT '/media/FTP',
    `ULBandwidth` int(5) NOT NULL DEFAULT '0',
    `DLBandwidth` int(5) NOT NULL DEFAULT '0',
    `comment` tinytext NOT NULL,
    `ipaccess` varchar(15) NOT NULL DEFAULT '*',
    `QuotaSize` int(6) NOT NULL DEFAULT '0',
    `QuotaFiles` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`User`),
    KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `settings` (
    `name` varchar(50) NOT NULL DEFAULT '',
    `value` varchar(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`name`, `value`)
VALUES
('ftp_dir','/media/FTP'),
('upload_speed','0'),
('download_speed','0'),
('quota_size','0'),
('quota_files','0'),
('permitted_ip','*'),
('pureftpd_conf_path','/etc/pure-ftpd/pure-ftpd.conf'),
('pureftpd_init_script_path','/etc/init.d/pure-ftpd');

CREATE TABLE `userlist` (
    `id` int(3) NOT NULL AUTO_INCREMENT,
    `user` varchar(50) NOT NULL,
    `pass` varchar(70) NOT NULL,
    `language` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;