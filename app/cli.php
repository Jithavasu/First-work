<?php 

namespace App;
use Symfony\Component\Console\Application;
use App\Tnq\Todo\Command\TaskCommand;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
//use Doctrine\DBAL\DriverManager;

//require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/connection.php';

   
        $application = new Application();               
                
                // $queryBuilder = $conn->createQueryBuilder();
                // $queryBuilder->select('*')->from('users');                
                // $stm = $queryBuilder->execute();
                // $data = $stm->fetchAll();  
                // print_r($data);     
                
        $command=new TaskCommand();
        $application->add($command);
        $application->setDefaultCommand($command->getName());

        $application->run();