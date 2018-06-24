<?php
namespace marshung;

/**
 * 開發用autoloader
 *
 * 提供各模組路徑對映，以達成自動載入類別檔-模擬已安裝狀態
 *
 * 使用：
 * 1. 在Document Root中建立檔案autoload.conf.php
 * 2. 設定路徑對映資料陣列$pathMap
 * - 格式：$pathMap[$namePath] = $dirPatch;
 * 3. 執行此autoloader，如使用framework，可配置在framework設定檔中自動執行
 * - \marshung\Autoloader::autoloader();
 *
 * @author Mars.Hung
 * @version 1.0.0
 * 
 */
class Autoloader
{

    public function __construct()
    {}

    public static function autoloader()
    {
        $pMap = array();
        // 與vendor同層
        $docRoot = __DIR__.'/../../../../';
        
        // 讀入路徑設定檔
        if (file_exists($docRoot . 'autoload.conf.php')) {
            include_once ($docRoot . 'autoload.conf.php');
            
            // 讀取設定檔的路徑對映表
            if (isset($pathMap) && is_array($pathMap)) {
                $pMap = $pathMap;
            }
        }
        
        // Autoload Function Registe
        spl_autoload_register(
            function ($class) use ($pMap) {
                // 遍歷$pathMap，以找尋可用的自動載入對映
                foreach ($pMap as $namePath => $path) {
                    // 如果是prefix開頭的class，前往目標目錄載入類別檔
                    if (strpos(strtolower($class), $namePath) === 0) {
                        // 取得目標路徑
                        $filePath = str_replace('\\', DIRECTORY_SEPARATOR, str_replace($namePath, $path, $class)) . '.php';
                        // 檢查檔案是否存在
                        if (file_exists($filePath)) {
                            // 載入類別檔
                            include_once ($filePath);
                            return true;
                        }
                    }
                }
            });
    }
}