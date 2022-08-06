#!/bin/bash -eu

. config/env.sh

CP=$(pwd)

# Launch
sudo docker run -d --restart=always --name $CLICKHOUSENAME \
   --ulimit nofile=262144:262144 \
   -p 127.0.0.1:$CLICKHOUSEPORTA:$CLICKHOUSEPORTA -p 127.0.0.1:$CLICKHOUSEPORTB:$CLICKHOUSEPORTB \
   -v $CP/log:/var/log/clickhouse-server \
   -v $CP/data:/var/lib/clickhouse \
   -v $CP/config/users.xml:/etc/clickhouse-server/users.xml \
   -v $CP/config/config.xml:/etc/clickhouse-server/config.xml \
   yandex/clickhouse-server

# Allow docker to get up and running
sleep 2

# Initialize database and user
. init.sh