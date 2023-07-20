#!/bin/bash
# Inspired by Elementor Releasing Pipeline https://github.com/elementor/elementor
set -eo pipefail

if [[ -z "$PACKAGE_VERSION" ]]; then
	echo "Missing PACKAGE_VERSION env var"
	exit 1
fi

sed -i -E "s/Version: .*/Version: ${PACKAGE_VERSION}/g" style.css
sed -i -E "s/THEME_VERSION', '.*'/THEME_VERSION', '${PACKAGE_VERSION}'/g" functions.php
