<?php

namespace App\Chapter4\LateStaticBinding;

use Exception;

class Conf
{
    private \SimpleXMLElement $xml;
    private \SimpleXMLElement $lastMatch;

    /**
     * @throws Exception
     */
    public function __construct(private string $file)
    {
        if (! file_exists($file))
        {
            throw new Exception("File {$file} doesn't exist.");
        }

        print "This file is apparently writable: {$this->file}" . PHP_EOL;

        $this->xml = simplexml_load_file($file);
    }
    public function write(): void
    {
        file_put_contents($this->file, $this->xml->asXML());
    }
    public function get(string $str): ?string
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastMatch = $matches[0];
            return (string)$matches[0];
        }

        return null;
    }
    public function set(string $key, string $value): void
    {
        if (! is_null($this->get($key)))
        {
            $this->lastMatch[0] = $value;

            return;
        }

        $conf = $this->xml->conf;
        $this->xml->addChild("item", $value)->addAttribute("name", $key);
    }
}

try {
    $conf = new Conf("./test.xml");
    print "User: " . $conf->get("user") . PHP_EOL;
    print "Host: " . $conf->get("host") . PHP_EOL;
    $conf->set("pass", "newpass");
    $conf->write();
} catch (Exception $e) {
    // Handle the error in some way
    // or
    throw new Exception("Conf error: " . $e->getMessage());
}

//try {
//    $conf = new Conf("/tmp/non_existent.xml");
//} catch (Exception $e) {
//    print "There was a problem handling this request...";
//}