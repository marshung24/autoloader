<?php
namespace marshung;

/**
 * 開發用autoloader
 *
 * 提供各模組路徑對映，以達成自動載入類別檔
 *
 * @author Mars.Hung
 */
class Autoloader
{

    /**
     * 路徑對映 - 仿composer
     * 
     * @var array
     */
    protected static $pathMap = array(
        'marshung\\io\\' => '..\\marshung\\io\\src\\'
    );

    public function __construct()
    {}

    public static function autoloader()
    {
        $pMap = self::$pathMap;
        
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
                        }
                    }
                }
            });
    }
}