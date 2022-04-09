<?php
declare(strict_types=1);

namespace Command\Tests;

include '../Data/Item.php';
include '../Menu/Menu.php';
include '../Editor/Editor.php';
include '../Document/DocumentInterface.php';
include '../Document/Document.php';

use Command\Document\Document;
use Command\Editor\Editor;
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
        $menu = new Menu();
        $document = new Document();
        $editor = new Editor($menu, $document);
        $editor->start('test_editor_input.txt');

        $rightString = 'help: Help</br>exit: Exit</br>setTitle: Set title</br>';

        $this->expectOutputString($rightString);
    }
}