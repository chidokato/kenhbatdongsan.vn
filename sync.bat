@echo off
chcp 65001 >nul
echo ====================================================================
echo  🚀 TOOL TỰ ĐỘNG ĐỒNG BỘ 1-CLICK: LOCALHOST -> KENHBATDONGSAN.VN
echo ====================================================================
echo.

echo [1/3] Đang đồng bộ Database, Dự án, Giỏ hàng, Bài viết qua REST API...
"C:\xampp\php\php.exe" "tools\sync-all.php"

echo.
echo [2/3] Đang chuẩn bị Git commit (Code + Hình ảnh tải lên)...
git add .
git commit -m "Auto sync: Cap nhat he thong & noi dung moi nhat"

echo.
echo [3/3] Đang Git push lên remote repository...
git push kenhbds master

echo.
echo ====================================================================
echo  ✔ HOÀN TẤT ĐỒNG BỘ TOÀN BỘ DỮ LIỆU & CODE!
echo ====================================================================
pause
