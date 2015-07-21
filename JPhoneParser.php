<?php

class NumberFormat {

    public $sign = "";
    public $zipcode;
    public $areacode = "";
    public $number = "";

    public function toString() {
        return $this->sign . $this->zipcode . $this->areacode . $this->number;
    }

    public function toFormatString() {
        return $this->sign . $this->zipcode . "-" . $this->areacode . "-" . $this->number;
    }

}

abstract class StateType {

    const SIGN = 0;
    const ZIPCODE = 1;
    const AREACODE = 2;
    const NUMBER = 3;
    const FINISH = 4;
    const ERROR = 5;

}

class Token {

    private $__id;
    private $__data;

    public function __construct($id, $data) {
        $this->__data = $data;
        $this->__id = $id;
    }

    //token  class
    public function getID() {
        return $this->__id;
    }

    public function getValue() {
        return $this->__data;
    }

    function setValue($char) {
        $this->__data = $char;
    }

    function setID($id) {
        $this->__id = $id;
    }

    const WHITE_SPACE = 1;
    const NUMBER = 2;
    const SLASH = 3;
    const PLUS = 4;
    const ZIPCODE = 5;
    const NATIONAL_ACCESS_NUMBER = 6;
    const AREA_CODE_NUMBER = 7;
    const INVALID = -1;

}

//The scanner 

class JScanner {

    private $__text = null;
    public $__line = 1;
    public $__column = 1;
    private $__pos = 0;
    private $__size = 0;
    public $status = StateType::SIGN;
    private $__stop = false;
    private static $__signstate = false;

    function __construct($string) {
        $this->__text = trim($string);
        $this->__size = strlen($this->__text);
        $this->__skipWhiteSpace();
    }

    function hasNextToken() {
        $okay = true;
        if ($this->__isEOF()) {
            $okay = false;
        }
        return $okay;
    }

    public function reset() {
        $this->__pos = 0;
        JScanner::$__signstate = false;
        $this->status = StateType::SIGN;
    }

    function parserNext() {
        $token = new Token(Token::INVALID, "");
        if (!$this->__isEOF() && !$this->__stop) {

            $char = $this->__text[$this->__pos];

            if (!ctype_digit($char)) {
                JScanner::$__signstate = true;
                $token = $this->__parserNotNumber($char);
            } else {

                //check if the number is a zeros
                if (($char == '0' || $char == 0 ) && (JScanner::$__signstate == false)) {
                    JScanner::$__signstate = true;
                    $look_ahead = $this->peek(1, ' ');
                    if ($look_ahead == '0' || $look_ahead == 0) {
                        $zip = "00";
                        $token->setValue($zip);
                        $token->setID(Token::PLUS);
                        $this->advance();
                    } else {
                        $token = $this->__parserNumber($char);
                    }
                } else {
                    $token = $this->__parserNumber($char);
                }
            }
        }
        return $token;
    }

    private function __parserNumber($char) {
        $token = new Token(Token::NUMBER, $char);
        return $token;
    }

    private function __parserNotNumber($char) {
        $token = new Token(Token::INVALID, $char);

        switch ($char) {
            case '-': {
                    $this->advance();  //skip the slash
                    if (!$this->__isEOF()) {
                        $token = $this->parserNext();
                    }
                    break;
                }
            case '+': {

                    $token->setID(Token::PLUS);
                    break;
                }
            default: {
                    $this->__stop = true;
                    break;
                }
        }
        return $token;
    }

//end method

    private function __skipWhiteSpace() {
        while ($this->__isWhiteSpace($this->__text[$this->__pos])) {
            $this->advance();
        }
    }

    private function __isWhiteSpace($char) {
        $okay = false;

        switch ($char) {
            case '\n': {
                    $okay = true;
                    break;
                }
            case '\r': {
                    $okay = true;
                    break;
                }
            case '\t': {
                    $okay = true;
                    break;
                }
            default: {
                    $okay = false;
                    break;
                }
        }//end switch

        return $okay;
    }

    public function advance() {
        if (!$this->__isEOF()) {
            $this->__countLines();
            $this->__pos++;
        }
    }

    public function peek($step = 1) {
        $index = intval($this->__pos) + intval($step);

        if ($index >= $this->__size) {
            $index = $this->__size - 1;
        }
        return $this->__text[$index];
    }

