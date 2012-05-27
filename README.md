#cooming soon...

Grab your articles from Google Reader, download all articles (no RSS precontent) with photo and send before breakfast to your kindle.

## Getting started
For example:

php ./n2k -l={google account}@gmail.com -p={your password} -k={amazon account}@kindle.com -i=3 -g
 - Get 3 items from google reader and save

php ./n2k -l={google account}@gmail.com -p={your password} -k={amazon account}@kindle.com -m
 - Prepared mobi format and clean temporary files

php ./n2k -l={google account}@gmail.com -p={your password} -k={amazon account}@kindle.com -m -r={template name}
 - Prepared mobi format with other template (you must give name) and clean temporary files

php ./n2k -l={google account}@gmail.com -p={your password} -k={amazon account}@kindle.com -s
 - Send to kindle email and remove newspapper from drive

## SetUp CRON
Add to cron with all states if you don't have timeout for cgi script. If you have timeout (eg 30s) - grab 3-5 items in every 15 minutes and send with prepared mobi format on 7:00 o'clock 