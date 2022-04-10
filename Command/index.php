<?php
declare(strict_types=1);

include 'Data/Item.php';
include 'Data/Image/ImageInterface.php';
include 'Data/Image/Image.php';
include 'Data/Paragraph/ParagraphInterface.php';
include 'Data/Paragraph/Paragraph.php';
include 'Data/DocumentItem.php';
include 'Menu/Menu.php';
include 'Editor/Editor.php';
include 'Document/DocumentInterface.php';
include 'Document/Document.php';
include 'History/History.php';
include 'Command/CommandInterface.php';
include 'Command/ChangeStringCommand.php';
include 'Command/InsertItemCommand.php';
include 'DocumentExporter/DocumentExporterInterface.php';
include 'DocumentExporter/DocumentHtmlExporter.php';
include 'Exceptions/InvalidPositionException.php';
include 'Exceptions/InvalidCommandException.php';

use Command\Document\Document;
use Command\Editor\Editor;
use Command\Exceptions\InvalidCommandException;
use Command\History\History;
use Command\Menu\Menu;

$menu = new Menu();
$history = new History();
$document = new Document($history);
$editor = new Editor($menu, $document);
$editor->start('input.txt');