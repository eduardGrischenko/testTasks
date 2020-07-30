<?php

class StroopTest
{
    private $words = ['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato'];

    public function drawLines(): void
    {
        for ($i = 0; $i < 5; $i++) {
            echo $this->getLine() . '<br>';
        }
    }

    private function getLine(): string
    {
        $line = '';

        for ($i = 0; $i < 5; $i++) {
            $line .= $this->getColoredWordHtml() . ' ';
        }

        return $line;
    }

    private function getColoredWordHtml(): string
    {
        $words = $this->words;
        shuffle($words);
        $word = array_shift($words);
        $color = current($words);
        return "<font color='{$color}'>$word</font>";
    }
}
