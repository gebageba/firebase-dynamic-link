<?php

namespace Gebageba\FirebaseDynamicLink;

/**
 * @see https://firebase.google.com/docs/reference/dynamic-links/link-shortener
 */
class DynamicLinkParameter extends BaseBuilder implements DynamicLinkParameterInterface
{
    /**
     * @param string $domainUriPrefix
     * @param string $link
     */
    protected function __construct(string $domainUriPrefix, string $link)
    {
        parent::__construct(compact('link', 'domainUriPrefix'));
    }

    /**
     * @param string $domain
     * @param string $link
     * @return static
     */
    public static function for(string $domain, string $link): self
    {
        return new self($domain, $link);
    }

    /**
     * @return $this
     */
    public function withoutAppPreviewPage(): self
    {
        return $this->merge(
            NavigationInfo::new()
                ->withoutAppPreviewPage()
        );
    }

    /**
     * @param AndroidInfo $info
     * @return $this
     */
    public function withAndroid(AndroidInfo $info): self
    {
        return $this->merge($info);
    }

    /**
     * @param IOSInfo $info
     * @return $this
     */
    public function withIOS(IOSInfo $info): self
    {
        return $this->merge($info);
    }
}