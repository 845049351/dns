���²���������dns-master�ڵ��Ͻ��С�
1����װnginx������nginx.conf��vhost.conf�ϴ�
2���ϴ�techĿ¼��nginx��wwwrootĿ¼
3���༭tech/Dns/Public/Script/auto_dns.py	�ýű����������ж��masterʱ����ִ����dns���������ļ��õ�
	����12��masterlist��ֵ��Ϊ�㻷���е�master�ڵ��ip��root���룬���master�ö��ŷָ�
	������nginxwwwrootĿ¼����/var/www/html�Ļ����޸ĵ�13/14��
4���༭tech/Dns/Public/Script/config_record.py	�ýű��Ƕ�ȡmysql���ɱ���bind�����ļ��õ�
	����ʵ������༭��23��
	���ݵ�26�е����ã���������Ŀ¼
	�༭��31~35�����ݿ�����
5���༭tech/Dns/Public/Script/ParseDnsConf.py	�ýű����״�ʹ�ã���ȡ���������ļ�������mysql�����õģ�Ҳ������mysql����������ʱ���ӱ������»ָ���
	�༭139~142�����ݿ�����
6���༭tech/Dns/Home/Conf/config.php
	�༭10~14�����ݿ�����
	�༭21~22��ldap����
7�������ݿ�
	����
	CREATE DATABASE `internaldns` /*!40100 DEFAULT CHARACTER SET utf8 */;
	����¼��
	CREATE TABLE `dns_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone` varchar(50) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `dnstype` varchar(50) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zone` (`zone`,`host`,`dnstype`,`data`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
	���û���
	CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `ustat` varchar(10) DEFAULT NULL,
  `logintime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
	����Ʊ�
	CREATE TABLE `log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;