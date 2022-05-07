<?php
declare(strict_types=1);

namespace Command\Tests;

include '../Editor/Data/Item.php';
include '../Editor/Data/Image/ImageInterface.php';
include '../Editor/Data/Image/Image.php';
include '../Editor/Data/Paragraph/ParagraphInterface.php';
include '../Editor/Data/Paragraph/Paragraph.php';
include '../Editor/Data/DocumentItem.php';
include '../Menu/Menu.php';
include '../Editor/Editor.php';
include '../Editor/Document/DocumentInterface.php';
include '../Editor/Document/Document.php';
include '../CommandHistory/History/History.php';
include '../CommandHistory/CommandInterface.php';
include '../Editor/Command/ChangeStringCommand.php';
include '../Editor/Command/InsertItemCommand.php';
include '../Editor/Command/ReplaceTextCommand.php';
include '../Editor/Command/DeleteItemCommand.php';
include '../Editor/Command/ResizeImageCommand.php';
include '../Editor/Utils/DocumentItemsToHTMLConverter.php';
include '../Editor/Utils/FileUtils.php';
include '../Exceptions/InvalidPositionException.php';
include '../Exceptions/InvalidCommandException.php';
include 'Editors/MockEditor.php';
include 'Documents/MockDocument.php';
include 'Documents/MockFileContentDocument.php';
include 'Documents/MockImageParamsDocument.php';

use Command\Document\Document;
use Command\History\History;
use Command\Menu\Menu;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

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

        $this->expectOutputString('help: Help' . PHP_EOL . 'exit: Exit' . PHP_EOL);
    }

    public function testMenuExecuteCommand(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $menu = new Menu();
        $menu->addItem('help', 'Help', function ()
        {
            print_r('help');
        });
        $menu->addItem('exit', 'Exit', function ()
        {
            print_r('exit');
        });

        $lines = file('inputs/test_input.txt');

        foreach ($lines as $line)
        {
            $method->invoke($menu, $line);
        }

        $this->expectOutputString('helpexit');
    }

    public function testHistory(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new MockDocument($history);
        $editor = new MockEditor($menu, $document);
        $editor->start($menu, $method,'inputs/test_history_input.txt');

        $rightString = '2';

        $this->assertEquals(file_get_contents('output/test_history.html'), $rightString);
    }

    public function testTextEditor(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new Document($history);
        $editor = new MockEditor($menu, $document);
        $editor->start($menu, $method, 'inputs/test_text_input.txt');

        $rightString = '<!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><p>1</p></body></html>';

        $this->assertEquals(file_get_contents('output/test_input.html'), $rightString);
    }

    public function testReplaceText(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new MockFileContentDocument($history);
        $editor = new MockEditor($menu, $document);
        $editor->start($menu, $method, 'inputs/test_replace_text_input.txt');

        $rightString = '153';

        $this->assertEquals(file_get_contents('output/test_replace_text.html'), $rightString);
    }

    public function testEncodeText(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new Document($history);
        $editor = new MockEditor($menu, $document);

        $editor->start($menu, $method, 'inputs/test_encode_text_input.txt');

        $rightString = file_get_contents('right_outputs/encode_text.html');

        $this->assertEquals(file_get_contents('output/test_encode_text.html'), $rightString);
    }

    public function testDeleteItem(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new MockFileContentDocument($history);
        $editor = new MockEditor($menu, $document);

        $editor->start($menu, $method, 'inputs/test_delete_item_input.txt');

        $rightString = "";

        $this->assertEquals(file_get_contents('output/test_delete_item.html'), $rightString);
    }

    public function testImage(): void
    {
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $this->clear();
        $history = new History();
        $menu = new Menu();
        $document = new Document($history);
        $editor = new MockEditor($menu, $document);

        $editor->start($menu, $method, 'inputs/test_image_input.txt');

        $rightCount = 1;

        $this->assertEquals(count(array_diff(scandir('images'), ['.', '..'])), $rightCount);
    }

    public function testResizeImage(): void
    {
        $this->clear();
        $class = new ReflectionClass('Command\Menu\Menu');
        $method = $class->getMethod('runCommand');
        $method->setAccessible(true);

        $history = new History();
        $menu = new Menu();
        $document = new MockImageParamsDocument($history);
        $editor = new MockEditor($menu, $document);

        $editor->start($menu, $method, 'inputs/test_resize_image_input.txt');

        $rightCount = '1000 400';

        $this->assertEquals(file_get_contents('output/test_resize_image.html'), $rightCount);
    }

    private function clear()
    {
        if (file_exists('images/'))
        {
            foreach (glob('images/*') as $file)
            {
                unlink($file);
            }
        }
    }
}