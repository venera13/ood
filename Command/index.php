<?php
declare(strict_types=1);

include 'Data/Item.php';
include 'Menu/Menu.php';
include 'Editor/Editor.php';
include 'Document/DocumentInterface.php';
include 'Document/Document.php';

use Command\Document\Document;
use Command\Editor\Editor;
use Command\Menu\Menu;

$menu = new Menu();
$document = new Document();
$editor = new Editor($menu, $document);
$editor->start('input.txt');