CREATE TABLE xoosocialnetwork (
  xoosocialnetwork_id int(11) NOT NULL AUTO_INCREMENT,
  xoosocialnetwork_title varchar(100) NOT NULL,
  xoosocialnetwork_url varchar(100) NOT NULL,
  xoosocialnetwork_image varchar(100) NOT NULL DEFAULT 'blank.gif',
  xoosocialnetwork_query_url varchar(20) NOT NULL,
  xoosocialnetwork_query_title varchar(20) NOT NULL,
  xoosocialnetwork_order int(3) NOT NULL DEFAULT '0',
  xoosocialnetwork_display tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (xoosocialnetwork_id),
  UNIQUE KEY xoosocialnetwork_title (xoosocialnetwork_title)
) ENGINE=MyISAM;

INSERT INTO xoosocialnetwork VALUES(1, 'Delicious', 'http://del.icio.us/post', 'delicious.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES(2, 'Digg', 'http://digg.com/submit', 'digg.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES(3, 'Facebook', 'http://www.facebook.com/share.php', 'facebook.png', 'u', 't', 0, 1);
INSERT INTO xoosocialnetwork VALUES(4, 'Linkedin', 'http://www.linkedin.com/shareArticle', 'linkedin.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES(5, 'Stumbleupon', 'http://www.stumbleupon.com/submit', 'stumbleupon.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES(6, 'Twitter', 'http://twitter.com/home', 'twitter.png', 'status', '', 0, 1);