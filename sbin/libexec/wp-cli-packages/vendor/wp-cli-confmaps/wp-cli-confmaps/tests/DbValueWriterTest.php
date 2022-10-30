<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use WP\CLI\ConfMaps\ConfMapService;
use WP\CLI\ConfMaps\WpOptionsIO\TestStub;

final class DbValueWriterTest extends TestCase
{



    public function testWriteString (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optStr' => "text",
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            $confMap1['data']['optStr'],
            TestStub::$rawOptions['optStr'],
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteInteger (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optInt' => 12345,
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            $confMap1['data']['optInt'],
            TestStub::$rawOptions['optInt'],
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteArray (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optArray' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'itemOne' => 'val1',
                        'itemTwo' => 'val2',
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'a:2:{s:7:"itemOne";s:4:"val1";s:7:"itemTwo";s:4:"val2";}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['optArray'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteObject (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optObject' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'value' => [
                        'propOne' => 'val1',
                        'propTwo' => 'val2',
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'O:8:"stdClass":2:{s:7:"propOne";s:4:"val1";s:7:"propTwo";s:4:"val2";}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['optObject'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteArrayBool (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optArray' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'itemTrue'  => true,
                        'itemFalse' => false,
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'a:2:{s:9:"itemFalse";b:0;s:8:"itemTrue";b:1;}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['optArray'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteNestedArrays (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedArrays' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'level1' => [
                            'type' => "array",
                            'value' => [
                                'level2' => [
                                    'type' => "array",
                                    'value' => [
                                        'level3' => [
                                            'type' => "array",
                                            'value' => [
                                                'var' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'a:1:{s:6:"level1";a:1:{s:6:"level2";a:1:{s:6:"level3";a:1:{s:3:"var";s:3:"val";}}}}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['nestedArrays'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }



    public function testWriteNestedObjects (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedObjects' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'value' => [
                        'level1' => [
                            'type' => "object",
                            'value' => [
                                'level2' => [
                                    'type' => "object",
                                    'value' => [
                                        'level3' => [
                                            'type' => "object",
                                            'value' => [
                                                'varName' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'O:8:"stdClass":1:{s:6:"level1";O:8:"stdClass":1:{s:6:"level2";O:8:"stdClass":1:{s:6:"level3";O:8:"stdClass":1:{s:7:"varName";s:3:"val";}}}}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['nestedObjects'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }




    public function testWriteNestedMix (): void
    {
        // Define IO handler
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");
        TestStub::$rawOptions = [];

        // Conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedMix' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'value' => [
                        'level1' => [
                            'type' => "array",
                            'value' => [
                                'level2' => [
                                    'type' => "object",
                                    'value' => [
                                        'level3' => [
                                            'type' => "array",
                                            'value' => [
                                                'varName' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        // Expected value
        $expectedValue = 'O:8:"stdClass":1:{s:6:"level1";a:1:{s:6:"level2";O:8:"stdClass":1:{s:6:"level3";a:1:{s:7:"varName";s:3:"val";}}}}';

        // Execute
        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, false);

        // Evaluate
        $this->assertEquals(
            TestStub::$rawOptions['nestedMix'],
            $expectedValue,
            var_export(TestStub::$rawOptions, true)
        );
    }
}
