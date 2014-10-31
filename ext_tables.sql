#
# Table structure for table 'sys_log'
#
CREATE TABLE sys_log2 (
  channel text NOT NULL,
  level_name varchar(100) DEFAULT NULL,
  request_id varchar(13) DEFAULT NULL,
  context text,
  level int(3) DEFAULT NULL,
  message text NOT NULL,
  datetime datetime DEFAULT NULL,
  extra text NOT NULL,
  mode varchar(3) DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  uid int(11) NOT NULL,
);