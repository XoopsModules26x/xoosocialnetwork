CREATE TABLE xoosocialnetwork (
  xoosocialnetwork_id          INT(11)      NOT NULL AUTO_INCREMENT,
  xoosocialnetwork_title       VARCHAR(100) NOT NULL,
  xoosocialnetwork_url         VARCHAR(100) NOT NULL,
  xoosocialnetwork_image       VARCHAR(100) NOT NULL DEFAULT 'blank.gif',
  xoosocialnetwork_query_url   VARCHAR(20)  NOT NULL,
  xoosocialnetwork_query_title VARCHAR(20)  NOT NULL,
  xoosocialnetwork_order       INT(3)       NOT NULL DEFAULT '0',
  xoosocialnetwork_display     TINYINT(1)   NOT NULL DEFAULT '1',
  PRIMARY KEY (xoosocialnetwork_id),
  UNIQUE KEY xoosocialnetwork_title (xoosocialnetwork_title)
)
  ENGINE =MyISAM;

INSERT INTO xoosocialnetwork VALUES (1, 'Delicious', 'http://delicious.com/save', 'delicious.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES (2, 'Digg', 'http://digg.com/submit', 'digg.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES (3, 'Facebook', 'http://www.facebook.com/share.php', 'facebook.png', 'u', 't', 0, 1);
INSERT INTO xoosocialnetwork VALUES (4, 'Linkedin', 'http://www.linkedin.com/shareArticle', 'linkedin.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES (5, 'Stumbleupon', 'http://www.stumbleupon.com/submit', 'stumbleupon.png', 'url', 'title', 0, 1);
INSERT INTO xoosocialnetwork VALUES (6, 'Twitter', 'http://twitter.com/share', 'twitter.png', 'url', 'text', 0, 1);
INSERT INTO xoosocialnetwork VALUES (7, 'Google', 'https://plus.google.com/share', 'google.png', 'url', 't', 1, 1);
INSERT INTO xoosocialnetwork VALUES (8, 'Reddit', 'http://en.reddit.com/submit', 'reddit.png', 'url', 'title', 1, 1);
INSERT INTO xoosocialnetwork VALUES (9, 'Blogger', 'http://www.blogger.com/blog_this.pyra', 'blogger.png', 'u', 't', 1, 1);
INSERT INTO xoosocialnetwork VALUES (10, 'Tumblr', 'http://www.tumblr.com/share/link', 'tumblr.png', 'url', 'title', 1, 1);
INSERT INTO xoosocialnetwork VALUES (11, 'Pinterest', 'http://pinterest.com/pin/create/button/', 'pinterest.png', 'url', 'description', 1, 1);
