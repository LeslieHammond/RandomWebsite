<?php
// src/Service/LinkSanitizer.php
namespace App\Service;

class LinkSanitizer
{

    private $url;
    private $parsedUrl;

    private $goodUrl;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getDomain()
    {
        if (!isset($this->parsedUrl['host']))
        {
            return null;
        }

        return $this->parsedUrl['host'];
    }

    public function checkValidUrl()
    {
        return filter_var($this->url, FILTER_VALIDATE_URL);
    }

    public function sanitize()
    {
        if ($this->checkValidUrl() === false)
        {
            throw new \Exception("is an invalid URL");
        }

        $this->parsedUrl = parse_url($this->url);

        switch ($this->parsedUrl['host'])
        {
            case 'www.amazon.es':
                # code...
                $this->amazonLink();
                break;

            default:
                # code...
                $this->goodUrl = $this->url;
                break;
        }

        return $this->goodUrl;
    }

    /* specific domain functions */
    public function amazonLink()
    {
        $separators = ['/dp/', '/gp/product/'];

        $found = false;
        foreach ($separators as $separator)
        {
            if ($found === false)
            {
                $exp = explode($separator, $this->parsedUrl['path']);

                if (isset($exp[1]))
                {
                    $found = $separator;
                }
            }
        }

        if ($found !== false)
        {
            $exp2 = explode('/', $exp[1]);

            $url = $found . $exp2[0];

            $this->goodUrl = $this->parsedUrl['host'] . $url;
        }
        else
        {
            throw new \Exception('unknown format');
        }
    }

}
