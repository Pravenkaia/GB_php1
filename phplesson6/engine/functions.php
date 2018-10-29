<?
//функции операций
function sum($a,$b) {
            return $a + $b;
        }
        
        function dif($a,$b) {
            return $a - $b;
        }
        
        function mult($a,$b) {
            return $a* $b;
        }
        
        function div($a,$b) {
            if ($b != 0) return $a/$b;
            else return 'ERR:/0!';
        }
         
        function mathOperation($arg1, $arg2, $operation) {
            
            if ($operation != '+' && $operation != '-' && $operation != '*' && $operation != '/')
                return false;
            
            if (is_numeric($arg2) != 1 || is_numeric($arg1) != 1) {
                return false;
            }
            
            switch($operation) {
                case '+':
                    $c = sum($arg1,$arg2);
                    break;
                case '-':
                    $c = dif($arg1,$arg2);
                    break;
                case '*':
                    $c = mult($arg1,$arg2);
                    break;
                case '/':
                    $c = div($arg1,$arg2);
                    break;
                default:
                    $c = 'ERR';
            }
            return $c;
        }
?>