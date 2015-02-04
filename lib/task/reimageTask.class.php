<?php

class reimageTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name','frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'frontend';
    $this->name             = 'reimage';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [ba:recount|INFO] task does things.
Call it with:

  [php symfony frontend:lesson|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    $this->context = sfContext::createInstance($this->configuration);

    $pdo = Doctrine_Manager::connection()->getDbh();


      $this->logSection('imagetransform', 'Reimage...');

      $img = Doctrine::getTable('Photo')->findAll();


      foreach($img as $i)
      {
          $i->setImage($i->getImage());
          $i->save();
          $this->logSection('imagetransform', $i->getImage());
      }
     // $pdo->exec('COMMIT');

      $this->logSection('imagetransform', 'done ...');

    
    echo 'done';
   

   
  }
  
	
  
}
