<?php

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$version_release = '0.1.0';
$version_api = $version_release;
$state = 'alpha';
$notes = 'First PEAR Release
Fixed a notice about unset row names';
$summary = 'An HTML_QuickForm meta-element which holds any other element in a grid';
$description = 'An HTML_QuickForm meta-element which holds multiple HTML_QuickForm elements in an HTML_Table. The elements in the table should behave exactly like normal elements in a form, such as freezing and getting defaults and submitted values correctly.';
$packagefile = './package.xml';
$options = array(
    'filelistgenerator' => 'cvs',
    'changelogoldtonew' => false,
    'simpleoutput'      => true,
    'baseinstalldir'    => '/',
    'packagedirectory'  => './',
    'packagefile'       => $packagefile,
    'clearcontents'     => false,
    'ignore'            => array('package*.php', 'package*.xml'),
    'dir_roles'         => array(
         'docs'      => 'doc',
         'examples' => 'doc',
         'tests'    => 'test',
    ),
);

$package = &PEAR_PackageFileManager2::importOptions($packagefile, $options);
$package->setPackageType('php');
$package->clearDeps();
$package->setPhpDep('4.3.0');
$package->setPearInstallerDep('1.4.3');
$package->addPackageDepWithChannel('required', 'HTML_QuickForm', 'pear.php.net', '3.2.5');
$package->addPackageDepWithChannel('required', 'HTML_Table', 'pear.php.net', '1.7.5');
$package->addRelease();
$package->generateContents();
$package->setReleaseVersion($version_release);
$package->setAPIVersion($version_api);
$package->setReleaseStability($state);
$package->setAPIStability($state);
$package->setNotes($notes);
$package->setSummary($summary);
$package->setDescription($description);
//$package->addGlobalReplacement('package-info', '@package_version@', 'version');

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $package->writePackageFile();
} else {
    $package->debugPackageFile();
}
?>