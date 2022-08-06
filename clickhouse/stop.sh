#!/bin/bash -eu

. config/env.sh

sudo docker stop $CLICKHOUSENAME
sudo docker rm $CLICKHOUSENAME