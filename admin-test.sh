#!/bin/bash
CSRF=$(curl -s -c /tmp/cj.txt "http://localhost/login" | grep -oP "name=\"_token\".*?value=\"\K[^\"]+")
echo "CSRF: $CSRF"
RESP=$(curl -s -c /tmp/cj.txt -b /tmp/cj.txt -L -X POST "http://localhost/login" -d "_token=$CSRF" -d "nik=1234567890123456" -d "password=admin123" -o /dev/null -w "%{http_code}")
echo "Login: $RESP"
for page in /admin/home /admin/surat /admin/aparatur /admin/news /admin/users /admin/stores /admin/products /admin/villagedata /admin/refmaster /admin/roles /admin/permissions /admin/templatesurat; do
  R=$(curl -s -o /dev/null -w "%{http_code}" -b /tmp/cj.txt "http://localhost${page}")
  echo "${page}: ${R}"
done
