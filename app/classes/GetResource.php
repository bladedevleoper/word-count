<?php


namespace App\Classes;
use Exception;

class GetResource
{

    public $resource;
    public $wordLengthCollection = [];
    public $lengthAppears = [];
    public $wordCollection = [];

    public function __construct($file)
    {
        $this->resource = $file;
        $this->openResource();
    }

    /*
     * Opens and extracts data
     */
    public function openResource()
    {
        try {

            if ($fh = fopen($this->resource, 'r')) {
                $this->extractFileContent($fh);
            } else {
                throw new Exception('Sorry the file or url cannot be located or opened, please check your path');
            }



        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /* Extract contents from resource returned from method openResource
       * starts the
     * @var resource
     */
    public function extractFileContent($fileHandler)
    {
        while (!feof($fileHandler)) {

            if ($line = fgets($fileHandler)) {

                //this is going to split everything with by a space and return an array
                $words = explode(' ', $line);

                foreach ($words as $key => $word) {

                    //replace any of these characters
                    $word = str_replace([',', ':', ';','(',')', '*', '\'', '?', '!'], '', $word);

                    //check for character at the end of word
                    $word = preg_replace('/[.]$/', '', $word);

                    //trims white space from around string value within $word
                    $word = trim($word);

                    //$words[$key] = $word;


                    if (strlen($word) > 0) {

                        //we can use this to then perform count()
                        array_push($this->wordCollection, $word);

                        if (!array_key_exists(strlen($word),$this->lengthAppears)) {
                            //set initial key and make its value 1
                            $length = strlen($word);
                            $this->lengthAppears[$length] = 1;

                        } else {
                            //find key and add 1
                            $key = strlen($word);
                            $this->lengthAppears[$key] += 1;
                        }

                        //obtain average word length
                        $this->wordLengthCollection[] = strlen($word);
                    }

                }

            }
        }


        //close the open file pointer
        fclose($fileHandler);

        //run output process
        $this->output();
    }

    /*
    * function to get average of word length
    * return float
    */
    public function getAverageWordCount(array $array, array $words): float
    {
        $average = array_reduce($array, function ($count, $value) {
            return $count += $value;
        });

        return number_format($average / count($words), 3);

    }

    /*
     * Outputs frequent word lengths
     * return string - most frequent occurring word length
     */
    public function runFrequent():string
    {
        ksort($this->lengthAppears);
        foreach ($this->lengthAppears as $length => $count) {
            echo "Number of words of length ${length} is $count \r\n";
        }

        $frequent = $this->findFrequentWords();
        return $this->buildFrequentString($frequent);

    }

    /*Find the most frequent words within $this->lengthAppears array
     *
     * return array
     */
    public function findFrequentWords():array
    {
        $holder = [];
        arsort($this->lengthAppears);

        foreach ($this->lengthAppears as $key => $value) {

            if (empty($holder)) {
                $holder[$key] = $value;

            } else {
                $position = array_search($value, $holder);
                if ($position != 0) {
                    $holder[$position] >= $value ? $holder[$key] = $value : false;
                }
            }
        }

        return $holder;
    }

    /*Build string based on elements inside of $array
     * @var array
     * return string
     */
   public function buildFrequentString(array $array):string
    {
        if (count($array) > 1) {
            return $this->forMultipleValues($array);
        } else {
            return $this->forOneValue($array);
        }

    }

    /*
     * builds a string for more than 1 frequently used word lengths
     * @var $array
     * return string
     */
    public function forMultipleValues(array $array):string
    {

        $conjunction = '&';
        $keys = array_keys($array);
        $frequentLength = $array[$keys[0]];
        $last = array_pop($keys);


        return 'The most frequently occurring word length is ' .$frequentLength.', for word lengths of ' . implode(',', $keys) . ' ' . $conjunction . ' ' . $last . '.';

    }

    /*
     * builds a string for 1 frequently used word length
     * @var $array
     * return string
     */
   public function forOneValue(array $array): string
    {
        $keys = array_keys($array);
        $frequentLength = $array[$keys[0]];

        return 'The most frequently occurring word length is ' .$frequentLength.', for word lengths of ' .$keys[0] . '.';
    }


    //renders output to screen
    public function output()
    {
        echo sprintf("Word count = %d", count($this->wordCollection)) . "\r\n";
        echo sprintf("Average word length = %g", $this->getAverageWordCount($this->wordLengthCollection, $this->wordCollection)) . "\r\n";
        echo $this->runFrequent();

    }

}



