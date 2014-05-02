<?php
namespace Icecave\Dialekt\Expression;

use Phake;
use PHPUnit_Framework_TestCase;

/**
 * @covers Icecave\Dialekt\Expression\LogicalAnd
 * @covers Icecave\Dialekt\Expression\AbstractCompoundExpression
 */
class LogicalAndTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->child1 = new Tag('a');
        $this->child2 = new Tag('b');
        $this->child3 = new Tag('c');
        $this->expression = new LogicalAnd($this->child1, $this->child2);
    }

    public function testAdd()
    {
        $this->expression->add($this->child3);

        $this->assertSame(
            array($this->child1, $this->child2, $this->child3),
            $this->expression->children()
        );
    }

    public function testChildren()
    {
        $this->assertSame(
            array($this->child1, $this->child2),
            $this->expression->children()
        );
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Dialekt\Expression\VisitorInterface');

        Phake::when($visitor)
            ->visitLogicalAnd(Phake::anyParameters())
            ->thenReturn('<visitor result>');

        $this->assertSame('<visitor result>', $this->expression->accept($visitor));
    }
}
