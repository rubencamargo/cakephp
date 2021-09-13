<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersRolesTable Test Case
 */
class UsersRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersRolesTable
     */
    protected $UsersRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UsersRoles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersRoles') ? [] : ['className' => UsersRolesTable::class];
        $this->UsersRoles = $this->getTableLocator()->get('UsersRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UsersRoles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersRolesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
