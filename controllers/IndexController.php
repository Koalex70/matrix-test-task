<?php

class IndexController extends Contoller
{
    private $pageTpl = VIEW_PATH . 'main.php';

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    /**
     *
     */
    public function index()
    {
        $this->view->render($this->pageTpl, $this->pageData);

        if (isset($_POST['text']) && !empty($_POST['text'])) {
            $result = $this->getAllOptions($_POST['text']);

            $newOptions = $this->findNemOptions($result);
            $this->model->setNewOptions($newOptions);

            $this->pageData['options'] = $result;
            $this->pageData['newOptions'] = $newOptions;

            $this->view->render(VIEW_PATH . 'options.php', $this->pageData);
        }
    }

    /**
     * @param $string string
     * @return array
     * Public method to start searching for all options
     */
    public function getAllOptions($string)
    {
        $array = $this->parser($string);
        array_unshift($array, '');

        return $this->createAllOptions($array);
    }

    /**
     * @param $string
     * @param string $open
     * @param string $close
     * @return array
     * Splits a string into an array that is convenient to work with
     */
    private function parser(&$string, $open = '{', $close = '}')
    {
        $result = [];
        $i = 0;
        while ($strlen = strlen($string)) {
            $symbol = substr($string, 0, 1);
            $string = substr($string, 1, $strlen - 1);
            if ($symbol == $open) {
                $result[++$i] = $this->parser($string, $open, $close);
                ++$i;
            } else if ($symbol == $close) {
                break;
            } else {
                if ($symbol == '|') {
                    $i++;
                    continue;
                }
                if (!isset($result[$i])) {
                    $result[$i] = '';
                }
                $result[$i] .= $symbol;
            }
        }
        return $result;
    }

    /**
     * @param $array
     * @return array
     * The main method that iterates through the entire main array
     */
    private function createAllOptions($array)
    {
        $result[0] = '';

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $tmpResult = $this->gluing($array[$key]);
                $result = $this->addOptions($result, $tmpResult);
            } else {
                $result = $this->addOption($result, $value);
            }
        }

        return $result;
    }

    /**
     * @param $result
     * @param $value
     * @return mixed
     * adds a string to all options
     */
    private function addOption($result, $value)
    {
        foreach ($result as $key => $string) {
            $result[$key] = $string . $value;
        }

        return $result;
    }

    /**
     * @param $mainArray array
     * @param $tmpArray array
     * @return array
     * Generates all possible variants from two arrays
     */
    private function addOptions($mainArray, $tmpArray)
    {
        $size = count($mainArray);
        $mainArray = $this->increaseArray($mainArray, count($tmpArray));
        $currentValue = 0;

        foreach ($mainArray as $key => $value) {
            $mainArray[$key] .= $tmpArray[$currentValue];

            if (($key + 1) % $size == 0) {
                ++$currentValue;
            }
        }

        return $mainArray;
    }

    /**
     * @param $array array
     * @param $size int
     * @return array
     * Increases the size of the array copy the existing elements
     */
    private function increaseArray($array, $size)
    {
        $j = 0;
        $arraySize = count($array);

        for ($i = $arraySize; $i < $arraySize * $size; ++$i, ++$j) {
            $array[$i] = $array[$j];
        }

        return $array;
    }

    /**
     * @param $array array
     * @return array
     * Makes multidimensional arrays a one-dimensional
     */
    private function gluing($array)
    {
        $tmpArray[0] = '';

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $tmpArray = $this->gluing($array[$key]);
                $string = array_pop($result);
                foreach ($tmpArray as $tmpKey => $tmpValue) {
                    $result[] = $string . $tmpValue;
                }
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * @param $array array
     * @return array
     * Looking for new options
     */
    private function findNemOptions($array)
    {
        $existingOptions = $this->model->getAllOptions();
        $result = [];

        foreach ($array as $value) {
            $check = 1;

            foreach ($existingOptions as $existingOption) {
                if ($value == $existingOption['string']) {
                    $check = 0;
                    break;
                }
            }

            if ($check == 1) {
                $result[] = $value;
            }
        }

        return $result;
    }
}
