#!/bin/bash
find ./ -type f -name '*.php' | xargs sed -i "s/plugin-placeholder/${PWD##*/}/g"
find ./ -type f -name '*.php' | xargs sed -i "s/PLUGIN_PLACEHOLDER/$(tr '[a-z]' '[A-Z]' <<< ${PWD##*/})/g"
find ./ -type f -name '*.php' | xargs sed -i "s/PluginPlaceholder/$(awk 'BEGIN{FS="";RS="-";ORS=""} {$0=toupper(substr($0,1,1)) substr($0,2)} 1' <<< ${PWD##*/})/g"
php -r "rename('plugin-placeholder.php', '${PWD##*/}.php');"
