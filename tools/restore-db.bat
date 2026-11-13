@echo off
chcp 65001 >nul
echo =====================================================================
echo   KENHBATDONGSAN.VN - CONG CU KHOI PHUC (RESTORE) DATABASE
echo =====================================================================
echo Cac ban backup SQL hien co trong wp-content\kenhbds-backups:
echo.
dir /b /o-d "c:\xampp\htdocs\www\kenhbds\wp-content\kenhbds-backups\*.sql"
echo.
set /p SQL_NAME="Nhap chinh xac ten file .sql muon khoi phuc (VD: kenhbds_db_manual_...sql): "

if not exist "c:\xampp\htdocs\www\kenhbds\wp-content\kenhbds-backups\%SQL_NAME%" (
    echo [LOI] Khong tim thay file "%SQL_NAME%"!
    pause
    exit /b 1
)

echo Dang khoi phuc Database tu file %SQL_NAME%...
c:\xampp\mysql\bin\mysql.exe --user=root --default-character-set=utf8mb4 kenhbds < "c:\xampp\htdocs\www\kenhbds\wp-content\kenhbds-backups\%SQL_NAME%"

if %ERRORLEVEL% EQU 0 (
    echo [HOAN TAT] Da khoi phuc Database thanh cong!
) else (
    echo [LOI] Khoi phuc that bai!
)
pause
