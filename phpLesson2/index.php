<?php 

echo '<p>Задание6. *<br>С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.</p>';

 //функция проверки перед возведением в степень
        function power_all($val,$pow) {
            //$val основание степени
            //$pow степень
            if (!is_int($pow)) return 'степень не целое число';
            if ($pow == 0) return 1;
			if ($pow == 1) return $val;
            if ($pow < 0 ) return power_all(1/$val, -$pow); //смена отрицательного знака на положительный
            return $val * power_all($val,$pow-1);
        }
$c = rand(-5,5);
$d = rand(-4,4);
echo '<br>основание степени: rand(-5,5) = ' . $c; 
echo '<br>Степень: rand(-4,4) = ' . $d;
echo  '<br>Результат = ' . power_all($c,$d);
        
echo '<hr><p>Задание 7<br>Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями</p>';

function dateFormat($d) {
    if (!is_int($d)) {
        $d = time();
    }
    $hours   = date("G",$d); //часы
    $minutes = date ("i",$d); //минуты
    
    $hLast = +substr($hours, strlen($hours) -1);     //последняя цифра в строке часы
    $mLast = +substr($minutes, strlen($minutes) -1); //последняя цифра в строке минуты
    
    //слова для минут 
    if ($mLast == 1) 
        $mLast = ' минута';
    elseif ($mLast > 1 && $mLast < 5)
        $mLast = ' минуты';
    else 
        $mLast = ' минут';
    
    //слова для часов 
    if ($hLast == 1) 
        $hLast = ' час ';
    elseif ($mLast > 1 && $mLast < 5)
        $hLast = ' часа ';
    else 
        $hLast = ' часов ';
  
    return $hours . $hLast . $minutes . $mLast;
}

 echo dateFormat($d = time());


echo '<hr><p>Задание1.
        <br>если $a и $b положительные, вывести их разность;
        <br>если $а и $b отрицательные, вывести их произведение;
        <br>если $а и $b разных знаков, вывести их сумму;
      </p>';

function ab($a,$b) {
    if ($a >= 0 && $b >= 0) 
        return  "<br>числа $a, $b >= 0 => их разность = " . ($a - $b);
    elseif ($a * $b < 0) 
        return "<br>числа $a, $b разных знаков  => их сумма = " . ($a + $b);
    else
       return "<br>числа $a, $b < 0 => их произведение = " . ($a * $b);
}
for ($a = -3,$b = 2; $a < 4; $a++, $b--) {
    if ($b < -1) 
        $b = abs($b);
    echo ab($a,$b);
}


echo '<hr><p>Задание2.
        <br> $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15;
      </p>';
$a = rand(0,15);
echo '$a = rand(0,15) = ' . $a ;
switch ($a) {
    case 0:
        echo '0<br>';;
    case 1:
        echo '<br>1';
    case 2:
        echo '<br>2';
    case 3:
        echo '<br>3';
    case 4:
        echo '<br>4';
    case 5:
        echo '<br>5';
    case 6:
        echo '<br>6';
    case 7:
        echo '<br>7';
    case 8:
        echo '<br>8';
    case 9:
        echo '<br>9';
    case 10:
        echo '<br>10';
    case 11:
        echo '<br>11';
    case 12:
        echo '<br>12';
    case 13:
        echo  '<br>13';
    case 14:
        echo '<br>14';
    case 15:
        echo '<br>15';
        break;
    default: echo '<br>Ошибка! Число вне промежутка [0,15]';
 
}

echo '<hr><p>3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
<br><br>4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).</p>';

$a = 20; 
$b = 10;
        echo '<h3>Функции с двумя параметрами: a = ' . $a . ' и b = ' . $b . ' и 4-мя арфметическими операциями</h3>';

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
            else return '<br>деление на 0!';
        }
        echo "<h3> $a и $b</h3>";
        echo "$a + $b = " . sum($a,$b);
        echo "<br>$a - $b = " . dif($a,$b);
        echo "<br>$a * $b = " . mult($a,$b);
        echo "<br>$a / $b = " . div($a,$b);
    
        
        function mathOperation($arg1, $arg2, $operation) {
            
            if ($operation != '+' && $operation != '-' && $operation != '*' && $operation != '/')
                return 'Ошибка! Операция не равна +, -, *, /';
            
            if (is_numeric($arg2) != 1 || is_numeric($arg1) != 1) {
                return 'Ошибочные значения';
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
                    $c = 'Ошибочная операция';
            }
            if ($c > 0 || $c <= 0) 
            $c = $arg1 . ' ' . $operation . ' ' . $arg2 . ' = ' . $c;
            return $c;
        }
        
        $num1 = 5; $num2 = 6; $do = '+';
        echo "<h3>Сложение двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);
        
        $do = '-';
        echo "<h3>Вычитание двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);

        
        $do = '*';
        echo "<h3>Умножение двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);

        $do = '/';
        echo "<h3>Деление двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);

        $do = 'ыпен';
        echo "<h3>Ошибочоперация двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);

        $num1 = 'xfhh'; $num2 = 6; $do = '+';
        echo "<h3>Ошибочоперация двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);

    $num1 = '5'; $num2 = 0; $do = '/';
        echo "<h3>Ошибочоперация двух чисел mathOperation($num1, $num2, $do)</h3>"; 
        echo mathOperation($num1, $num2, $do);
