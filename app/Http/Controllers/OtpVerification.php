<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp_codes;
use Carbon\Carbon;
use Auth;

class OtpVerification extends Controller
{
    //

    public function MailVerification(request $request){

        $CurrTime = Carbon::now();
        // dd($CurrTime);
        $Otps= otp_codes::all();
        $OtpCodes = $request->otp;
        foreach($Otps as $Otp){
            $GetUserAndCode = otp_codes::where([
                ['user_id','=',Auth::user()->id],
                ['valid_until','>=',$CurrTime] ,
                ['otp','=',$OtpCodes],

                                               
                ])->get();

            }
            // dd($GetUserAndCode);
            //get current code from list
        if(count($GetUserAndCode) != NULL){
        foreach($GetUserAndCode as $GetCode){
           
                $GetCodeId = $GetCode->otp;
            }
        }else{
                $GetCodeId = 0;
                // dd('im here');
        }
         
        //  dd($GetCodeId);
        //  dd($GetCodeId);
        if(Auth::user()->id != NULL && Auth::user()->mailsend == false && $GetCodeId == $OtpCodes){

          $TrueOtp=User::find(Auth::user()->id);
          $TrueOtp->mailsend=true;
          $TrueOtp->save();

          return response('Success Validation Your Email');

        
        }elseif(Auth::user()->mailsend == false && $GetCodeId == 0){
            
            return 'Oops Its look like your OTP Code Was Expired, Request OTP Code Again';

        
        
        }else{
            
            return 'Your Mail Already Verified';
        }
        

    }

    public function ResendOtp(request $request){
       
        $CurrTime = Carbon::now();
        $Otps= otp_codes::all();
        foreach($Otps as $Otp){
            $GetUserAndCode = otp_codes::where([
                ['user_id','=',Auth::user()->id],
                ['valid_until','>=',$CurrTime] ,
                                               
                ])->get();

            }
    
            // dd($GetUserAndCode);
            //get current code from list
        // if(count($GetUserAndCode) != NULL){
        // foreach($GetUserAndCode as $GetCode){
           
        //         $GetCodeId = $GetCode->otp;
        //     }
        // }else{
        //         $GetCodeId = 0;
        //         // dd('im here');
        // }
         
        if(Auth::user()->id != NULL && Auth::user()->mailsend == false && count($GetUserAndCode) == NULL){

            $GetSixRandomNumber = mt_rand(100000,999999);
            // name + 6 rand number
             $GetOtpCode=$GetSixRandomNumber;
             //
             //get otp valid time
             $Valid_time= Carbon::now()->addMinute(5);
             //
             $NewOtp = new otp_codes();
             $NewOtp->otp = $GetOtpCode;
             $NewOtp->user_id = Auth::user()->id;
             $NewOtp->valid_until=$Valid_time;
             $NewOtp->save();            
            return response('Success Generate New OTP, Check Your Mail');
        }else{

            return response('Otp Already Send, Check Your Mail');
                // dd('im here');
        }

        
    }
    
}
