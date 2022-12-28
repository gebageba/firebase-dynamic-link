<?php

namespace Gebageba\FirebaseDynamicLink;

use Gebageba\FirebaseDynamicLink\Exception\InvalidUriException;

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
        $this->validate($domainUriPrefix);
        $this->validate($link);

        parent::__construct(compact('link', 'domainUriPrefix'));
    }

    /**
     * @param string $domainUriPrefix
     * @param string $link
     * @return static
     */
    public static function for(string $domainUriPrefix, string $link): self
    {
        return new self($domainUriPrefix, $link);
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

    public function getData(): array
    {
        return parent::getData();
    }

    private function validate(string $uri): void
    {
        if (! preg_match('/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}' . '((:[0-9]{1,5})?\\/.*)?$/i', $uri)) {
            throw new InvalidUriException('uriを指定してください');
        }
    }
}