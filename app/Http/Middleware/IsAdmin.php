<?php

namespace App\Http\Middleware;

use Closure;
use App\Members;
use App\Http\Controllers\MembersController;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        $data = new \stdClass();
        $data->output = "";
        $data->retval = "";
        $data->personData = null;

        exec("C:/xampp/htdocs/EIDReader/public/EIDReaderNoImg.exe", $data->output, $data->retval);
        
        if($data->output[1]==="Card isn't present!"){

            return redirect()->route("welcome")->with('error', "Error: ".$data->output[1]." Insert card and try again.");
        }
        else if($data && $data->output && !empty($data->output[4]) && isset($data->output[4])){
            
            $personData = json_decode(str_replace("'", "", $data->output[4]));
            
            $member = Members::where([["docRegNo", "=", $personData->docRegNo], ["personalNumber", "=", $personData->personalNumber]])->first();
            
            if($member && $member->role_id && $member->role_id===1){
                return $next($request);   
            }
            else{
                return redirect()->route("welcome");
            }
            
        }

    }
}
