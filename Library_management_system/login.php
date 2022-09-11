<?php
include("imap.php");

// test for init()
$imap_driver = new imap_driver();
if ($imap_driver->init('ssl://imap.gmail.com', 993) === false) {
    echo "init() failed: " . $imap_driver->error . "\n";
    exit;
}

if ($imap_driver->login('newtestingAccn@gmail.com', "newtestAccn") === false) {
    echo "login() failed: " . $imap_driver->error . "\n";
    exit;
}

if ($imap_driver->select_folder('INBOX') === false) {
    echo "select_folder() failed: " . $imap_driver->error . "\n";
    exit;
}

$ids = $imap_driver->get_uids_by_search('SINCE "02-Nov-2020"');

$num = count($ids);
echo "UIDS: ";
for($x=0; $x<=$num-1; $x++){
	echo "$ids[$x], \n";
}

if ($ids === false)
{
    echo "get_uids_failed: " . $imap_driver->error . "\n";
    exit;
}


if (($headers = $imap_driver->get_headers_from_uid(5)) === false) {
    echo "get_headers_by_uid() failed: " . $imap_driver->error . "\n";
    return false;
}
echo implode("",$headers); 
