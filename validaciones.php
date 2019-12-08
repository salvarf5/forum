<?php 
 function validarequerido($valor){
    if(trim($valor) == ''){
       return false;
    }else{
       return true;
    }
 }
 function validaemail($valor){
    if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
       return false;
    }else{
       return true;
    }
 }
?>