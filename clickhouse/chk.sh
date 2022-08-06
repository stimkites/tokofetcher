#!/bin/bash -eu

. config/env.sh

sudo docker run -it --rm --link $CLICKHOUSENAME:clickhouse-server \
              yandex/clickhouse-client --host clickhouse-server --query "select version();"
