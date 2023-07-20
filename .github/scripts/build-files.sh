#!/bin/bash
# Inspired by Elementor Releasing Pipeline https://github.com/elementor/elementor
set -eo pipefail

echo "Composer Installing in dev mode"
composer install --no-dev

echo "Yarn Install"
yarn

echo "Build"
yarn build:all
