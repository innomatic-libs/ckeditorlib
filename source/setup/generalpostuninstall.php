<?php

require_once('innomatic/io/filesystem/DirectoryUtils.php');
DirectoryUtils::unlinkTree( InnomaticContainer::instance('innomaticcontainer')->getHome().'shared/ckeditor/' );

?>
