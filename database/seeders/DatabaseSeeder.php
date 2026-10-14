<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['sku' => 'MED-AMX-001', 'name' => 'Amoxicillin 500mg', 'category' => 'Antibiotics', 'quantity' => 150, 'reorder_level' => 20, 'price' => 12.50],
            ['sku' => 'MED-LIS-002', 'name' => 'Lisinopril 10mg', 'category' => 'Cardiovascular', 'quantity' => 4, 'reorder_level' => 10, 'price' => 8.00],
            ['sku' => 'MED-PAR-003', 'name' => 'Paracetamol 500mg', 'category' => 'Analgesics', 'quantity' => 300, 'reorder_level' => 50, 'price' => 5.00],
            ['sku' => 'MED-MET-004', 'name' => 'Metformin 850mg', 'category' => 'Antidiabetic', 'quantity' => 3, 'reorder_level' => 15, 'price' => 15.00],
            ['sku' => 'MED-IBU-005', 'name' => 'Ibuprofen 400mg', 'category' => 'Analgesics', 'quantity' => 80, 'reorder_level' => 25, 'price' => 7.50],
            ['sku' => 'MED-CET-006', 'name' => 'Cetirizine 10mg', 'category' => 'Antihistamine', 'quantity' => 5, 'reorder_level' => 10, 'price' => 6.00],
            ['sku' => 'MED-MEF-007', 'name' => 'Mefenamic Acid 500mg', 'category' => 'Analgesics', 'quantity' => 45, 'reorder_level' => 15, 'price' => 9.50],
            ['sku' => 'MED-VIT-008', 'name' => 'Ascorbic Acid (Vitamin C)', 'category' => 'Vitamins', 'quantity' => 200, 'reorder_level' => 30, 'price' => 3.50],
            ['sku' => 'MED-MVI-009', 'name' => 'Multavitamins + Iron', 'category' => 'Vitamins', 'quantity' => 2, 'reorder_level' => 10, 'price' => 15.00],
            ['sku' => 'MED-LOP-010', 'name' => 'Loperamide 2mg', 'category' => 'Antidiarrheal', 'quantity' => 60, 'reorder_level' => 20, 'price' => 4.00],
            ['sku' => 'SUP-ORS-011', 'name' => 'Oral Rehydration Salts', 'category' => 'Supplements', 'quantity' => 100, 'reorder_level' => 25, 'price' => 18.00],
            ['sku' => 'MED-LOS-012', 'name' => 'Losartan 50mg', 'category' => 'Cardiovascular', 'quantity' => 8, 'reorder_level' => 15, 'price' => 10.00],
            ['sku' => 'MED-AML-013', 'name' => 'Amlodipine 5mg', 'category' => 'Cardiovascular', 'quantity' => 90, 'reorder_level' => 20, 'price' => 7.50],
            ['sku' => 'MED-SAL-014', 'name' => 'Salbutamol Nebule', 'category' => 'Respiratory', 'quantity' => 35, 'reorder_level' => 10, 'price' => 25.00],
            ['sku' => 'SUP-ALC-015', 'name' => 'Alcohol 70% Isopropyl (500ml)', 'category' => 'Antiseptic', 'quantity' => 18, 'reorder_level' => 10, 'price' => 75.00],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['sku' => $prod['sku']], $prod);
        }
    }
}