[application]
site_name = Stint
version = 1.0

[database]
db_type = mysql
db_name = stint
db_prefix = stint_
db_hostname = localhost
db_username = stint
db_password = stint
db_port = 3306

[routes]
rx1 = '/^([A-z0-9_]+)$/' ; control
rx2 = '/^([A-z0-9_]+){1}\/([A-z0-9]+)$/' ; control / action
rx3 = '/^([A-z0-9_]+){1}\/([A-z0-9]+)\/([A-z0-9]+)(\/([A-z0-9]+)){0,}$/' ; control / action / param1 / ... / paramN
rx4 = '/^$/' ; If nothing is entered

