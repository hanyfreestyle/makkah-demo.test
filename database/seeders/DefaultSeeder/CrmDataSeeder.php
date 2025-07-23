<?php

namespace Database\Seeders\DefaultSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CrmDataSeeder extends Seeder {
    public function run(): void {
        loadSeederFromClientOrDef('data_lead_source', 'var_crm_data/');
        loadSeederFromClientOrDef('data_unit_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_service_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_delivery_date', 'var_crm_data/');
        loadSeederFromClientOrDef('data_contact_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_contact_time', 'var_crm_data/');
        loadSeederFromClientOrDef('data_following_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_developer', 'var_crm_data/');
        loadSeederFromClientOrDef('data_unit_area', 'var_crm_data/');
        loadSeederFromClientOrDef('data_district', 'var_crm_data/');
        loadSeederFromClientOrDef('data_campaign', 'var_crm_data/');
        loadSeederFromClientOrDef('data_payment_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_finishing_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_furnished_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_lead_source_sub', 'var_crm_data/');
        loadSeederFromClientOrDef('data_customer_type', 'var_crm_data/');
        loadSeederFromClientOrDef('data_customer_evaluation', 'var_crm_data/');
        loadSeederFromClientOrDef('data_project', 'var_crm_data/');
        loadSeederFromClientOrDef('data_floor_type', 'var_crm_data/');
    }
}
