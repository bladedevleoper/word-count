<?php

namespace App\Traits;

trait ManipulateData
{
    use BuildString;

    /*
     //TODO add this to its own method named output
        echo sprintf("Word count = %d", count($wordCollection)) . '<br>';

        echo sprintf("Average word length = %g", getAverageWordCount($wordLengthCollection, $wordCollection)) . '<br>';
        arsort($lengthAppears);
        //printOut($lengthAppears);
        foreach ($lengthAppears as $length => $count) {
            echo "Number of words of length ${length} is $count <br>";
        }
        //echo '<pre>';
          $frequent = findFrequent($lengthAppears);

        echo buildFrequentString($frequent);
        //echo '</pre>';


     */



    //find average word
    public function getAverageWordCount(array $array, array $words): float
    {
        $average = array_reduce($array, function ($count, $value) {
            return $count += $value;
        });

        return number_format($average / count($words), 3);

    }

    //find frequent word length
   public function findFrequent(array $array)
    {
        //assort array descending order highest to lowest
        arsort($array);

        $holder = [];
        foreach ($array as $key => $value) {

            if (empty($holder)) {
                $holder[$key] = $value;
            } else {
                $position = array_search($value, $holder);
                ($holder[$position] >= $value) ? $holder[$key] = $value : false;
            }
        }

        return $holder;
    }



    public function buildFrequentString(array $array):string
    {
        if (count($array) > 1) {
            return $this->forMultipleValues($array);
        } else {
            return $this->forOneValue($array);
        }

    }


}