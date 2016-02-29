<?php

namespace Changelog\Test\Parser;

use ChangelogParser\Parser\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase {
    /** @var \ChangelogParser\Parser\Parser **/
    private $parser;
    
    public function __construct() {
        $this->parser = new Parser();
    }
    
    public function testParse() {
        $data = $this->parser->parse(dirname(__DIR__) . '/fixtures/changelog-fixture.md');
        
        $this->assertInternalType('array', $data);
        $this->assertCount(3, $data);
        $this->assertArrayHasKey('unreleased', $data);
        $this->assertArrayHasKey('date', $data['0.3.0']);
    }
}