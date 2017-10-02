@echo off
For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c%%a%%b)
For /f "tokens=1-2 delims=/:" %%a in ('time /t') do (set mytime=%%a%%b)
echo --- backup database on %mydate%_%mytime% ---


cd D:\Proj\xampp\mysql\bin
mysqldump.exe -h localhost -u root -pripjustice sirama --routines > D:\Proj\xampp\htdocs\myproj\sirama\sql\sirama_%mydate%.sql