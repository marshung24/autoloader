開發用autoloader
===

# 說明
提供各模組路徑對映，以達成自動載入類別檔-模擬已安裝狀態

# 用法
1. 在Document Root中建立檔案autoload.conf.php
2. 設定路徑對映資料陣列$pathMap
  格式：$pathMap[$namePath] = $dirPatch;
3. 執行此autoloader，如使用framework，可配置在framework設定檔中自動執行
```
\marshung\Autoloader::autoloader();
```