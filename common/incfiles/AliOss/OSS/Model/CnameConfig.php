<?php

namespace OSS\Model;


use OSS\Core\OssException;

class CnameConfig implements XmlConfig
{
    public function __construct()
    {
        $this->cnameList = array();
    }
    public function getCnames()
    {
        return $this->cnameList;
    }


    public function addCname($cname)
    {
        if (count($this->cnameList) >= self::OSS_MAX_RULES) {
            throw new OssException(
                "num of cname in the config exceeds self::OSS_MAX_RULES: " . strval(self::OSS_MAX_RULES));
        }
        $this->cnameList[] = array('Domain' => $cname);
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->Cname)) return;
        foreach ($xml->Cname as $entry) {
            $cname = array();
            foreach ($entry as $key => $value) {
                $cname[strval($key)] = strval($value);
            }
            $this->cnameList[] = $cname;
        }
    }

    public function serializeToXml()
    {
        $strXml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<BucketCnameConfiguration>
</BucketCnameConfiguration>
EOF;
        $xml = new \SimpleXMLElement($strXml);
        foreach ($this->cnameList as $cname) {
            $node = $xml->addChild('Cname');
            foreach ($cname as $key => $value) {
                $node->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    const OSS_MAX_RULES = 10;

    private $cnameList = array();
}