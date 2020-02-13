<?php

namespace App\Imports;

use App\Country;
use App\Employee;
use App\User;
use App\Mail\NewUserMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Helpers\GenerateReportsHelper;
use App\Enums\EpfCategoryEnum;
use App\Enums\SocsoCategoryEnum;
use App\Enums\PCBGroupEnum;
use App\SecurityGroup;
use App\Enums\PaymentViaEnum;
use App\Enums\PaymentRateEnum;
use App\Category;

class ProfileSheetImport implements WithHeadingRow, ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::debug('Profile Sheet');
        /* 
         * 1.	Employee ID is unique
         * 2.	Overwrite if employee ID already exists
         * 3.	Errors/Invalid entry in text file for user to download 
        */
        
        //TODO: if new check if is rejoin by ic number. prompt message if blacklisted 
        
        $passwordString = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        foreach ($collection as $row)
        {
            Log::debug($row);
            if($row['employee_id'] != null) {
                $employee = Employee::with('user')->where('code',$row['employee_id'])->first();
                Log::debug($employee);
                
                $nationality = Country::where('name',$row['nationality'])->first();
                $epfCategory = EpfCategoryEnum::getValue($row['epf_category']);
                $socsoCategory = SocsoCategoryEnum::getValue($row['socso_category']);
                $pcbGroup = PCBGroupEnum::getValue($row['pcb_group']);
                $securityGroup = SecurityGroup::where([['name', $row['security_group']], ['company_id',$company->id]])->first();
                $paymentVia = PaymentViaEnum::getValue($row['payment_via']);
                $paymentRate = PaymentRateEnum::getValue($row['payment_rate']);
                $category = Category::where([['name', $row['category']], ['company_id',$company->id]])->first();
                
                if(isset($employee)) {
                    // Existing User
                    Log::debug('Existing User');
                    Log::debug($employee);
                    
                    $user = User::find($employee->user_id);
                    $user->name = $row['name'];
                    $user->email = $row['email'];
                    $user->save();
                    
                    if($row['role'] != null){
                        $user->syncRoles($row['role']);
                    }
                    
                    $employee = Employee::find($employee->id);
                    $employee->code = $row['employee_id'];
                    $employee->contact_no = $row['contact_no'];
                    $employee->address = $row['address_line_1'];
                    $employee->address2 = $row['address_line_2'];
                    $employee->address3 = $row['address_line_3'];
                    $employee->postcode = $row['postcode'];
                    $employee->dob = $row['date_of_birth'];
                    $employee->gender = $row['gender'];
                    $employee->race = $row['race'];
                    $employee->nationality = $nationality->id;
                    $employee->marital_status = $row['marital_status'];
                    $employee->total_children = $row['no_of_children'];
                    $employee->ic_no = $row['ic_no'];
                    $employee->tax_no = $row['tax_no'];
                    $employee->epf_no = $row['epf_no'];
                    $employee->epf_category = $epfCategory;
                    $employee->socso_no = $row['socso_no'];
                    $employee->socso_category = $socsoCategory;
                    $employee->eis_no = $row['eis_no'];
                    $employee->pcb_group = $pcbGroup;
                    $employee->driver_license_no = $row['driver_license_no'];
                    $employee->driver_license_expiry_date = $row['license_expiry_date'];
                    $employee->main_security_group_id = $securityGroup->id;
                    $employee->personal_email = $row['personal_email'];
                    $employee->spouse_name = $row['spouse_name'];
                    $employee->spouse_ic = $row['spouse_ic_no'];
                    $employee->spouse_tax_no = $row['spouse_tax_no'];
                    $employee->payment_via = $paymentVia;
                    $employee->payment_rate = $paymentRate;
                    $employee->category_id = $category->id;
                    $employee->save();
                    
                } else {
                    
                    // New user
                    Log::debug('New User');
                    $password = substr(str_shuffle($passwordString), 0, 12);
                    
                    $user = User::create([
                        'name' => $row['name'],
                        'password' => bcrypt($password),
                        'email' => $row['email'],
                    ]);
                    
                    if($row['role'] != null){
                        $user->assignRole($row['role']);
                    }
                    
                    Employee::create([
                        'user_id' => $user->id,
                        'code' => $row['employee_id'],
                        'contact_no' => $row['contact_no'],
                        'address' => $row['address_line_1'],
                        'address2' => $row['address_line_2'],
                        'address3' => $row['address_line_3'],
                        'postcode' => $row['postcode'],
                        'company_id' => $company->id,
                        'dob' => $row['date_of_birth'],
                        'gender' => $row['gender'],
                        'race' => $row['race'],
                        'nationality' => $nationality->id,
                        'marital_status' => $row['marital_status'],
                        'total_children' => $row['no_of_children'],
                        'ic_no' => $row['ic_no'],
                        'tax_no' => $row['tax_no'],
                        'epf_no' => $row['epf_no'],
                        'epf_category' => $epfCategory,
                        'socso_no' => $row['socso_no'],
                        'socso_category' => $socsoCategory,
                        'eis_no' => $row['eis_no'],
                        'pcb_group' => $pcbGroup,
                        'driver_license_no' => $row['driver_license_no'],
                        'driver_license_expiry_date' => $row['license_expiry_date'],
                        'main_security_group_id' => $securityGroup->id,
                        'personal_email' => $row['personal_email'],
                        'spouse_name' => $row['spouse_name'],
                        'spouse_ic' => $row['spouse_ic_no'],
                        'spouse_tax_no' => $row['spouse_tax_no'],
                        'payment_via' => $paymentVia,
                        'payment_rate' => $paymentRate,
                        'category_id' => $category->id
                    ]);
                    
                    $emailData = array();
                    $emailData['name'] = $row['name'];
                    $emailData['email'] = $row['email'];
                    $emailData['password'] = $password;
                    
                    //send email
                    //                 Mail::to($row['email'])
                    //                 ->bcc(env('BCC_EMAIL'))
                    //                 ->send(new NewUserMail($emailData));
                    
                }
            }
        }
    }
}
