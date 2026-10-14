@echo off
setlocal
REM =====================================================================
REM  Zild Cafe - one-click Laravel setup for XAMPP (Windows)
REM
REM  Before running:
REM    1. Open the XAMPP Control Panel and START "MySQL" (and Apache).
REM    2. Install Composer if you don't have it: https://getcomposer.org
REM    3. Make sure XAMPP's PHP is 8.2 or newer.
REM
REM  What it does: creates a fresh Laravel app in C:\xampp\htdocs\zild-cafe,
REM  configures it for zild_cafe, copies the website/backend, and only runs
REM  migrations and seeders when the database has no existing tables.
REM =====================================================================

set "XAMPP=C:\xampp"
set "PROJECT=zild-cafe"
set "TARGET=%XAMPP%\htdocs\%PROJECT%"
set "HERE=%~dp0"
set "PATH=%XAMPP%\php;%PATH%"

where php >nul 2>nul || (echo [!] PHP not found. Is XAMPP installed in %XAMPP% ? & goto :fail)
where composer >nul 2>nul || (echo [!] Composer not found. Install it from https://getcomposer.org/Composer-Setup.exe & goto :fail)
if not exist "%XAMPP%\mysql\bin\mysql.exe" (echo [!] MySQL not found in %XAMPP%\mysql\bin & goto :fail)
if exist "%TARGET%" (echo [!] %TARGET% already exists. Rename or delete it first. & goto :fail)

echo.
echo === 1/6  Creating a fresh Laravel project (this takes a few minutes) ===
call composer create-project laravel/laravel "%TARGET%" "12.*" || goto :fail
cd /d "%TARGET%"

echo.
echo === 2/6  Creating database zild_cafe ===
"%XAMPP%\mysql\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS zild_cafe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci" || (echo [!] Could not reach MySQL. Is it started in the XAMPP Control Panel? & goto :fail)

echo.
echo === 3/6  Installing the API layer (Laravel Sanctum) ===
call php artisan install:api --no-interaction || goto :fail

echo.
echo === 4/6  Pointing .env at XAMPP MySQL ===
powershell -NoProfile -ExecutionPolicy Bypass -File "%HERE%configure-env.ps1" || goto :fail
call php artisan config:clear

echo.
echo === 5/6  Copying the Zild Cafe backend into the project ===
xcopy "%HERE%app" "%TARGET%\app" /E /I /Y >nul || goto :fail
xcopy "%HERE%database" "%TARGET%\database" /E /I /Y >nul || goto :fail
xcopy "%HERE%routes" "%TARGET%\routes" /E /I /Y >nul || goto :fail
xcopy "%HERE%resources" "%TARGET%\resources" /E /I /Y >nul || goto :fail
xcopy "%HERE%public" "%TARGET%\public" /E /I /Y >nul || goto :fail

echo.
echo === 6/6  Preparing database and storage ===
call php artisan storage:link
"%XAMPP%\mysql\bin\mysql.exe" -u root -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='zild_cafe' AND table_name IN ('users','password_reset_tokens','sessions','cache','cache_locks','personal_access_tokens','categories','products','product_sizes','carts','cart_items','orders','order_items','blog_posts','reviews','team_members','contact_messages','settings')" > "%TEMP%\zild-cafe-table-count.txt" || goto :fail
set /p "TABLE_COUNT="<"%TEMP%\zild-cafe-table-count.txt"
del "%TEMP%\zild-cafe-table-count.txt" >nul 2>nul
if "%TABLE_COUNT%"=="18" goto :database_existing
if not "%TABLE_COUNT%"=="0" goto :schema_incomplete
call php artisan migrate --seed --force || goto :fail
goto :database_ready

:database_existing
echo Existing 18-table database found. Keeping its schema and records unchanged.
goto :database_ready

:schema_incomplete
echo [!] The existing zild_cafe database has an incomplete schema. No migrations or seed data were applied.
goto :fail

:database_ready

echo.
echo =====================================================================
echo  DONE!   Start the app with:
echo      cd /d "%TARGET%"
echo      php artisan serve
echo  Then open  http://127.0.0.1:8000        (the Zild Cafe website)
echo             http://127.0.0.1:8000/api/menu   (the API)
echo.
echo  Local development demo logins (password: password; never use online):
echo      admin@zildcafe.com     customer@example.com
echo  Configure ZILD_ADMIN_EMAIL and ZILD_ADMIN_PASSWORD for production.
echo =====================================================================
pause
exit /b 0

:fail
echo.
echo Setup stopped. Fix the problem above, then run setup.bat again
echo (delete %TARGET% first if it was partly created).
pause
exit /b 1
