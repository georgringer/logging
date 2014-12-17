#
# Table structure for table 'sys_log2'
#
CREATE TABLE sys_log2 (
  uid int(11) NOT NULL,
  pid int(11) NOT NULL,
  channel text NOT NULL,
  level_name varchar(100) DEFAULT NULL,
  request_id varchar(13) DEFAULT NULL,
  context text,
  level int(3) DEFAULT NULL,
  message text NOT NULL,
  datetime datetime DEFAULT NULL,
  extra text NOT NULL,
  mode varchar(3) DEFAULT NULL,
  user_id int(11) DEFAULT '0',
  record_id int(11) NOT NULL,
  tablename varchar(200) NOT NULL,
);