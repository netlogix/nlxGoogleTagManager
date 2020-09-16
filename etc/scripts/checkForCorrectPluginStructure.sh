#!/usr/bin/env sh

# This script will be used to check different structures to see if everything is correct.
# Also it will checking for old plugin structure because sometimes this skeleton will be used
# to update an old structure to a new one and the build process should fail then.

IS_OLD_PLUGIN_STRUCTURE=false
if [ -f 'Bootstrap.php' ]; then
    IS_OLD_PLUGIN_STRUCTURE=true
fi

if [[ true == $IS_OLD_PLUGIN_STRUCTURE ]]; then
    echo 'Old plugin structure is not supported, please update to new plugin structure!';
    echo 'https://gitlab.com/solutionDrive/shopwarepluginskeleton will create a plugin with new structure for you';
    exit 1;
fi
exit 0;