    private function __isEOF() {
        if ($this->__pos >= $this->__size) {
            return true;
        }
        return false;
    }

    private function __countLines() {
        if ($this->__text[$this->__pos] == '\n') {
            $this->__line++;
            $this->__column = 0;
        } else {
            $this->__column++;
        }
    }

}

class Edge {

    private $__weight;
    private $__endPoint;

    function __construct($endPoint, $weight) {
        $this->__endPoint = $endPoint;
        $this->__weight = $weight;
    }

}

class Node {

    private $edges = null;

    const TERMINAL = 0;
    const NON_TERMINAL = 1;

    public $type;
    public $tokenType;

    function __construct() {
        $this->edges = new ArrayIterator();
    }

    public function addEdgeTo(Node $node, $weight = "\0") {
        $edge = new Edge($node, $weight);
        $this->edges->append($edge);
    }

    function clear() {
        unset($this->edges);
        $this->edges = new ArrayIterator();
    }

}

class JPhoneParser {

    private $__scanner;
    private $__root;
    private $__noZipCode;
    private $__number = null;
    private $scanner = null;
    private static $TYPE = JPhoneParser::INTERNATION;
    public static $NATIONAL_NUMBER = true;
    public static $NUMBER_COUNT = 0;

    const FINISH = 2;
    //parsing number type
    const INTERNATION = 4;
    const LOCAL = 5;
    const NATIONAL = 6;

    public $errorStatus = false;
    public $__error = "";

    public function __construct(JScanner $scanner, $zipcodeno) {

        $this->__scanner = $scanner;
        $this->__noZipCode = intval($zipcodeno);
        $this->__number = new NumberFormat();
        $this->__root = new Node();
        $this->__root->type = Node::NON_TERMINAL;
    }

    public function parse() {

        if ($this->__scanner->hasNextToken()) {
            $token = $this->__scanner->parserNext();
            switch ($token->getID()) {
                case Token::PLUS: {
                        JPhoneParser::$TYPE = JPhoneParser::INTERNATION;
                        $intNo = new Node();
                        $intNo->type = Node::NON_TERMINAL;
                        $this->__root->addEdgeTo($intNo, "");
                        $this->__parserInterNo($intNo);
                        break;
                    }
                default: {
                        JPhoneParser::$TYPE = JPhoneParser::NATIONAL;
                        $this->__parserNationalNo();
                        break;
                    }
            }
        }
        $number = intval(JPhoneParser::$NUMBER_COUNT);

        if ($number >= 7 && $number <= 8 && !$this->__scanner->hasNextToken()) {
            $this->errorStatus = false;
        } else {
            $this->errorStatus = true;
        }


        return $this->__root;
    }

    private function __parserInterNo(Node $p) {

        if ($this->__scanner->hasNextToken()) {
            $token = $this->__scanner->parserNext();

            if ($token->getID() == Token::PLUS) {
                $plus = new Node();
                $plus->type = Node::TERMINAL;
                $plus->tokenType = $token->getID();
                //add it to the node tree
                $p->addEdgeTo($plus, $token->getValue());
                $this->__scanner->advance();
                $this->__parserZipCode($p);

                $this->__parserCallNumber($p);
            }
        } else {
            //error found 
            $this->__error = "Cannot parser number at column " + $this->__scanner->__column;
            $this->errorStatus = true;
        }
    }

    private function __parserZipCode(Node $node) {
        $this->__scanner->status = StateType::ZIPCODE;
        $token = $this->__scanner->parserNext();

        if ($token->getID() == Token::NUMBER) {


            $zip = $this->__zipcode($this->__noZipCode);
            $token = $this->__scanner->parserNext();
            $zipcode = new Node();
            $zipcode->type = Node::TERMINAL;
            $zipcode->tokenType = Token::ZIPCODE;
            $node->addEdgeTo($zipcode, $zip);
        } else {
            //errror found 
            $this->__error = "Cannot parser number at column " + $this->__scanner->__column;
            $this->errorStatus = true;
        }
    }

    private function __parserCallNumber(Node $p) {
        $token = $this->__scanner->parserNext();


        if ($token->getID() == Token::NUMBER && $this->__scanner->hasNextToken()) {
            $CallNumber = new Node();
            $CallNumber->type = Node::NON_TERMINAL;
            $p->addEdgeTo($CallNumber);

            //Now parser the rest
            $this->__parserNationalAccessNode($CallNumber);
            $this->__parserAreaCode($CallNumber);
            $this->__parserNumber($CallNumber);
        } else {
            //error found
            $this->__error = "Cannot parser number at column " + $this->__scanner->__column;
            $this->errorStatus = true;
        }
    }

