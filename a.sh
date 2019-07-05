#!/bin/sh
getFiscalWeekYear() {
    local d=$(date -d "$1" "+%y%W0%u")
    echo $d | awk '{printf "%02d%02d%02d",substr($0,1,2), substr($0,3,2)+1,substr($0,5,2) }'
}

if [ ! -z "$1" ] ; then
    filename=$1
    target="$(grep 'const char \*AT_GMR_ID' $filename)"
    if [ ! -z "$target" ] ; then
        orignal=$(echo  $target | awk -F'"' '{print $2}')
        ad=$(echo $target | awk -F'"' '{split($2,d,"_");print d[2]}')
        replace="$(getFiscalWeekYear $ad)"
        `sed -i "s/${orignal}/${replace}/" $filename`
    fi
fi
