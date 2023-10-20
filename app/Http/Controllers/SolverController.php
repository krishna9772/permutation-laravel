<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use IterTools\Multi;

class SolverController extends Controller
{
    private $equation;
    private $letters;
    private $solutions;
    public $iterations;

    public function __construct($equation=null) {
        $this->equation = $equation;
        $this->letters = ['H','I','E','R','G','B','T','S','N','U'];
        $this->solutions = [];
        $this->iterations = 0;
    }

    public function solvePuzzle() {
        $iterations = '';

        $list = range(0,9);

        foreach ($this->pc_permute($list) as $key => $permutation) {
            $permutations[] = implode(',', $permutation) . PHP_EOL; // Stored the permuted data in array.
        }

        $startTime = microtime(true);


        foreach ($permutations as $perm) {

            $letterToDigit = array_combine($this->letters, explode(',',$perm)); // Assign permuted numbers array to each Letter;

            $hier = $this->replaceLettersWithDigits("HIER", $letterToDigit);
            $gibt = $this->replaceLettersWithDigits("GIBT", $letterToDigit);
            $es = $this->replaceLettersWithDigits("ES", $letterToDigit);
            $neues =$this->replaceLettersWithDigits("NEUES", $letterToDigit);
           
            if ($hier + $gibt + $es == $neues) {
                $solutions[] = [
                    'HIER' => $hier,
                    'GIBT' => $gibt,
                    'ES' => $es,
                    'NEUES' => $neues,
                    'PERM' => $perm,
                ];
            }

            $iterations++;
        }
       
        $seconds = microtime(true) - $startTime;

        return view('home')->with(['solutions' => $solutions, 'iterations' => $iterations, 'seconds' => $seconds]);
    }

    function pc_permute(array $elements)
    {
        if (count($elements) <= 1) {
            yield $elements;
            
        } else {
            foreach ($this->pc_permute(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge( // Object for two arrays in three forms to get permutation 
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    function replaceLettersWithDigits($word, $lettersToDigits) {
        
        $intVal = 0;
        foreach (str_split($word) as $letter) { // Arrange the numbers according to equation's letters without repeatation.
            $intVal = $intVal * 10 + $lettersToDigits[$letter]; 
        }
        return $intVal;
    }

}