    function __parserNationalAccessNode(Node $p) {
        if (JPhoneParser::$NATIONAL_NUMBER == true) {
            $token = $this->__scanner->parserNext();

            if ($token->getID() == Token::NUMBER && $this->__scanner->hasNextToken()) {
                $weight = $token->getValue();
                $nationalAccessNo = new Node();
                $nationalAccessNo->type = Node::TERMINAL;
                $nationalAccessNo->tokenType = Token::NATIONAL_ACCESS_NUMBER;
                $p->addEdgeTo($nationalAccessNo, $weight);
                $this->__scanner->advance();
            }
        }
    }

    function __parserAreaCode(Node $p) {
        $this->__scanner->status = StateType::AREACODE;
        $token = $this->__scanner->parserNext();


        if ($token->getID() == Token::NUMBER && $this->__scanner->hasNextToken()) {
            $weight = $this->__areaCode(2);
            $area = new Node();
            $area->type = Node::TERMINAL;
            $area->tokenType = Token::AREA_CODE_NUMBER;
            $p->addEdgeTo($area, $weight);
        } else {
            //error
            $this->__error = "Cannot parser number at column " + $this->__scanner->__column;
            $this->errorStatus = true;
        }
    }

    function __parserNumber($p) {
        $this->__scanner->status = StateType::NUMBER;
        $token = $this->__scanner->parserNext();

        if ($token->getID() == Token::NUMBER && $this->__scanner->hasNextToken()) {

            $weight = $this->__callNumber(8);

            $n = new Node();
            $n->type = Node::TERMINAL;
            $n->tokenType = Token::AREA_CODE_NUMBER;
            $p->addEdgeTo($n, $weight);
            $token = $this->__scanner->parserNext();
        } else {
            $this->__error = "Cannot parser number number at column " + $this->__scanner->__column;
            $this->errorStatus = true;
        }
    }

    private function __parserNationalNo() {
        
    }

    private function __zipcode($start) {
        $token = $this->__scanner->parserNext();
        if ($this->__scanner->status == StateType::ZIPCODE && $start != 0) {
            $char = $token->getValue();
            $this->__number->zipcode = $this->__number->zipcode . $char;
            $this->__scanner->advance();
            $start--;
            //if there is more input then take it
            if ($this->__scanner->hasNextToken()) {
                $this->__number->zipcode = $this->__zipcode($start);
            }
        }
        return $this->__number->zipcode;
    }

    private function __areaCode($size) {
        $token = $this->__scanner->parserNext();
        $char = $token->getValue();
        if ($this->__scanner->status == StateType::AREACODE && ($size != 0)) {
            $this->__number->areacode = $this->__number->areacode . $char;
            $this->__scanner->advance();
            $size--;
            $this->__number->areacode = $this->__areaCode($size);
        }
        return $this->__number->areacode;
    }

    private function __callNumber($numtimes) {
        $token = $this->__scanner->parserNext();
        $char = $token->getValue();
        if ($this->__scanner->hasNextToken() && $this->__scanner->status == StateType::NUMBER && ($numtimes > 0)) {
            JPhoneParser::$NUMBER_COUNT++;
            $this->__number->number = $this->__number->number . $char;
            $this->__scanner->advance();
            $numtimes--;
            $this->__number->number = $this->__callNumber($numtimes);
        }
        return $this->__number->number;
    }

    private function __reset() {
        JPhoneParser::$NUMBER_COUNT = 0;
        $this->__root->clear();
        $this->__scanner->reset();
    }

}

class JPParser {

    private $__scanner;
    private $__parser;
    private $__stringv;
    private $__times;
    private $node;

    function __construct($txtphone, $times) {
        $this->__stringv = $txtphone;
        $this->__times = $times;
        $this->__scanner = new JScanner($txtphone);
        $this->__parser = new JPhoneParser($this->__scanner, $times);
    }

    private function parse() {
        $this->node = $this->__parser->parse();
    }

    public function isValid() {
        $this->parse();
        if (!$this->__parser->errorStatus) {
            return true;
        }
        return false;
    }

}
