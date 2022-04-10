<?php
declare(strict_types=1);

namespace Command\Tests;

include '../Data/Item.php';
include '../Menu/Menu.php';
include '../Editor/Editor.php';
include '../Document/DocumentInterface.php';
include '../Document/Document.php';
include '../History/History.php';
include '../Command/CommandInterface.php';
include '../Command/ChangeStringCommand.php';
include 'MockDocument.php';

use Command\Document\Document;
use Command\Editor\Editor;
use Command\History\History;
use Command\Menu\Menu;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testMenuShowInstructions(): void
    {
        $menu = new Menu();
        $menu->addItem('help', 'Help', function ()
        {
            print_r('help');
        });
        $menu->addItem('exit', 'Exit', function ()
        {
            print_r('exit');
        });
        $menu->showInstructions();

        $this->expectOutputString('help: Help</br>exit: Exit</br>');
    }

    public function testMenuExecuteCommand(): void
    {
        $menu = new Menu();
        $menu->addItem('help', 'Help', function ()
        {
            print_r('help');
        });
        $menu->addItem('exit', 'Exit', function ()
        {
            print_r('exit');
        });
        $menu->run('test_input.txt');

        $this->expectOutputString('help: Help</br>exit: Exit</br>helpexit');
    }

    public function testEditor(): void
    {
        $history = new History();
        $menu = new Menu();
        $document = new Document($history);
        $editor = new Editor($menu, $document);
        $editor->start('test_editor_input.txt');

        $rightString = 'help: Help</br>exit: Exit</br>setTitle: Changes title. Args: < new title ></br>undo: Undo command</br>redo: Redo command</br>list: Show document</br>save: Save as html Args: < filePath ></br>';

        $this->expectOutputString($rightString);
    }

    public function testHistory(): void
    {
        $history = new History();
        $menu = new Menu();
        $document = new MockDocument($history);
        $editor = new Editor($menu, $document);
        $editor->start('test_history_input.txt');

        $rightString = '2';

        $this->assertEquals(file_get_contents('test.html'), $rightString);
    }
}