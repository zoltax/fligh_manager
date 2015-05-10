<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class ImportShell extends Shell {

    private function truncateCountries(){

        ConnectionManager::get('default')->execute("TRUNCATE countries");

    }

    public function main() {

        $this->truncateCountries();

        $countriesFilePath = 'https://raw.githubusercontent.com/lukes/ISO-3166-Countries-with-Regional-Codes/master/all/all.json';
        $countriesFileContent = file_get_contents($countriesFilePath);
        $countries = json_decode($countriesFileContent);

        foreach ($countries as $countryData) {

            $countryTable = TableRegistry::get('Countries');

            list(,$iso) = explode(':',$countryData->{'iso_3166-2'});

            $country                = $countryTable->newEntity();
            $country->name          = $countryData->name;
            $country->iso           = $iso;
            $country->country_code  = (int)$countryData->{'country-code'};

            $countryTable->save($country);

        }

    }

}