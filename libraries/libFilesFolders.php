<?php
/*
    phpGoodies - a collection of PHP libraries written to help developers
    Copyright (C) 2016 to Emanuel Oprea
	GitHub - https://github.com/EmanuelOprea/phpGoodies

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
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