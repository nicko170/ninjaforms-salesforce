<?php

namespace NinjaformsSalesforce;

class NinjaformsSalesforce {
        public static array $options = [
            'nfsalesforce_domain', 'nfsalesforce_username', 'nfsalesforce_password', 'nfsalesforce_client_id',
            'nfsalesforce_client_secret', 'nfsalesforce_security_token'
        ];

        private static NinjaformsSalesforce $instance;

        public static function getInstance():NinjaformsSalesforce
        {
            return static::$instance;
        }

        public static function setInstance(NinjaformsSalesforce $nfsalesforce)
        {
            static::$instance = $nfsalesforce;
        }

        public function init()
        {
            foreach(self::$options as $key){
                add_option($key);
            }

            // used in ninjaforms custom action, and posts name / email to salesforce newsletter
            add_action( 'ninja_forms_salesforce_action', [$this, 'process_ninja_forms_salesforce_entry'] );

            // Builds admin settings pages
            add_action('admin_init', [$this, 'admin_settings_post']);
            add_action('admin_menu', [$this, 'register_admin_menu']);
        }

        public function admin_settings_post() : void
        {
            if (isset($_POST['nfsalesforce'])) {
                if ( ! apply_filters( 'ninja_forms_admin_menu_capabilities', 'manage_options' ) ) {
                    wp_die(__('You do not have sufficient permissions to access this page.'));
                }

                $data = $_POST['nfsalesforce'];

                foreach(self::$options as $key){
                    update_option($key, $data[$key]);
                }

            }
        }

        public function register_admin_menu()
        {
            add_submenu_page('ninja-forms', 'Pardot Integration', 'Pardot Integration', apply_filters( 'ninja_forms_admin_menu_capabilities', 'manage_options' ), 'ninja-forms-pardot-settings', [$this, 'settings_view']);
        }

        public function settings_view()
        {
            $data = [];
            foreach(self::$options as $key){
                $data[$key] = get_option($key);
            }
            return include __DIR__.'/../views/settings.php';
        }

        public function process_ninja_forms_salesforce_entry($form_data) : void
        {
            $firstName = '';
            $lastName = '';
            $email = '';

            var_dump($form_data['fields']);
            foreach($form_data['fields'] as $field){
                if($field['label'] === 'First Name') $firstName = $field['value'];
                if($field['label'] === 'Last Name') $lastName = $field['value'];
                if($field['label'] === 'Email') $email = $field['value'];
            }

            if(!$firstName || !$lastName || ! $email){
                return;
            }

            $response = wp_remote_post(
                'https://internet.my.salesforce.com/services/oauth2/token',
                [
                    'method' => 'POST',
                    'body' => [
                        'grant_type' => 'password',
                        'client_id' => get_option('nfsalesforce_client_id'),
                        'client_secret' => get_option('nfsalesforce_client_secret'),
                        'username' => get_option('nfsalesforce_username'),
                        'password' => get_option('nfsalesforce_password') . get_option('nfsalesforce_security_token'),
                    ],
                ]
            );

            $response = json_decode(wp_remote_retrieve_body($response));

            $result = wp_remote_post("$response->instance_url/services/data/v53.0/composite/",
                [
                     'method' => 'POST',
                    'headers' => [
                        'Authorization' => "$response->token_type $response->access_token",
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode([
                      'allOrNone' => true,
                      'compositeRequest' =>  [
                          [
                              'method' => 'PATCH',
                              'url' => '/services/data/v53.0/sobjects/Account/Portal_id__c/ID999999999',
                              'referenceId' => 'NewAccount',
                              'body' => ['name' => 'Website Newsletter Subscribers']
                          ],
                          [
                              'method' => 'POST',
                              'url' => '/services/data/v53.0/sobjects/Contact',
                              'referenceId' => 'NewContact',
                              'body' => [
                                  'FirstName' => $firstName,
                                  'LastName' => $lastName,
                                  'Email' => $email,
                                  'AccountId' => '@{NewAccount.id}',
                                  'NewsletterSubscriber__c' => true
                              ]
                          ]
                      ],
                  ])
                ]
            );
        }
}
