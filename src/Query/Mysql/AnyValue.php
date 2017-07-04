<?php

namespace DPS\DoctrineExtensions\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * The anyvalue function is only available in MySQL 5.7+ for beeing SQL99 compatible.
 * It's not supported in MariaDb 10.2, and have to be dropped in this db engine.
 */
class AnyValue extends FunctionNode {

    /**
     * Is it MariaDb? or MySQL?
     * MariaDb doesnt have ANY_VALUE function and need to be dropped.
     * 
     * @var boolean
     */
    private $isMariaDb = false;
    
    public $stringPrimary;

    public function __construct($name) {
        $this->isMariaDb = preg_match('~MariaDB~i', shell_exec('mysql -V')) ? true : false;
        parent::__construct($name);
    }

    
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        $result = $sqlWalker->walkStringPrimary($this->stringPrimary);
        return $this->isMariaDb ? $result : 'ANY_VALUE(' . $result . ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->stringPrimary = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}
