<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;



class IndustrySeeder extends Seeder
{
    private $industries = [
        "Advisory and Financial Services",
        "BPO (Business Process Outsourcing)",
        "Call Center",
        "Education & Training",
        "Food & Beverages",
        "Government & Public Relations",
        "Medical & Healthcare",
        "Mining, Metal & Chemicals",
        "Property & Real Estate",
        "Travel ,Tourism & Transportation",
        "Enforcement & Security",
        "Entertainment & Events",
        "Shipping & Logistics",
        "Hospitality & Hotel",
        "Manufacturing & Warehousing",
        "Law & Compliance",
        "IT & Telecom",
        "Automotive & Aviation",
        "Energy & Utilities",
        "Retail, Fashion & FMCG",
        "Advertising, Media & Communications",
        "Agriculture",
        "Banking, Micro-finance & Insurance",
        "NGO, NPO & Charity",
        "Construction & Engineering",
        "Recruitment",
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->industries as $industry) {
            DB::table('industries')->insert([
                'name' => $industry
            ]);
        }
    }
}
