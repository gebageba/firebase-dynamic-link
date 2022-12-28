<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink\Test\Unit;

use Gebageba\FirebaseDynamicLink\AndroidInfo;
use Gebageba\FirebaseDynamicLink\DynamicLinkParameter;
use Gebageba\FirebaseDynamicLink\Exception\InvalidUriException;
use Gebageba\FirebaseDynamicLink\IOSInfo;
use PHPUnit\Framework\TestCase;

final class DynamicLinkParameterTest extends TestCase
{
    /**
     * DynamicLinkParameter Test
     */
    public function testDynamicLinkParameter()
    {
        $domainUrlPrefix = 'https://sample.page.link';
        $versionCode = '1.2.3';
        $androidFallbackLink = 'https://sample.com/fallback/android';
        $link = 'https://sample.jp/app/page/1';
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
                    ->withMinimumVersionCode($versionCode)
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
            ->withoutAppPreviewPage()
            ->getData();

        $this->assertEquals([
            'link' => $link,
            'androidInfo' => [
                'androidPackageName' => $androidPackageName,
                'androidMinPackageVersionCode' => $versionCode,
                'androidFallbackLink' => $androidFallbackLink
            ],
            'iosInfo' => [
                'iosBundleId' => $iosBundleId,
                'iosAppStoreId' => $iosAppStoreId,
                'iosFallbackLink' => $iosFallbackLink,
                'iosCustomScheme' => $customUrlScheme,
                'iosIpadBundleId' => $iPadBundleID,
                'iosIpadFallbackLink' => $ipadFallbackLink
            ],
            'domainUriPrefix' => $domainUrlPrefix,
            'navigationInfo' => [
                'enableForcedRedirect' => 1
            ]
        ], $dynamicLink);
    }

    /**
     * DynamicLinkParameter Test
     * If domainUrlPrefix doesn't match Url regex, catch error.
     */
    public function testThrowErrorAboutDomainUrlPrefix()
    {
        $domainUrlPrefix = 'sample.page.link';
        $link = 'https://sample.jp/app/page/1';
        $androidPackageName = 'jp.sample';
        $iosBundleId = 'jp.sample';
        $iosAppStoreId = '111111111';

        $this->expectException(InvalidUriException::class);
        DynamicLinkParameter::for($domainUrlPrefix, $link)
            ->withAndroid(
                AndroidInfo::new()
                    ->withPackageName($androidPackageName)
            )
            ->withIOS(
                IOSInfo::new()
                    ->withBundleID($iosBundleId)
                    ->withAppStoreID($iosAppStoreId)
            )
            ->withoutAppPreviewPage()
            ->getData();
    }

    /**
     * DynamicLinkParameter Test
     * If Link doesn't match Url regex, catch error.
     */
    public function testThrowErrorAboutLink()
    {
        $domainUrlPrefix = 'https://sample.page.link';
        $link = 'sample.jp/app/page/1';
        $androidPackageName = 'jp.sample';
        $iosBundleId = 'jp.sample';
        $iosAppStoreId = '111111111';

        $this->expectException(InvalidUriException::class);
        DynamicLinkParameter::for($domainUrlPrefix, $link)
            ->withAndroid(
                AndroidInfo::new()
                    ->withPackageName($androidPackageName)
            )
            ->withIOS(
                IOSInfo::new()
                    ->withBundleID($iosBundleId)
                    ->withAppStoreID($iosAppStoreId)
            )
            ->withoutAppPreviewPage()
            ->getData();
    }
}
