# Tokopedia Products Fetcher

Small APP launching multiple threads for fetching basic products info from Tokopedia.com GraphQL end points.

## Usage

This is standalone app. Supposed to be running on a *nix server wherever having nginx or apache running and properly
configured `mysql` server. For configuring connection and initial environment see `config/config.php`

### How it works

When installed and launched, app provides a small control panel on the front-end, where we define parameters and select
product categories to use. 

For demo purposes, it only fetches first 1Gb info.

## Version info
- 1.0
  - Initial implementation
