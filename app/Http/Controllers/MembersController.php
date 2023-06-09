<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Members;
use \stdClass;
use File;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome(){
        return view('welcome');
    }

    public function index()
    {
        $members = null;
        if(request('search')){
            $members = Members::
            where("surname", "like", "%" . request("search") . "%")
            ->orWhere("parentGivenName", "like", "%" . request("search") . "%")
            ->orWhere("givenName", "like", "%" . request("search") . "%")
            ->orWhere("dateOfBirth", "like", "%" . request("search") . "%")
            ->orWhere("placeOfBirth", "like", "%" . request("search") . "%")
            ->orWhere("stateOfBirth", "like", "%" . request("search") . "%")
            ->orWhere("docRegNo", "like", "%" . request("search") . "%")
            ->orWhere("personalNumber", "like", "%" . request("search") . "%")
            ->orWhere("issuingDate", "like", "%" . request("search") . "%")
            ->orWhere("expiryDate", "like", "%" . request("search") . "%")
            ->paginate(5);
        }
        else{
            $members = Members::with("role")->paginate(5);
        }
        
        return view("pages.index", compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = "avatar.jpg";

        $data = new \stdClass();
        $data->output = "";
        $data->retval = "";
        $data->personData = null;

        exec("C:/xampp/htdocs/EIDReader/public/EIDReader.exe", $data->output, $data->retval);
        
        if($data && $data->output && !empty($data->output[8]) && isset($data->output[8])){

            $personData = json_decode(str_replace("'", "", $data->output[8]));
        
            $folderPath = $data->output[4];
    
            $index = strrpos($folderPath, "/");
            $personImageFolder = substr($folderPath, $index+1);
            $imageName = "avatar.jpg";
            $imagePath = $personImageFolder."/".$imageName;
            
            $member = Members::where([["docRegNo", "=", $personData->docRegNo], ["personalNumber", "=", $personData->personalNumber]])->first();
            $ifMembersExists = $member && $member->exists();
            $response = null;
    
            if($ifMembersExists){
                
                $response = new \stdClass();
                $response->message = "Član već postoji";
                $response->member = $member;
    
                return view("pages.show", compact("response"));  
    
            }
            else{
    
                $member = new Members;
                $member->surname = $personData->surname;
                $member->parentGivenName = $personData->parentGivenName;
                $member->givenName = $personData->givenName;
                $member->dateOfBirth = $personData->dateOfBirth;
                $member->placeOfBirth = $personData->placeOfBirth;
                $member->stateOfBirth = $personData->stateOfBirth;
                $member->docRegNo = $personData->docRegNo;
                $member->personalNumber = $personData->personalNumber;
                $member->issuingDate = $personData->issuingDate;
                $member->expiryDate = $personData->expiryDate;
                $member->portrait = $imagePath;
                $member->save();
    
                $response = new \stdClass();
                $response->message = "Novi član je ubeležen";
                $response->member = $member;
    
                return view("pages.store", compact("response"));  
    
            }

        }
        else{
            $response = null;
            return view("pages.store", compact("response"));  
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Members::findOrFail($id);
        $response = new \stdClass();
        $response->message = "Izabrani član";
        $response->member = $member;
        return view("pages.show", compact("response"));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $memberId = $id;
        $response = null;

        $imageName = "avatar.jpg";

        $member = Members::findOrFail($id);
        $oldImage = $member->portrait;
        $index1 = strrpos($oldImage, "/");
        $oldImageFolder = substr($oldImage, 0, $index1);
        
        $data = new \stdClass();
        $data->output = "";
        $data->retval = "";
        $data->personData = null;

        exec("C:/xampp/htdocs/EIDReader/public/EIDReader.exe", $data->output, $data->retval);
        
        if($data && $data->output && !empty($data->output[8]) && isset($data->output[8])){
            
            $personData = json_decode(str_replace("'", "", $data->output[8]));
            
            $folderPath = $data->output[4];

            $index = strrpos($folderPath, "/");
            $personImageFolder = substr($folderPath, $index+1);
            $imageName = "avatar.jpg";
            $imagePath = $personImageFolder."/".$imageName;

            if($oldImageFolder===$personImageFolder){
            
            }
            else{
                File::deleteDirectory(public_path($oldImageFolder));
            }

            $member->surname = $personData->surname;
            $member->parentGivenName = $personData->parentGivenName;
            $member->givenName = $personData->givenName;
            $member->dateOfBirth = $personData->dateOfBirth;
            $member->placeOfBirth = $personData->placeOfBirth;
            $member->stateOfBirth = $personData->stateOfBirth;
            $member->docRegNo = $personData->docRegNo;
            $member->personalNumber = $personData->personalNumber;
            $member->issuingDate = $personData->issuingDate;
            $member->expiryDate = $personData->expiryDate;
            $member->portrait = $imagePath;
            $member->save();

            $response = new \stdClass();
            $response->message = "Podaci člana su obnovljeni";
            $response->member = $member;

            return view("pages.update", compact("response")); 

        }
        else{
            $response = null;
            
            return view("pages.update", compact("response", "memberId"));  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Members::findOrFail($id);

        $response = null;
        $response = new \stdClass();
        $response->message = "Podaci člana su obrisani";
        $response->member = $member;

        $oldImage = $member->portrait;
        $index1 = strrpos($oldImage, "/");
        $oldImageFolder = substr($oldImage, 0, $index1);
        //File::deleteDirectory(public_path($oldImageFolder));
        $member->delete();

        return view("pages.delete", compact("response")); 

    }

}
