<?php

namespace App\Data;

class PracticeAreas
{
    public static function all(): array
    {
        return [
            [
                'slug' => 'family-law',
                'name' => 'Family Law',
                'icon' => 'users',
                'description' => 'Divorce, custody, inheritance disputes.',
            ],
            [
                'slug' => 'business-law',
                'name' => 'Business Law',
                'icon' => 'briefcase',
                'description' => 'Company formation, contracts, compliance.',
            ],
            [
                'slug' => 'real-estate',
                'name' => 'Real Estate',
                'icon' => 'home',
                'description' => 'Property transactions, titles, leasing.',
            ],
            [
                'slug' => 'criminal-defense',
                'name' => 'Criminal Defense',
                'icon' => 'shield',
                'description' => 'Legal representation and defense.',
            ],
            [
                'slug' => 'labor-law',
                'name' => 'Labor Law',
                'icon' => 'hard-hat',
                'description' => 'Employment contracts and disputes.',
            ],
            [
                'slug' => 'civil-litigation',
                'name' => 'Civil Litigation',
                'icon' => 'scale',
                'description' => 'Civil disputes and claims.',
            ],
        ];
    }
}
