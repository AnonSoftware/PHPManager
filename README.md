# PHPManager
Simple php based custom website


Ever used Wordpress but wanted to make your own site with more customisation well PHPManager is the solution.

PHPManager uses a module based system in order to allow for fully customised websites.

Rename Copy.htaccess to .htaccess(Github hid the file on upload)


 **How it works**
 
 PHPManager Modules utalise simple mehanics such as Regex and a Hook based system to call extra functions
 
 The regex system(ModuleVar) uses regex sysntax to search a target page and replace any matches with a return from the designated function
 
Example Module:
```php
<?php

$appName = "TestApp";//Name of the module
$appEnabled = true;//Enable/Disable app from loading and executing

$hooks = [
["activation","test"]// Register Hook for Activation and function Test
];

$vars = [
["/({testVar})/","testVar"]
];


function test(){
  echo "Test Function Loaded";
}

function testVar(){
  return "Test var response";
}

?>
 ```
 
 Example Module Folder Location:
 
 $websiteFolder/modules/(appname)/(<appname>).php
 
 
 *Pages:*
 
 Pages folder: $website/pages/(pagename).php
 
 Website Pages use normal HTML,PHP,CSS,JavaScript syntax to deliver a page to the user however
Modules can add their own syntaxing for you to utalise as listed above
 
 
 
 
 
