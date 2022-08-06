# Tokopedia Products Fetcher

ClickHouse+Laravel app for fetching products+stock info from GraphQL API interface into local storage for further 
analysis and reporting.

## Usage

This is standalone app. Supposed to be running on a *nix server wherever having nginx or apache running and properly
configured ClickHouse server. For configuring connection to ClickHouse use config/database.php.

> NOTE

This app by default is using clickhouse database connection in docker. See `clickhouse/config` for configuration and use
`clickhouse/run.sh` to launch local clickhouse database server and establish connection to it.

### How it works

When launched, it fetches all available product categories from the source (here it is Tokopedia.com). You can always 
re-configure the source under config/source.php. It allows selecting up to 20 threads and define certain categories
for fetching product info.

For demo purposes, it only fetches first 1Gb of info. This may be easily deactivated under config/source.php as well.

## Version info
- 1.0
  - Initial implementation
