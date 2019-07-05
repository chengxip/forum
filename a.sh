#!/bin/sh
getFiscalWeekYear() {
    local d=$(date -d "$1" "+%y%W0%u")
    echo $d | awk '{printf "%02d%02d%02d",substr($0,1,2), substr($0,3,2)+1,substr($0,5,2) }'
}
a=$(getFiscalWeekYear 20190707)
echo $a
