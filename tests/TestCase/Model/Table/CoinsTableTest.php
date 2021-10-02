<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoinsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoinsTable Test Case
 */
class CoinsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoinsTable
     */
    protected $Coins;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Coins',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Coins') ? [] : ['className' => CoinsTable::class];
        $this->Coins = $this->getTableLocator()->get('Coins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Coins);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
