<?php 

    declare(strict_types = 1);

    function is_input_empty(string $title, string $content){
        if(empty($title) || empty($content)){
            return true;
        } else {
            return false;
        }
    }

    function invalid_length(string $input, int $min, int $max){
        if(strlen($input) > $max || strlen($input) < $min){
            return true;
        } else {
            return false;
        }
    }

    function is_valid_img(string $mimeType, array $allowedTypes, int $fileError, int $fileSize, array $errors){
        if(in_array($mimeType, $allowedTypes)){
            if($fileError === 0){
                if($fileSize < 3000000){
                    return true;
                } 
            } 
        } else {
            return false;
        }
    }
?>