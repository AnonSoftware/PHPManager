<?php
class app{
    
    
    function app($urlDat,$preDeterm){
        $this->urlData = $urlDat;
        $this->callParts = $urlDat["call_parts"];
        $this->preDeterm = $preDeterm;
        
        $this->varLoad = [];
        
        $this->modules = [];
        $this->moduleHooks = [];
    }
    
    function register_var($var,$fnc){
        array_push($this->varLoad,[$var,$fnc]);
    }
    
    function process_vars($str){
        foreach($this->varLoad as &$var){
            $v = $var[0];
            $fnc = $var[1];
            while(preg_match($v,$str)){
                preg_match($v,$str,$dat);
                $arg = $dat;
                unset($arg[0]);
                unset($arg[1]);
                $cont = $fnc($arg);
                $str = str_replace($dat[0],$cont,$str);
            }
            
        }
        return $str;
    }
    
    function register_hook($name,$fnc){
        if($this->moduleHooks[$name] != null){
            array_push($this->moduleHooks[$name],$fnc);
        }else{
            $this->moduleHooks[$name] = [];
            array_push($this->moduleHooks[$name],$fnc);
        }
    }
    
    function call_hook($name,$arg){
        if($this->moduleHooks[$name] != null){
            foreach($this->moduleHooks[$name] as &$hk){
                $hk($arg);
            }
        }
    }
    
    function getPage(){
        $pageIndex = 0;
        $pageCache = $this->callParts;
        $page = $pageCache[$pageIndex];
        
        if($page == "" ){
            $page = "Home";
        }
        
        if($this->preDeterm[$page] != "" or $this->preDeterm[$page] != null){
            $page = $this->preDeterm[$page];
        }
        
        
        $file = $this->getFileContent($page);
        if($file != ""){
            
            return $file;
        }else{
            return false;
        }
    }
    
    function startsWith($haystack, $needle)
    {
         $length = strlen($needle);
         return (substr($haystack, 0, $length) === $needle);
    }

    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 || 
        (substr($haystack, -$length) === $needle);
    }
    
    function loadModules(){
        
        /*
        include("modules/testApp/testApp.php");
        echo $appName;
        var_dump($hooks);
        */
        
        $folders = scandir("modules/");
        
        
        foreach($folders as &$folder){
            if($folder != "." and $folder != ".." and !$this->endsWith($folder,".php")){
                
                include("modules/".$folder."/".$folder.".php");
                if($appEnabled == true){
                    array_push($this->modules,[$appName,$hooks,$vars]);
                        
                    foreach($vars as &$var1){
                        $this->register_var($var1[0],$var1[1]);
                    }
                        
                    foreach($hooks as &$hook){
                        $this->register_hook($hook[0],$hook[1]);
                    }
                }
            }
        }
    }
    
    function error($errorCode){
        
    }
    
    function getFileContent($file){
        //$fleCont = file_get_contents("pages/".$file.".php");
        if(file_exists("pages/".$file.".php")){
            $file = $file;
        }else{
            $file = "error";
        }
            ob_start();
            include("pages/".$file.".php");
            $fleCont = ob_get_clean();
            ob_end_flush();
            return $fleCont;
    }
}
?>