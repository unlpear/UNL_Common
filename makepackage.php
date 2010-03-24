<?php
ini_set('display_errors',true);
require_once 'PEAR/PackageFileManager2.php';
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/Config.php';
require_once 'PEAR/Frontend.php';

unlink('data/unl_common.sqlite');

require_once 'Common/Building/City.php';
require_once 'Common/Building/East.php';
$c = new UNL_Common_Building_City();
$e = new UNL_Common_Building_East();


/**
 * @var PEAR_PackageFileManager
 */
PEAR::setErrorHandling(PEAR_ERROR_DIE);
chdir(dirname(__FILE__));
$pfm = PEAR_PackageFileManager2::importOptions('package.xml', array(
//$pfm = new PEAR_PackageFileManager2();
//$pfm->setOptions(array(
	'packagedirectory' => dirname(__FILE__),
	'baseinstalldir' => 'UNL',
	'filelistgenerator' => 'file',
	'ignore' => array(	'package.xml',
						'.project',
						'*.tgz',
						'makepackage.php',
						'*CVS/*',
						'.cache',
						'tests',
						'tests/*'),
	'simpleoutput' => true,
	'roles'=>array('php'=>'php'),
	'exceptions'=>array()
));
$pfm->setPackage('UNL_Common');
$pfm->setPackageType('php'); // this is a PEAR-style php script package
$pfm->setSummary('Common elements for the University of Nebraska-Lincoln');
$pfm->setDescription('This package contains commonly used elements for the University of Nebraska-Lincoln: Buildings');
$pfm->setChannel('pear.unl.edu');
$pfm->setAPIStability('beta');
$pfm->setReleaseStability('beta');
$pfm->setAPIVersion('0.4.0');
$pfm->setReleaseVersion('0.4.2');
$pfm->setNotes('
Add MOLR.
');

//$pfm->addMaintainer('lead','saltybeagle','Brett Bieber','brett.bieber@gmail.com');
$pfm->setLicense('BSD', 'http://www.opensource.org/licenses/bsd-license.php');
$pfm->clearDeps();
$pfm->setPhpDep('5.0.0');
$pfm->setPearinstallerDep('1.4.3');
foreach (array('Common.php',) as $file) {
    $pfm->addReplacement($file, 'pear-config', '@@DATA_DIR@@', 'data_dir');
}

$pfm->generateContents();

if (isset($_SERVER['argv'], $_SERVER['argv'][1]) && $_SERVER['argv'][1] == 'make') {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
?>