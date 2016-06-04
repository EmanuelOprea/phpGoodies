<?php

class LibFilesFolders {

    public function __construct()
    {
    }

    function showSize($size_in_bytes = 0, $round = FALSE) {
        $value = 0;  
        if ($size_in_bytes >= 1073741824) {
            $value = round($size_in_bytes/1073741824*10)/10;
            return  ($round) ? round($value) . 'GB' : "{$value} GB";
        } else if ($size_in_bytes >= 1048576) {
            $value = round($size_in_bytes/1048576*10)/10;
            return  ($round) ? round($value) . 'MB' : "{$value} MB";
        } else if ($size_in_bytes >= 1024) {
            $value = round($size_in_bytes/1024*10)/10;
            return  ($round) ? round($value) . 'KB' : "{$value} KB";
        } else {
            return "{$size_in_bytes} B";
        }
    }

    function fileSize($path) {
        if(!file_exists($path)) 
            return 0;
        if(is_file($path)) 
            return filesize($path);
        $ret = 0;
        foreach(glob($path."/*") as $fn)
            $ret += $this->fSize($fn);
        return $ret;
    }

    function duplicateFiles($path, $array = FALSE)
    {
        if(!file_exists($path)) 
            return 0;
        if(is_file($path)) 
            return null;
        $ite=new RecursiveDirectoryIterator($path);
        $files = array();
        foreach (new RecursiveIteratorIterator($ite) as $fite) {
            $name = $cur->getFilename();
            if($name != '.' && $name != '..')
            {
                $files[] = $cur->getFilename();
            }
        }

        $duplicates = array_count_values($files);
        $counter = 0;
        foreach($duplicates as $duplicate)
        {
            if($duplicate > 1)
                $counter++;
        }

        if($array == TRUE)
        {
            if($counter > 0)
                return $duplicates;
            else
                return array();
        }
        else
        {
            return $counter;
        }
    }

    function countFiles($path){
        if(!file_exists($path)) 
            return 0;
        if(is_file($path)) 
            return 1;
        $ite=new RecursiveDirectoryIterator($path);
        $files=0;
        foreach (new RecursiveIteratorIterator($ite) as $fite) {
            $files++;
        }
        return $files;
    }


}

?>