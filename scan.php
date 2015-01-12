<?php

//Initiate the file array
$fileArray = array();

$viruses = file('Virusdb.txt');

foreach (new RecursiveIteratorIterator (new RecursiveDirectoryIterator ('.')) as $x)
{
    // Add each line that is not "." or ".." to the file array
    if (strcmp($x->getFilename(), ".") !== 0 and strcmp($x->getFilename(), "..") !== 0) {

        array_push($fileArray, $x->getPathname());
    }

}

// TESTING - array outputs
echo "<pre>";
// TESTING - array outputs
//print_r($viruses);
// TESTING - array outputs
echo "</pre>";

// Look through all of the files in the file array for the virus keyword(s)
foreach ($fileArray as $files){

    // Exclude the Virusdb.txt from the scan results
    if (strcmp($files, "." . DIRECTORY_SEPARATOR . "Virusdb.txt") !== 0 and strcmp($files, "." . DIRECTORY_SEPARATOR . "virusdb.txt") !== 0)
    {
        $file = file_get_contents($files);
        foreach ($viruses as $virus)
        {
            if(strpos($file, $virus))
            {
                echo $files . "<br />";
            }
        }
    }
}

// Get the number of fileas that will be scanned
$numberFiles = count($fileArray);

echo $numberFiles . " Files Scanned";


?>