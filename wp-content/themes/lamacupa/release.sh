#!/bin/bash
# Lamacupa Theme Release Script
VERSION="2.0.0"
THEME_DIR="$(dirname "$0")"
ZIP_NAME="lamacupa-theme-${VERSION}.zip"
cd "$(dirname "$THEME_DIR")"
zip -r "$ZIP_NAME" lamacupa/ --exclude "*.git*" --exclude "*.DS_Store*"
echo "Released: $ZIP_NAME"
