@echo off
chcp 65001 >nul
echo =====================================================================
echo   KENHBATDONGSAN.VN - CONG CU BACKUP DATABASE VA DULIEU 1-CLICK
echo =====================================================================

set BACKUP_DIR=c:\xampp\htdocs\www\kenhbds\wp-content\kenhbds-backups
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set TIMESTAMP=%datetime:~0,8%_%datetime:~8,6%

set SQL_FILE=%BACKUP_DIR%\kenhbds_db_cli_%TIMESTAMP%.sql

echo [1/2] Dang sao luu Database MySQL (kenhbds) ra file SQL...
c:\xampp\mysql\bin\mysqldump.exe --user=root --default-character-set=utf8mb4 --single-transaction --routines --triggers kenhbds > "%SQL_FILE%"

if %ERRORLEVEL% EQU 0 (
    echo [OK] Da luu Database tai: %SQL_FILE%
) else (
    echo [LOI] Khong the chay mysqldump. Vui long kiem tra MySQL trong XAMPP!
)

echo [2/2] Dang xuat Snapshot Noi dung (.JSON) qua PHP...
c:\xampp\php\php.exe -r "require 'c:/xampp/htdocs/www/kenhbds/wp-load.php'; if(class_exists('KBDS_Backup_Manager')) { echo 'Created JSON: ' . KBDS_Backup_Manager::create_json_content_backup('cli') . PHP_EOL; }"

echo =====================================================================
echo   HOAN TAT SAO LUU! File duoc luu an toan trong wp-content/kenhbds-backups
echo =====================================================================
pause
