<?php
declare(strict_types=1);

include 'Editor/Data/Item.php';
include 'Editor/Data/Image/ImageInterface.php';
include 'Editor/Data/Image/Image.php';
include 'Editor/Data/Paragraph/ParagraphInterface.php';
include 'Editor/Data/Paragraph/Paragraph.php';
include 'Editor/Data/DocumentItem.php';
include 'Menu/Menu.php';
include 'Editor/Editor.php';
include 'Editor/Document/DocumentInterface.php';
include 'Editor/Document/Document.php';
include 'CommandHistory/History/History.php';
include 'CommandHistory/CommandInterface.php';
include 'Editor/Command/ChangeStringCommand.php';
include 'Editor/Command/InsertItemCommand.php';
include 'Editor/Command/ReplaceTextCommand.php';
include 'Editor/Command/ResizeImageCommand.php';
include 'Editor/Command/DeleteItemCommand.php';
include 'Editor/Utils/DocumentItemsToHTMLConverter.php';
include 'Editor/Utils/FileUtils.php';
include 'Exceptions/InvalidPositionException.php';
include 'Exceptions/InvalidCommandException.php';
include 'Exceptions/CopyFileException.php';

use Command\Editor\Editor;
use Command\History\History;
use Command\Menu\Menu;

$menu = new Menu();
$history = new History();
$editor = new Editor($menu, $history);
$editor->start();