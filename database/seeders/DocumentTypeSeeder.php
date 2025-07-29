<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DocumentType::create([
            'name'          => 'Passport',
            'description'   => 'Passport'
        ]);

        DocumentType::create([
            'name'          => 'Certificate',
            'description'   => 'Certificate'
        ]);

        DocumentType::create([
            'name'          => 'National Id',
            'description'   => 'National Id'
        ]);

        DocumentType::create([
            'name'          => 'KCPE Certificate',
            'description'   => 'KCPE Certificate'
        ]);

        DocumentType::create([
            'name'          => 'KCSE Certificate',
            'description'   => 'KCSE Certificate'
        ]);

        DocumentType::create([
            'name'          => 'Diploma Certificate',
            'description'   => 'Diploma Certificate'
        ]);

        DocumentType::create([
            'name'          => 'Degree Certificate',
            'description'   => 'Degree Certificate'
        ]);

        DocumentType::create([
            'name'          => 'Invoice',
            'description'   => 'Invoice'
        ]);

        DocumentType::create([
            'name'          => 'Receipt',
            'description'   => 'Receipt'
        ]);

        DocumentType::create([
            'name'          => 'Cheque',
            'description'   => 'Cheque'
        ]);

        DocumentType::create([
            'name'          => 'Credit Note',
            'description'   => 'Credit Note'
        ]);

        DocumentType::create([
            'name'          => 'Occurrence Report',
            'description'   => 'Occurrence Report'
        ]);

        DocumentType::create([
            'name'          => 'Company Manual',
            'description'   => 'Company Manual'
        ]);

        DocumentType::create([
            'name'          => 'Customer Contract',
            'description'   => 'Customer Contract'
        ]);

        DocumentType::create([
            'name'          => 'Tender Document',
            'description'   => 'Tender Document'
        ]);

        DocumentType::create([
            'name'          => 'Payroll Export',
            'description'   => 'Payroll Export'
        ]);

        DocumentType::create([
            'name'          => 'Bank Account Reports',
            'description'   => 'Bank Accounts Reports'
        ]);

        DocumentType::create([
            'name'          => 'Invoice Reports',
            'description'   => 'Invoice Reports'
        ]);

        DocumentType::create([
            'name'          => 'System Changes Report',
            'description'   => 'System Changes Report'
        ]);

        DocumentType::create([
            'name'          => 'Employee Report',
            'description'   => 'Employee Report'
        ]);

        DocumentType::create([
            'name'          => 'Patrol Reports Report',
            'description'   => 'Patrol Reports Report'
        ]);

    }
}
