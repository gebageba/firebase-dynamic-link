<?php

/*
 * This file is part of Firebase-Dynamic-Login.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

class IOSInfo extends SimpleBuilder
{
    public string $key = 'iosInfo';

    /**
     * The bundle ID of the iOS app to use to open the link.
     * The app must be connected to your project from the Overview page of the Firebase console.
     * Required for the Dynamic Link to open an iOS app.
     * @param string $bundleID
     * @return $this
     */
    public function withBundleID(string $bundleID): self
    {
        return $this->with('iosBundleId', $bundleID);
    }

    /**
     * The link to open when the app isn't installed. Specify this to do something other than install your app
     * from the App Store when the app isn't installed, such as open the mobile web version of the content,
     * or display a promotional page for your app.
     * @param string $url
     * @return $this
     */
    public function withFallbackLink(string $url): self
    {
        return $this->with('iosFallbackLink', $url);
    }

    /**
     * Your app's custom URL scheme, if defined to be something other than your app's bundle ID
     * @param string $urlScheme
     * @return $this
     */
    public function withUrlScheme(string $urlScheme): self
    {
        return $this->with('iosCustomScheme', $urlScheme);
    }

    /**
     * The link to open on iPads when the app isn't installed. Specify this to do something other than install your app
     * from the App Store when the app isn't installed, such as open the web version of the content,
     * or display a promotional page for your app.
     * @param string $url
     * @return $this
     */
    public function withIPadFallbackLink(string $url): self
    {
        return $this->with('iosIpadFallbackLink', $url);
    }

    /**
     * The bundle ID of the iOS app to use on iPads to open the link.
     * The app must be connected to your project from the Overview page of the Firebase console.
     * @param string $bundleID
     * @return $this
     */
    public function withIPadBundleID(string $bundleID): self
    {
        return $this->with('iosIpadBundleId', $bundleID);
    }

    /**
     * Your app's App Store ID, used to send users to the App Store when the app isn't installed
     * @param string $appStoreID
     * @return $this
     */
    public function withAppStoreID(string $appStoreID): self
    {
        return $this->with('iosAppStoreId', $appStoreID);
    }
}
