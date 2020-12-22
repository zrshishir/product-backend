<?php
namespace App\Helper;

class Helper {

    public function noContent(){
        return $this->responseProcess(0, 204, "No Content", "");
    }

    public function indexData($datas){
        return $this->responseProcess(0, 200, "Datas...", $datas);
    }

    public function validatingErrors($errorMsg){
        return $this->responseProcess(1, 422, $errorMsg, "");
    }

    public function invalidEditId(){
        return $this->responseProcess(1, 403, "Invalid id.", "");
    }

    public function savingData($datas){
        return $this->responseProcess(0, 201, "Data has been saved.", $datas);
    }

    public function serverError(){
        return $this->responseProcess(1, 500, "Internal Server Error.", "");
    }

    public function notNumeric($datas){
        return $this->responseProcess(1, 403, "The id should be a number.", $datas);
    }

    public function deletingData($datas){
        return $this->responseProcess(0, 200, "Data has been deleted successfully.", $datas);
    }

    public function invalidDeleteId($datas){
        return $this->responseProcess(1, 400, "Please give a valid id.", $datas);
    }

    public function invalidLogin($message){
        return $this->responseProcess(1, 401, $message, "");
    }

    public function loggedIn($datas){
        return $this->responseProcess(0, 200, "You are logged in...", $datas);
    }


    public function responseProcess($errorCode, $statusCode, $msg, $data){
        $responseData['error'] = $errorCode;
        $responseData['statusCode'] = $statusCode;
        $responseData['errorMsg'] = $msg;
        $responseData['data'] = $data;

        return $responseData;
    }
}