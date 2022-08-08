# Reports CLI

Hardcore mode for geeks. Clean code, nothing more (even without PHP). Patterns: YAGNI, KISS.

    # Optional: set MySQL-settings to env/mysql.env
    # Start Docker container with MySQL-server, apply initial SQL and migrations
    # Note: "$PWD" works on Linux and Mac. On Windows replace it to your absolute path.
    docker run --name report_cli --env-file env/mysql.env -v "$PWD/migrations":/docker-entrypoint-initdb.d -d -it mariadb:latest --default-authentication-plugin=mysql_native_password --character-set-server=utf8 --collation-server=utf8_general_ci --default-storage-engine=InnoDB

    # Optional: set report-settings to env/sqlReports.env
    # Substitute ENV report-settings to SQL queries
    # Note: Docker is used for cross compatibility with different OS
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/activeClientsAndUsersWithTimeByPeriod.sql'   > runtime/sql/activeClientsAndUsersWithTimeByPeriod.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/activeClientsWithTime.sql'                   > runtime/sql/activeClientsWithTime.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/activeClientsWithTimeByPeriod.sql'           > runtime/sql/activeClientsWithTimeByPeriod.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/allClientsAndUsers.sql'                      > runtime/sql/allClientsAndUsers.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/allClientsAndUsersWithTime.sql'              > runtime/sql/allClientsAndUsersWithTime.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/allClientsWithTime.sql'                      > runtime/sql/allClientsWithTime.sql
    docker run --env-file env/sqlReports.env -v "$PWD/sqlReports":/root/sqlReports --rm cmd.cat/envsubst sh -c 'envsubst < /root/sqlReports/inactiveClientsAndUsersWithTimeByPeriod.sql' > runtime/sql/inactiveClientsAndUsersWithTimeByPeriod.sql

    # Run SQL-queries with substituted ENV variables, store TSV-files
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/activeClientsAndUsersWithTimeByPeriod.sql   > runtime/tsv/activeClientsAndUsersWithTimeByPeriod.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/activeClientsWithTime.sql                   > runtime/tsv/activeClientsWithTime.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/activeClientsWithTimeByPeriod.sql           > runtime/tsv/activeClientsWithTimeByPeriod.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/allClientsAndUsers.sql                      > runtime/tsv/allClientsAndUsers.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/allClientsAndUsersWithTime.sql              > runtime/tsv/allClientsAndUsersWithTime.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/allClientsWithTime.sql                      > runtime/tsv/allClientsWithTime.tsv
    docker exec --env-file env/mysql.env -i report_cli sh -c 'exec mysql -u${MYSQL_USER} -p${MYSQL_PASSWORD} --database=${MYSQL_DATABASE} --default-character-set=utf8'  < runtime/sql/inactiveClientsAndUsersWithTimeByPeriod.sql > runtime/tsv/inactiveClientsAndUsersWithTimeByPeriod.tsv
    
    # For debugging
    # docker exec --env-file env/mysql.env -it report_cli bash

    # See results in runtime/*.tsv files. Open these files in Microsoft Excel, LibreOffice Calc, Google Sheets, etc.

    # Stop and drop Docker container with MySQL server
    docker stop report_cli
    docker rm -v report_cli

## Folders
    
* `env` - ENV-variables for MySQL and for SQL queries
* `migrations` - initial SQL and migrations
* `runtime` - temporary data (outside `git`)
  * `sql` - SQL-files from `sqlReports` with substituted ENV variables
  * `tsv` - TSV-files, the result of SQL-reports execution
* `sqlReports` - pseudo SQL-files with variables. It's necessary to substitute ENV variables before execution
