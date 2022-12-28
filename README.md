# firebase-dynamic-link

`composer.json` に

```
"repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:gebageba/firebase-dynamic-link.git"
        }
        ....
    ],
```
を追加する。

```
$ composer require gebageba/firebase-dynamic-link
```

でインストールする。

# Installation
```php
$domainUrlPrefix = 'https://sample.page.link'; //DynamicLinkになるUri
$link = 'https://sample.jp/app/page/1'; //遷移先
$androidVersionCode = '1.2.3';
$androidFallbackLink = 'https://sample.com/fallback/android';
$androidPackageName = 'jp.sample';
$iosBundleId = 'jp.sample';
$iosAppStoreId = '111111111';
$iosFallbackLink = 'https://your_domain.com/fallback/ipad';
$ipadFallbackLink = 'https://your_domain.com/fallback/ipad';
$iPadBundleID = 'com.sample.iPadApp';
$customUrlScheme = 'customUrlScheme';

$dynamicLink = DynamicLinkParameter::for($domainUrlPrefix, $link)
    ->withAndroid(
        AndroidInfo::new()
            ->withPackageName($androidPackageName)
            ->withMinimumVersionCode($androidVersionCode)
            ->withFallbackLink($androidFallbackLink)
    )
    ->withIOS(
        IOSInfo::new()
            ->withBundleID($iosBundleId)
            ->withAppStoreID($iosAppStoreId)
            ->withFallbackLink($iosFallbackLink)
            ->withUrlScheme($customUrlScheme)
            ->withIPadBundleID($iPadBundleID)
            ->withIPadFallbackLink($ipadFallbackLink)
    )
    ->withoutAppPreviewPage(); //iOSのみ。つけるとパラメーターが消えることがある。

$firebaseApiKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$dynamicLinkApi = 'https://firebasedynamiclinks'(デフォルトはhttps://firebasedynamiclinks.googleapis.com/v1/shortLinks)

$dynamicLink = DynamicLink::generateUnguessableDynamicLink($firebaseApiKey, $dynamicLink, $dynamicLinkApi);
$dynamicLink->getShortLink(); 
or
$dynamicLink->value();
