<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

use DB;

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
    }

    public function solvePuzzle(Request $request) {

        if($request->action == 'action')
        {
            
            $list = range(0,9);

            $startTime = microtime(true); // Time Initiated

            foreach ($this->pc_permute($list) as $key => $permutation) {
                $permutations[] = implode(',', $permutation) . PHP_EOL; // Stored the permuted data in array.
            }

            foreach ($permutations as $perm) {

                //Assign permuted numbers array to each Letter
                $letterToDigit = array_combine($this->letters, explode(',',$perm));
                //print_r($lettrToDigit); 


                $hier = $this->replaceLettersWithDigits("HIER", $letterToDigit);
                $gibt = $this->replaceLettersWithDigits("GIBT", $letterToDigit);
                $es = $this->replaceLettersWithDigits("ES", $letterToDigit); // Each word is replace with its own digit from $letterToDigit;
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


                $this->iterations++;
            }
        

            $request->session()->put('solutions',collect($solutions));

            if(collect($solutions) != $request->session()->get('solutions') || Result::count() == 0){
            
                Result::create([
                    'letter_num' => json_encode($solutions),
                    'iteration' => $this->iterations,
                ]);
            }

            $seconds = microtime(true) - $startTime; // Execution ended

            return view('home')->with(['solutions' => $solutions, 'iterations' => $this->iterations, 'seconds' => $seconds]);

        }else{
                if($request->session()->exists('solutions') == ' ' && Result::count() > 0){
                    $solutions = Result::take(1)->get()->toArray();
                    $request->session()->put('solutions',json_decode($solutions[0]['letter_num'],true));
                }else{
                    $request->session()->put('solutions', ' ');
                }
            

            return view('home')->with(['solutions' => $request->session()->get('solutions'), 'iterations' => 0, 'seconds' => 0]);

        }

        
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

