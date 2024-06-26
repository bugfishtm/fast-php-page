@echo off
cd /d %~dp0
echo ------------------------
echo Do you want this Repo
echo with version code 2.20_0.00.000?
echo ------------------------
pause
git add .
git commit -m "2.20_0.00.000"
git push -u origin main
pause