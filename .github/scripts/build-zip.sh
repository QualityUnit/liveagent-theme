#!/bin/bash
# Inspired by Elementor Releasing Pipeline https://github.com/elementor/elementor
set -eo pipefail

if [[ -z "$PACKAGE_VERSION" ]]; then
	echo "Missing PACKAGE_VERSION env var"
	exit 1
fi

rm -rf node_modules vendor .git .idea .github .husky *.md *.lock .editorconfig .eslintignore .eslintrc .gitignore .stylelintrc composer.json gulpfile.js commitlint.config.js package.json phpcs.xml
cd ./apps/web-calc/ && rm -rf node_modules public src build.js package.json README.md yarn.lock
cd ../web-calc-featured/ && rm -rf node_modules public src build.js package.json README.md yarn.lock
cd ../typing-test/ && rm -rf node_modules public src .babelrc package.json README.md tsconfig.json webpack.config.js yarn.lock
cd ../../lib/widgets/qu-reviews/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-commonproblems/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-checklists/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-howtos/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-expertnote/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-usecase/ && rm -rf node_modules package.json yarn.lock webpack.config.js
cd ../qu-banners/ && rm -rf node_modules package.json yarn.lock
cd ../statistics/ && rm -rf node_modules package.json yarn.lock

cd ../../..

PLUGIN_ZIP_FILENAME="liveagent_${PACKAGE_VERSION}.zip"
dir_name="liveagent"
mkdir "$dir_name"
for file in *; do
    if [ "$file" != "$dir_name" ]; then
        mv "$file" "$dir_name"
    fi
done

zip -r $PLUGIN_ZIP_FILENAME ./liveagent/ -x "*.zip"
echo "PLUGIN_ZIP_FILENAME=${PLUGIN_ZIP_FILENAME}" >> $GITHUB_ENV
echo "PLUGIN_ZIP_PATH=./**/*" >> $GITHUB_ENV
