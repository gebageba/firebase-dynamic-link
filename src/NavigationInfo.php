<?php

/*
 * This file is part of Firebase-Dynamic-Link.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gebageba\FirebaseDynamicLink;

class NavigationInfo extends SimpleBuilder implements NavigationInfoInterface
{
    public string $key = 'navigationInfo';

    /**
     * If set to '1', skip the app preview page when the Dynamic Link is opened, and instead redirect to the app or store.
     * The app preview page (enabled by default) can more reliably send users to the most appropriate destination when they open Dynamic Links in apps;
     * however, if you expect a Dynamic Link to be opened only in apps that can open Dynamic Links reliably without this page, you can disable it with this parameter.
     * This parameter will affect the behavior of the Dynamic Link only on iOS.
     * @return $this
     */
    public function withoutAppPreviewPage(): self
    {
        return $this->with('enableForcedRedirect', 1);
    }
}
