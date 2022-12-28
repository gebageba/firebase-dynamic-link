<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink\Test\Unit;

use Gebageba\FirebaseDynamicLink\AndroidInfo;
use Gebageba\FirebaseDynamicLink\DynamicLink;
use Gebageba\FirebaseDynamicLink\DynamicLinkParameter;
use Gebageba\FirebaseDynamicLink\IOSInfo;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase;

final class DynamicLinkTest extends TestCase
{
    /**
     * DynamicLinkのテスト
     */
    public function testDynamicLink()
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
            ->withoutAppPreviewPage();

        $firebaseApiKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

        $client = Mockery::mock('overload:GuzzleHttp\Client');
        $client->shouldReceive('request')
                ->once()
                ->andReturn(
                    new Response(
                        200,
                        ['Content-Type' => 'application/json'],
                        '{"shortLink": "https://sample.com/SAMP"}'
                    )
                );

        $shortLink = DynamicLink::generateUnguessableDynamicLink($firebaseApiKey, $dynamicLink);
        $this->assertSame('https://sample.com/SAMP', $shortLink->getShortLink());
    }
}
