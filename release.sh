#!/bin/bash
# Usage: ./release.sh [version]
# Example: ./release.sh 1.2.0
# If no version given, auto-increments patch version

THEME_DIR="wp-content/themes/lamacupa"
STYLE_CSS="$THEME_DIR/style.css"

# Get current version
CURRENT=$(grep "^Version:" "$STYLE_CSS" | sed 's/Version: //')

if [ -z "$1" ]; then
    # Auto-increment patch
    MAJOR=$(echo $CURRENT | cut -d. -f1)
    MINOR=$(echo $CURRENT | cut -d. -f2)
    PATCH=$(echo $CURRENT | cut -d. -f3)
    NEW_VERSION="$MAJOR.$MINOR.$((PATCH + 1))"
else
    NEW_VERSION="$1"
fi

echo "Bumping version: $CURRENT → $NEW_VERSION"

# Update style.css
sed -i "s/^Version: .*/Version: $NEW_VERSION/" "$STYLE_CSS"

# Create ZIP
ZIP_NAME="lamacupa-theme-v${NEW_VERSION}.zip"
cd wp-content/themes
zip -r "../../$ZIP_NAME" lamacupa/
cd ../..

echo "✓ Versione aggiornata a $NEW_VERSION"
echo "✓ ZIP creato: $ZIP_NAME"
echo ""
echo "Per pubblicare:"
echo "  git add -A && git commit -m 'Release v$NEW_VERSION' && git push"
