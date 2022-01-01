<?php
	session_start();
	ini_set('max_execution_time', 60);
	date_default_timezone_set('Asia/Dhaka');
	
	spl_autoload_register(function($className){
        $possiblePaths = array();
        $path = strtolower($className) . ".php";
        $patLegal = $className . ".php";
		
        $possiblePaths[] = 'helpers/'.$path;
        $possiblePaths[] = 'helpers/'.$patLegal;
		
		$possiblePaths[] = 'lib/'.$path;
        $possiblePaths[] = 'lib/'.$patLegal;
		
        $possiblePaths[] = 'app/Controller/'.$path;
        $possiblePaths[] = 'app/Controller/'.$patLegal;
		
        $possiblePaths[] = 'app/Model/'.$path;
        $possiblePaths[] = 'app/Model/'.$patLegal;
		
		$possiblePaths[] = 'app/Router/'.$path;
        $possiblePaths[] = 'app/Router/'.$patLegal;
        
        $possiblePaths[] = 'Classes/'.$path;
        $possiblePaths[] = 'Classes/'.$patLegal;
        
        foreach($possiblePaths as $path){
            $path = __DIR__ . '/'.$path;;
            if (file_exists($path)) {
                require_once $path;
                break;
			}
		}
	});
	
	//require_once 'functions/sanitize.php';
	//require_once 'functions/includeWithVariables.php';
	
	
	
		
	
?>