<?php

class Base {
    var $symbol = ',';
    var $value = '';
    private $countAnswer = 1;

    /** Задание значения символа разделителя
     * @param $symbol
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    /** Проверяет последний символ строки
     * @param $string
     * @return string
     */
    private function checkLastSymbol($string) {
        $lS = substr($string, strlen($string) - 1, strlen($string));
        if($lS == $this->symbol) {
            $string = substr($string, 0, strlen($string) - 1);
            $string = $this->checkLastSymbol($string);
        }
        return $string;
    }

    /** Проверяет первый символ строки
     * @param $string
     * @return string
     */
    private function checFirstSymbol($string) {
        $fS = substr($string, 0, 1);
        if($fS == $this->symbol) {
            $string = substr($string, 1, strlen($string));
            $string = $this->checFirstSymbol($string);
        }
        return $string;
    }

    /** Проверяет строку на наличие лишних пробелов и символов по краям
     * @param $string
     * @return string
     */
    public function checkString($string) {
        $string = trim($string);
        $string = $this->checFirstSymbol($string);
        $string = $this->checkLastSymbol($string);
        return $string;
    }

    /** Проверяет строку на наличие прогрессии
     * @param $string
     * @return string
     */
    public function checkProgressionInString($string, $console = false) {
        $stringResult = '';
        $this->value = $this->checkString($string);
        $arString = explode($this->symbol, $this->value);
        if(count($arString) > 0 && count($arString) <= 2) {
            if($console) {
                echo "Ошибка! Слишком мало символов! (" . count($arString) . ") ";
                $this->getString();
            } else {
                $stringResult = 'Введите больше чисел';
            }
        }
        elseif(count($arString) > 2) {
            $arProgressive = [
                'a' => [
                    'prev' => 0,
                    'cur' => true
                ],
                'g' => [
                    'prev' => 0,
                    'cur' => true
                ]
            ];
            $prevVal = 0;
            foreach($arString as $i => $val) {
                if($i == 1) {
                    $arProgressive['a']['prev'] = $val - $prevVal;
                    $arProgressive['g']['prev'] = $val / $prevVal;
                } elseif($i > 1) {
                    if(!$arProgressive['a']['cur'] && !$arProgressive['g']['cur'] ) {
                        break;
                    }
                    if($arProgressive['a']['cur'] && $arProgressive['a']['prev'] != $val - $prevVal) {
                        $arProgressive['a']['cur'] = false;
                    }
                    if($arProgressive['g']['cur'] && $arProgressive['g']['prev'] != $val / $prevVal) {
                        $arProgressive['g']['cur'] = false;
                    }
                }
                $prevVal = $val;
            }
            if($arProgressive['a']['cur']) {
                $stringResult = 'Данная прогрессия является арифметической';
            } elseif($arProgressive['g']['cur']) {
                $stringResult = 'Данная прогрессия является геометрической';
            } else {
                if($console) {
                    echo "Это не прогрессия. ";
                    $this->getString();
                } else {
                    $stringResult = "Это не прогрессия";
                }
            }
        }
        if($console) {
            $this->getStringReply($stringResult);
        } else {
            return $stringResult;
        }
    }

    /** Возвращает обработанное введенное значение
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /** Возвращает символ-разделитель
     * @return string
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /** Возвращает символ разделитель
     * @param $error
     * @return string
     */
    public function setSymbolInConsole($error = '') {
        $symbol = '';
        echo $error . "Введите символ-разделитель (\",\" или \";\"): \n";
        while(!$symbol) {
            $symbol = trim(fgetc(STDIN));
        }
        if(strlen($symbol) > 1) {
            $this->setSymbolInConsole("Ошибка! Вы ввели больше чем 1 символ. \n");
        } elseif(stristr($symbol, ',') || stristr($symbol, ';')) {
            $this->setSymbol($symbol);
        } else {
            $this->setSymbolInConsole("Ошибка! Введенный символ не подходит. \n");
        }
    }

    /** Возвращает результат определения прогрессии в строке
     * @return string
     */
    public function getString() {
        $string = '';
        echo "Введите строку с предполагаемой прогрессией (разделяя числа с помощью " . $this->symbol . ") \n";
        while(!$string) {
            $string = trim(fgets(STDIN));
        }
        return $this->checkProgressionInString($string, true) . "\n";
    }

    /** Осуществляет вывод результата в консоль и запрашивает повторный ввод
     * @param string $string
     * @return bool
     */
    private function getStringReply($string = '') {
        $answer = '';
        echo $string . "\n" . "Хотите проверить еще? (y/n): \n";
        while(!$answer) {
            $answer = trim(fgets(STDIN));
        }
        if($answer == 'y') {
            $this->getString();
        } elseif($answer == 'n' || $this->countAnswer == 3) {
            return false;
        } else {
            $this->countAnswer++;
            $this->getStringReply();
        }
    }
}