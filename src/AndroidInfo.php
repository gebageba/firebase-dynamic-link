<?php

namespace Gebageba\FirebaseDynamicLink;

/**
 * @see https://firebase.google.com/docs/dynamic-links/create-manually
 */
class AndroidInfo extends SimpleBuilder
{
    public string $key = 'androidInfo';

    /**
     * The package name of the AndroidInfo app to use to open the link. The app must be connected to your project
     * from the Overview page of the Firebase console. Required for the Dynamic Link to open an AndroidInfo app.
     * @param string $packageName
     * @return $this
     */
    public function withPackageName(string $packageName): self
    {
        return $this->with('androidPackageName', $packageName);
    }

    /**
     * The versionCode of the minimum version of your app that can open the link.
     * If the installed app is an older version, the user is taken to the Play Store to upgrade the app.
     * @param string $versionCode
     * @return $this
     */
    public function withMinimumVersionCode(string $versionCode): self
    {
        return $this->with('androidMinPackageVersionCode', $versionCode);
    }

    /**
     * The link to open when the app isn't installed. Specify this to do something other than install your app
     * from the Play Store when the app isn't installed, such as open the mobile web version of the content,
     * or display a promotional page for your app.
     * @param string $url
     * @return $this
     */
    public function withFallbackLink(string $url): self
    {
        return $this->with('androidFallbackLink', $url);
    }
}