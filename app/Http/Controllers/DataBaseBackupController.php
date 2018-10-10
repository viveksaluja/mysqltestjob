<?php
/*
  Class Name:DataBaseBackupController
  Purpose:This class will be used to manage database backup
*/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataBaseBackupController extends Controller
{      
        /**
        * @var process
        */
        protected $process;
        /**
        * @var directory_name
        */
        protected $directory_name="database_backup";   

        /**
        * Create a new controller instance.
        *
        * @return void
        */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
        * Method Name:index 
        * Purpose:This method will be show backup page.
        */
        public function index()
        {     
              return view($this->directory_name.'/index');
        }

        /**
        * Method Name:postCreateBackup 
        * Purpose:This method will be used to create database backup.
        */
        public function postCreateBackup(Request $request)
        {
            try
            {
                      /* SHOW DATABASES will be fetch all database */
                       $data_bases = \DB::select('SHOW DATABASES'); 
                        foreach ($data_bases as $key => $value) {
                         /* Process class it will be run script as a shell script*/  
                         $this->process = new Process(sprintf(
                                'mysqldump -u%s -p%s %s > %s',
                                env('DB_USERNAME'),
                                env('DB_PASSWORD'),
                                'coppola',
                                storage_path('backups/'.$value->Database.'.sql')
                           ));
                           $this->process->mustRun();
                       } 
                       try {
                            return redirect('/')->with('status', 'Databases backup have been done and database file location is:storage/backups');
                        }catch (ProcessFailedException $exception) {
                            return redirect('/')->with('warning', "Sorry database backup failed.");
                            
                        }
            }
            catch (\Exception $e) 
            {
              return response()->json(['errors'=>['message'=>$e->getMessage()]],400);
                  
            } 
        }
 
}
