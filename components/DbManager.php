<?php

namespace mdm\admin\components;
use yii\db\Connection;
/**
 * DbManager represents an authorization manager that stores authorization information in database.
 *
 * The database connection is specified by [[$db]]. The database schema could be initialized by applying migration:
 *
 * ```
 * yii migrate --migrationPath=@yii/rbac/migrations/
 * ```
 *
 * If you don't want to use migration and need SQL instead, files for all databases are in migrations directory.
 *
 * You may change the names of the three tables used to store the authorization data by setting [[\yii\rbac\DbManager::$itemTable]],
 * [[\yii\rbac\DbManager::$itemChildTable]] and [[\yii\rbac\DbManager::$assignmentTable]].
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class DbManager extends \yii\rbac\DbManager
{
    /**
     * Memory cache of assignments
     * @var array
     */
    private $_assignments = [];
    private $_childrenList;
    // 修改数据库连接
    public function init()
    {
        parent::init();
        $host = '127.0.0.1';
        $dbname = 'tmc_test';
        $connection = new Connection([
            'dsn' => 'mysql:host='.$host.';dbname='.$dbname,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix'=>'t_'
        ]);
        $connection->open();

        $this->db = $connection;
        if ($this->cache !== null) {
            $this->cache = Instance::ensure($this->cache, Cache::className());
        }
    }
    /**
     * @inheritdoc
     */
    public function getAssignments($userId)
    {
        if (!isset($this->_assignments[$userId])) {
            $this->_assignments[$userId] = parent::getAssignments($userId);
        }
        return $this->_assignments[$userId];
    }

    /**
     * @inheritdoc
     */
    protected function getChildrenList()
    {
        if ($this->_childrenList === null) {
            $this->_childrenList = parent::getChildrenList();
        }
        return $this->_childrenList;
    }
}
