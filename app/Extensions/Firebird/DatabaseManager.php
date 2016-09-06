<?php namespace App\Extensions\Firebird;

use Illuminate\Database\DatabaseManager as BaseDatabaseManager;

use App\Extensions\Firebird\ConnectionFactory as FirebirdConnectionFactory;

class DatabaseManager extends BaseDatabaseManager {

  /**
   * Create a new database manager instance.
   *
   * @param  \Illuminate\Foundation\Application  $app
   * @param  \Illuminate\Database\Connectors\ConnectionFactory  $factory
   * @return void
   */
  public function __construct($app, FirebirdConnectionFactory $factory)
  {
    $this->app = $app;
    $this->factory = $factory;
  }

}