<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalDocument extends Model
{
    protected $fillable = [
        'user_id',
        'nib',
        'personal_npwp',
        'company_npwp',
        'founder_npwp',
        'bank_account_holder',
        'bank_name',
        'bank_account_number',
        'foreign_bank'
    ];

    public function getForeignBankAttribute($value)
    {
        return json_decode($value);
    }

    public function saveData($data)
    {
        $result = $this->updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'nib' => $data['nib'],
                'personal_npwp' => $data['personal_npwp'],
                'company_npwp' => $data['company_npwp'],
                'founder_npwp' => $data['founder_npwp'],
                'bank_account_holder' => $data['bank_account_holder'],
                'bank_name' => $data['bank_name'],
                'bank_account_number' => $data['bank_account_number'],
                'foreign_bank' => json_encode($data['foreign_bank'])
            ]
        );

        return $result;
    }
}
