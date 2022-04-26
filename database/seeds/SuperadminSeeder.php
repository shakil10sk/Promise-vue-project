<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\DB;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $employee_id =  generateEmployeeId();

        $employee_data = [
            'employee_id' => $employee_id,
            'name' => 'মোহাম্মদ ফারুক হোসেন',
            'nid' => null,
            'mobile' => '01716685646',
            'birth_date' => null,
            'gender' => 'male',
            'photo' => null,
            'recruitment_letter' => null,
            'religion' => 'Islam',
            'educational_qulification' => 'MBA',
            'hiring_authority' => '1',
            'first_joining' => '2022-06-02',
            'created_by' => '1',
            'created_by_ip' => '127.0.0.1',
        ];

        $user_data = [
            'employee_id' => $employee_id,
            'mobile_no' =>  '01716685646',
            'password' => Hash::make('01716685646'),
            'type' => 1,
            'created_by' => '1',
            'created_by_ip' => '127.0.0.1',
        ];

        DB::beginTransaction();
        try{

            DB::table('employees')->insert($employee_data);
            DB::table('users')->insert($user_data);

            DB::commit();

        }catch (Exception $exception){
            echo $exception->getMessage();
        }



    }
}
