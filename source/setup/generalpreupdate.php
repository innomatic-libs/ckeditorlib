<?php

require_once('innomatic/io/filesystem/DirectoryUtils.php');
DirectoryUtils::unlinkTree( InnomaticContainer::instance('innomaticcontainer')->getHome().'shared/ckeditor/' );
DirectoryUtils::dircopy( $this->basedir.'/shared/ckeditor/', InnomaticContainer::instance('innomaticcontainer')->getHome().'shared/ckeditor/' );

?>
