<?php

use Illuminate\Database\Seeder;

class EaFormSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $eaform=App\Eaform::create([
            'id'=>1,
            'code'=>'B1a',
            'name'=>'Gross salaries, wages or leave pay (including overtime pay)'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>2,
            'code'=>'B1b',
            'name'=>'Fees (including director fees), commissions or bonuses'
            ] );
            
            
            $eaform=App\Eaform::create([
            'id'=>3,
            'code'=>'B1c',
            'name'=>'Gross tips, perquisites, acceptance of consolation or other allowances'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>4,
            'code'=>'B1d',
            'name'=>'Income Tax payable by Employer on behalf of the Employee'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>5,
            'code'=>'B1e',
            'name'=>'Employee Share Option Scheme (ESOS) Benefits'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>6,
            'code'=>'B1f',
            'name'=>'Gratuity'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>7,
            'code'=>'B2',
            'name'=>'Arrears'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>8,
            'code'=>'B3',
            'name'=>'Benefits in kind'
            ] );
            
            
            $eaform=App\Eaform::create([
            'id'=>9,
            'code'=>'B4',
            'name'=>'Value of living accommodation'
            ] );
            
            
            $eaform=App\Eaform::create([
            'id'=>10,
            'code'=>'B5',
            'name'=>'Refund from unapproved Provident/Pension Fund'
            ] );
            
            
                        
            $eaform=App\Eaform::create([
            'id'=>11,
            'code'=>'B6',
            'name'=>'Compensation for loss of employment'
            ] );
            
            
            $eaform=App\Eaform::create([
            'id'=>12,
            'code'=>'C1',
            'name'=>'Pension'
            ] );
            
            
            $eaform=App\Eaform::create([
            'id'=>13,
            'code'=>'C2',
            'name'=>'Annuities or other Periodical Payments'
            ] );
            
            
    }
}