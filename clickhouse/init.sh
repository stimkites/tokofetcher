#!/bin/bash -eu

. config/env.sh

sudo docker run -it --rm --link $CLICKHOUSENAME:clickhouse-server \
              yandex/clickhouse-client --host clickhouse-server --multiquery --query \
              "
              DROP DATABASE IF EXISTS tokoshit;
              DROP USER IF EXISTS tokouser;
              CREATE DATABASE tokoshit;
              CREATE USER tokouser IDENTIFIED WITH PLAINTEXT_PASSWORD BY 'aPchGhui!';
              GRANT ALL PRIVILEGES ON tokoshit.* TO tokouser;
              "