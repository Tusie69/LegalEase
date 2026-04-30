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
                'scenarios' => [
                    "You're going through a divorce and need to figure out child custody.",
                    "You're dealing with an inheritance dispute among siblings.",
                    "You want a prenuptial agreement before getting married.",
                ],
            ],
            [
                'slug' => 'business-law',
                'name' => 'Business Law',
                'icon' => 'briefcase',
                'description' => 'Company formation, contracts, compliance.',
                'scenarios' => [
                    "You're starting a company and need help with incorporation.",
                    "You need a vendor contract reviewed before signing.",
                    "You're navigating a partnership dispute or buyout.",
                ],
            ],
            [
                'slug' => 'real-estate',
                'name' => 'Real Estate',
                'icon' => 'home',
                'description' => 'Property transactions, titles, leasing.',
                'scenarios' => [
                    "You're buying or selling property and need a title check.",
                    "You're entering a commercial lease and want a clear walkthrough.",
                    "You're disputing a property boundary with a neighbor.",
                ],
            ],
            [
                'slug' => 'criminal-defense',
                'name' => 'Criminal Defense',
                'icon' => 'shield',
                'description' => 'Legal representation and defense.',
                'scenarios' => [
                    "You've been charged with a crime and need representation.",
                    "You're under investigation and want to understand your rights.",
                    "You're appealing a conviction or sentence.",
                ],
            ],
            [
                'slug' => 'labor-law',
                'name' => 'Labor Law',
                'icon' => 'hard-hat',
                'description' => 'Employment contracts and disputes.',
                'scenarios' => [
                    "You were terminated and you think it wasn't justified.",
                    "Your contract isn't following Vietnam labor regulations.",
                    "You have unpaid wages or unresolved BHXH issues.",
                ],
            ],
            [
                'slug' => 'civil-litigation',
                'name' => 'Civil Litigation',
                'icon' => 'scale',
                'description' => 'Civil disputes and claims.',
                'scenarios' => [
                    "A contract dispute is escalating and you need to file or defend.",
                    "You're suing or being sued for property damage.",
                    "You're dealing with debt collection on either side.",
                ],
            ],
        ];
    }
}
