<?php
$view->extend('layouts/default.php');
$view['slots']->set('title', 'SplSubject.');
$view['slots']->set(
    'breadcrumbs',
    array(
        array('title' => 'SPL', 'url' => '/spl/'),
        array('title' => 'Разное', 'url' => '/spl/other/'),
        array('title' => 'SplSubject')
    )
);
echo $view->render(
    'partials/syntax_highlighter.php',
    array(
        'brushes' => array('Php')
    )
);
// TODO добавить ссылку на SplObserver
?>

<h2>Описание</h2>
<blockquote>
    Интерфейс SplSubject используется совместно с SplObserver для реализации шаблона проектирования <a href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D0%B1%D0%BB%D1%8E%D0%B4%D0%B0%D1%82%D0%B5%D0%BB%D1%8C_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)">Наблюдатель (Observer)</a>.
</blockquote>
<p>
    <b>Внимание!</b> Это только интерфейсы, они не предоставляют какой то реализации, в отличии от Java.
</p>

<h2>Использование</h2>
<p>
    Предположим, у нас есть валюта, и её курс периодически меняется, вследствие этого меняется цена на товары, зависящих от этой валюты.
</p>
<p>
    Пример конечно сильно надуманный, и он немного упускает суть. Представьте, что у подписчика может быть несколько субъектов. 
</p>

<script type="syntaxhighlighter" class="brush: php"><![CDATA[
class Currency implements SplSubject
{
    protected $rate;
    protected $observers;

    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        if (($key = array_search($observer, $this->observers, true)) !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        $this->notify();
    }

    public function getRate()
    {
        return $this->rate;
    }
}

class Good implements SplObserver
{
    protected $currencyPrice;
    protected $price;

    public function __construct($currencyPrice, Currency $currency)
    {
        $this->currencyPrice = $currencyPrice;
        $currency->attach($this);
        $this->update($currency);
    }

    public function update(SplSubject $subject)
    {
        $this->price = $this->currencyPrice * $subject->getRate();
    }

    public function getPrice()
    {
        return $this->price;
    }
}

$dollar = new Currency(35);
$mars = new Good(2, $dollar);

echo "dollar rate: " . $dollar->getRate() . "\n";
echo "mars price: " . $mars->getPrice() . "\n\n";

$dollar->setRate(37);

echo "dollar rate: " . $dollar->getRate() . "\n";
echo "mars price: " . $mars->getPrice() . "\n";
]]></script>

<pre>
<?php

class Currency implements SplSubject
{
    protected $rate;
    protected $observers;

    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        if (($key = array_search($observer, $this->observers, true)) !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        $this->notify();
    }

    public function getRate()
    {
        return $this->rate;
    }
}

class Good implements SplObserver
{
    protected $currencyPrice;
    protected $price;

    public function __construct($currencyPrice, Currency $currency)
    {
        $this->currencyPrice = $currencyPrice;
        $currency->attach($this);
        $this->update($currency);
    }

    public function update(SplSubject $subject)
    {
        $this->price = $this->currencyPrice * $subject->getRate();
    }

    public function getPrice()
    {
        return $this->price;
    }
}

$dollar = new Currency(35);
$mars = new Good(2, $dollar);

echo "dollar rate: " . $dollar->getRate() . "\n";
echo "mars price: " . $mars->getPrice() . "\n\n";

$dollar->setRate(37);

echo "dollar rate: " . $dollar->getRate() . "\n";
echo "mars price: " . $mars->getPrice() . "\n";
?>
</pre>

<h2>Ссылки:</h2>
<ul>
    <li><a href="http://php.net/manual/ru/class.splsubject.php">Официальная документация</a></li>
    <li><a href="https://ru.wikipedia.org/wiki/%D0%9D%D0%B0%D0%B1%D0%BB%D1%8E%D0%B4%D0%B0%D1%82%D0%B5%D0%BB%D1%8C_(%D1%88%D0%B0%D0%B1%D0%BB%D0%BE%D0%BD_%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F)">Паттерн Наблюдатель (Observer)</a></li>
</ul>
