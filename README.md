開發用autoloader
===

# 說明
提供各模組路徑對映，以達成自動載入類別檔-模擬已安裝狀態

# 用法
1. 安裝marshung/autoloader
```
$ composer require marshung/autoloader 1.*
```
2. 在與vendor同層目錄中建立檔案autoload.conf.php
3. 設定路徑對映資料陣列$pathMap
  - 格式：$pathMap[$namePath] = $dirPatch;
4. 執行此autoloader，如使用framework，可配置在framework設定檔中自動執行
```
// CodeIgniter: application/config/config.php
$config['enable_hooks'] = TRUE;
// CodeIgniter: application/config/hooks.php
$hook['pre_system'][] = [new \marshung\Autoloader, 'autoloader'];
```
```
// Manual call
\marshung\Autoloader::autoloader();
```