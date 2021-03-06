<p align="center"><img src="logo.png" width="260" height="70" alt="Mutton"></p>

[![License](https://img.shields.io/github/license/maiyun/Mutton.svg)](https://github.com/maiyun/Mutton/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/maiyun/Mutton.svg)](https://github.com/maiyun/Mutton/issues)
[![GitHub Releases](https://img.shields.io/github/release/maiyun/Mutton.svg)](https://github.com/maiyun/Mutton/releases "Stable Release")
[![GitHub Pre-Releases](https://img.shields.io/github/release/maiyun/Mutton/all.svg)](https://github.com/maiyun/Mutton/releases "Pre-Release")

簡單、易用且功能完整的 PHP 框架。

## 語言

[English](../README.md) | [简体中文](README.zh-CN.md)

## 環境

PHP 7.3+  
Nginx/Apache

## 安裝

下載最新的發行包，解壓後即可。

> 提示：在 Nginx 中，你需要將以下規則添加到重新規則檔內：

```
if ($request_uri !~ ^/(stc/.*|favicon.\w+?\??.*|apple[\w-]+?\.png\??.*|[\w-]+?\.txt\??.*)$) {
    rewrite ^/([\s\S]*)$ /index.php?__path=$1 last;
}
```

## 庫

Captcha, Crypto, Db (MySQL, Sqlite), Kv (Memcached, Redis, RedisSimulator), Net, Session, Sql, Text.

## 特性

### 開袋即食

秉持開袋即食的原則，封裝了大量介面，簡約而不簡單，並且擁有豐富的代碼提示（基於 PHPDoc）。

### 自動載入

直接使用各種庫，系統會自動載入它。

### Mutton Portal

基於 GUI 優先原則，Mutton 附帶視覺化主控台，可以進行本地代碼檔與線上版本檔異同檢測、版本檢測以及框架升級等功能。

> 提示：我們只是採用了 Windows 2000 的懷舊風格，但我們的框架十分先進。

[![Mutton Portal](portal-check-zh-TW.png)](portal-check-zh-TW.png)

[![Mutton Portal](portal-system-zh-TW.png)](portal-system-zh-TW.png)

### 超好用 Net 庫

可以這樣用：

```php
$res = Net::open('https://xxx/test')->post()->data(['a' => '1', 'b' => '2'])->request();
```

也可以這樣用：

```php
$res = Net::get('https://xxx/test');
```


可以設置自訂的解析結果：

```php
$res = Net::get('https://xxx/test', [
    'hosts' => [
        'xxx' => '111.111.111.111'
    ]
]);
```

也可以選擇本地的其他網卡來訪問：

```php
$res = Net::get('https://xxx/test', [
    'local' => '123.123.123.123'
]);
```

更可以在訪問多條 url 時進行連結複用，大大加快存取速度：

```php
$res1 = Net::get('https://xxx/test1', [
    'reuse' => true
]);
$res2 = Net::get('https://xxx/test2', [
    'reuse' => true
]);
Net::closeAll();
```

[![Net reuse test](test-net-reuse.png)](test-net-reuse.png)

更擁有完整的 Cookie 管理器，可以輕鬆將 Cookie 獲取並存在任何地方，發送請求時，系統也會根據 Cookie 設置的功能變數名稱、路徑等來選擇發送，並且 Set-Cookie 如果有非法跨域設置，也會被捨棄不會被記錄，就像真正的瀏覽器一樣：

```php
$res1 = Net::get('https://xxx1.xxx/test1', [], $cookie);
$res2 = Net::get('https://xxx2.xxx/test2', [], $cookie);
```

> 提示：Net 庫同時支援傳入 options 和 open 鏈式操作，如 Net::open('xxx')->follow()->timeout(60)->reuse()->save(ROOT_PATH . 'doc/test.txt')->request();。

### 好用的 Db 庫

擁有大量好用的介面，可以輕鬆的從資料庫篩選出需要的資料：

```php
$ls = Order::where([
    'state' => '1'
])->by('id', 'DESC')->page(10, 1);
$list = $ls->all();
$count = $ls->count();
$total = $ls->total();
```

獲取一個使用者：

```php
$user = User::select(['id', 'user'])->filter([
    ['time_add', '>=', '1583405134']
])->first();
```

### XSRF 檢測

使用 checkXInput 方法，可以進行 XSRF 檢測，防止惡意訪問。

### 中國大陸庫支援

完整封裝了微信支付、微信登錄、阿裡雲 OSS、騰訊雲 COS、阿裡巴巴等中國特有服務的支援。（因內核框架更新升級，這些庫還未來得及更新，暫時移除，將很快進行更新）

#### 還有更多特性等你探索

## 部分示例

### 創建 16 位亂數

```php
$str = $this->_random(16, Ctr::RANDOM_N);
```

### 創建一個驗證碼

```php
Captcha::get(400, 100)->getBuffer();
```

### 獲取一個清單

```php
$userList = User::where([
    ['state', '!=', '0'],
    'type' => ['1', '2', '3'],
    'is_lock' => '0'
])->all();
```

提示：所有資料庫操作都已經做了安全防注入處理。

## 其他示例

你可以訪問 ctr/test.php 來查看更多示例。

## 更新日誌

[更新日誌](CHANGELOG.zh-TW.md)

## 許可

基於 [Apache-2.0](../LICENSE) 許可。

## 名稱含義

作者愛吃羊 XD。

## 參與翻譯

我們工作基於中文語言環境，若對本專案感興趣並對除中文簡體、中文繁體之外語種熟悉的朋友，歡迎一起參與翻譯工作，感興趣的朋友可以加入以下群組。

除中國大陸之外翻譯 Telegram 群組：[HTTPs://t.me/maiyunlocal](HTTPs://t.me/maiyunlocal)  
中國大陸翻譯 QQ 群：24158113