<?php 

namespace App\Tnq\Todo\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Doctrine\DBAL\DriverManager;

// use \vendor\connection;

//require_once __DIR__.'/../../../../vendor/connection.php';
require_once __DIR__.'/../../../../vendor/connection.php';


 class TaskCommand extends Command
{
    
    protected static $defaultName = 'todo';

    protected function configure()
    {
        $this->setDescription('Status: started ');
        //$this->addArgument('list', InputArgument::OPTIONAL);
        $this->addOption('list',null, InputOption::VALUE_NONE,1);
        $this->addOption('create',null, InputOption::VALUE_NONE,1);
        $this->addOption('task',null, InputOption::VALUE_REQUIRED,1);
        $this->addOption('update',null, InputOption::VALUE_NONE,1);
        $this->addOption('id',null, InputOption::VALUE_REQUIRED,1);
        $this->addOption('delete',null, InputOption::VALUE_NONE,1);
        $this->addOption('status',null, InputOption::VALUE_REQUIRED,1);
       // $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
     $output->writeln('Welcome to UserCommands');  
   // $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');

    $list = $input->getOption('list');
    $inputcreate = $input->getOption('create');
    $task = $input->getOption('task');
    $inputupdate = $input->getOption('update');
    $inputid= $input->getOption('id');
    $inputdelete = $input->getOption('delete');
    $inputstatus=$input->getOption('status');

    // $list=$input->getArgument('list');
    
     if($inputcreate && $task)
     {
            $result=$this->createArgument($task);
            if($result==true) {
                $output->writeln('Inserted successfully:');  
            } else {
                $output->writeln('Something wrong');  
            }
    

     } else  if($inputupdate && $inputstatus && $inputid)
    {
            $result=$this->updateArgument($inputstatus,$inputid);
            if($result==true) {
                $output->writeln('Updated successfully:');  
            } else {
                $output->writeln('Something wrong');  
            }

     }
     else if($inputdelete && $inputid)
     {
            $result=$this->deleteArgument($inputid);
            if($result==true) {
                $output->writeln('Deleted successfully:');  
            } else {
                $output->writeln('Something wrong');  
            }
     } 

     else if($list)
     {
        $this->taskList($list);
     }
          return Command::SUCCESS;
    }
    public function createArgument($inputcreate)
    {
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'jitha',
            'dbname'   => 'task',
            ); 
         
        $conn= DriverManager::getConnection($dbParams);         
        $queryBuilder = $conn->createQueryBuilder();
        
           $sucess= $conn->insert('test', array(
                "task"  => $inputcreate,               
            )); 
            if($sucess)
            {
                return true;
            } else {
                return false;
            }
         
     
    }
    public function taskList($list)
    {
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'jitha',
            'dbname'   => 'task',
            ); 
         
        $conn= DriverManager::getConnection($dbParams);         
        $queryBuilder = $conn->createQueryBuilder();      
        $queryBuilder->select('*')->from('test');                
        $stm = $queryBuilder->execute();
        $data = $stm->fetchAll();  
        foreach($data as $value)
        {
            echo "Id:".$value['Id']."\n"."Task:".$value['Task']."\n"."Status:".$value['Status']."\n";
        }
    }
    public function updateArgument($inputstatus,$id)
    {
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'jitha',
            'dbname'   => 'task',
            ); 
         
        $conn= DriverManager::getConnection($dbParams);         
        $queryBuilder = $conn->createQueryBuilder(); 
        $queryBuilder->update('test') ->set('Status',"'$inputstatus'")->where("test.Id=$id");
        $result = $queryBuilder->execute();
        return $result;
    }
    public function deleteArgument($id)
    {
        $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'jitha',
            'dbname'   => 'task',
            ); 
         
        $conn= DriverManager::getConnection($dbParams);    
        // $conn->delete('test', array('Id' => $id));     
        $queryBuilder = $conn->createQueryBuilder(); 
        $queryBuilder->delete('test')->where("test.Id=$id");
        // $queryBuilder->delete('test', array('Id' => $id));   
        $result = $queryBuilder->execute();
        return $result;
    }
   
}
      
   

