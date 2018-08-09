<?php
    //phpinfo();
use UserClasses\BusinessLayer\License;
use UserClasses\BusinessObjects\SystemLicenseBO;
use UserClasses\BusinessLayer\Email;

require __DIR__.'/vendor/autoload.php';

$lic=new License();
$arr_addr=array();
$arr_addr["AddressType"]=1;
$arr_addr["AddressLine1"]="193 Fenniscowles Rd";
$arr_addr["Surburb"]="Buccleuch";
$arr_addr["City"]="Johannesburg";
$arr_addr["Country"]="South Africa";
$arr_addr["PostalCode"]="2066";
$arr_add=array();
$arr_add["companyName"]="Logiman";
$arr_add["postalAddressArray"]=$arr_addr;
$arr_add["licenseLimit"]=100;
$data=new SystemLicenseBO();

//$arr=$data->getArray();
//$lic->addLicense($data);
$babes=$lic->listLicenseData($data);
$id=$babes[0]["LicenseID"];
$arr_add["licenseID"]=$id;
$data->set($arr_add);
$arr=$data->getArray();
$lic->updateLicense($data);
$sender=new Email();
$arr["to"]="tshomie2020@yahoo.com";
$arr["subject"]="Fuck you!!!";
$arr["body"]="The BodyXXX is so sexy";
$sender->sendEmail($arr);

