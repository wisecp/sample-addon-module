<?php
    Class SampleAddon extends AddonModule {
        public $version = "1.0";
        function __construct(){
            $this->_name = __CLASS__;
            parent::__construct();
        }

        public function fields(){
            $settings = isset($this->config['settings']) ? $this->config['settings'] : [];
            return [
                'example1'          => [
                    'wrap_width'        => 100,
                    'name'              => "Text Box",
                    'description'       => "Text Box Description",
                    'type'              => "text",
                    'value'             => isset($settings["example1"]) ? $settings["example1"] : "",
                    'placeholder'       => "sample placeholder",
                ],
                'example2'          => [
                    'wrap_width'        => 100,
                    'name'              => "Password Box",
                    'description'       => "Password Box Description",
                    'type'              => "password",
                    'value'             => isset($settings["example2"]) ? $settings["example2"] : "sample",
                    'placeholder'       => "sample placeholder",
                ],
                'example3'          => [
                    'wrap_width'        => 100,
                    'name'              => "Approval Button",
                    'description'       => "Approval Button Description",
                    'type'              => "approval",
                    'checked'           => isset($settings["example3"]) && $settings["example3"] ? true : false,
                ],
                'example4'          => [
                    'wrap_width'        => 100,
                    'name'              => "Dropdown Menu 1",
                    'description'       => "Dropdown Menu 1 Description",
                    'type'              => "dropdown",
                    'options'           => "Option 1,Option 2,Option 3,Option 4",
                    'value'             => isset($settings["example4"]) ? $settings["example4"] : "Option 2",
                ],
                'example5'          => [
                    'wrap_width'        => 100,
                    'name'              => "Dropdown Menu 2",
                    'description'       => "Dropdown Menu 2 Description",
                    'type'              => "dropdown",
                    'options'           => [
                        'opt1'     => "Option 1",
                        'opt2'     => "Option 2",
                        'opt3'     => "Option 3",
                        'opt4'     => "Option 4",
                    ],
                    'value'             => isset($settings["example5"]) ? $settings["example5"] : "opt2",
                ],
                'example6'          => [
                    'wrap_width'        => 100,
                    'name'              => "Circular(Radio) Button 1",
                    'description'       => "Circular(Radio) Button 1",
                    'width'             => 40,
                    'description_pos'   => 'L',
                    'is_tooltip'        => true,
                    'type'              => "radio",
                    'options'           => "Option 1,Option 2,Option 3,Option 4",
                    'value'             => isset($settings["example6"]) ? $settings["example6"] : "Option 2",
                ],
                'example7'          => [
                    'wrap_width'        => 100,
                    'name'              => "Circular(Radio) Button 2",
                    'description'       => "Circular(Radio) Button 2 Description",
                    'description_pos'   => 'L',
                    'is_tooltip'        => true,
                    'type'              => "radio",
                    'options'           => [
                        'opt1'     => "Option 1",
                        'opt2'     => "Option 2",
                        'opt3'     => "Option 3",
                        'opt4'     => "Option 4",
                    ],
                    'value'             => isset($settings["example7"]) ? $settings["example7"] : "opt2",
                ],
                'example8'          => [
                    'wrap_width'        => 100,
                    'name'              => "Text Area",
                    'description'       => "Text Area Description",
                    'rows'              => "3",
                    'type'              => "textarea",
                    'value'             => isset($settings["example8"]) ? $settings["example8"] : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                    'placeholder'       => "sample placeholder",
                ],
            ];
        }

        public function save_fields($fields=[]){
            if(!isset($fields['example1']) || !$fields['example1']){
                $this->error = $this->lang["error1"];
                return false;
            }
            return $fields;
        }

        public function activate(){
            /*
             * Here, you can perform any intervention before the module is activate.
             * If you return boolean (true), the module will be activate.
            */
            return true;
        }

        public function deactivate(){
            /*
             * Here, you can perform any intervention before the module is deactivate.
             * If you return boolean (true), the module will be deactivate.
            */
            return true;
        }

        public function adminArea()
        {
            $action = Filter::init("REQUEST/action","route");
            if(!$action) $action = 'index';

            $variables = [
                'link'              => $this->area_link,  /* https://***..com/admin/tools/addons/SampleAddon */
                'dir_link'          => $this->url,       /* https://***..com/coremio/modules/Addons/SampleAddon/ */
                'dir_path'          => $this->dir,      /* /-- DOCUMENT ROOT --/coremio/modules/Addons/SampleAddon/ */
                'dir_name'          => $this->_name,    /* SampleAddon, */
                'name'              => $this->lang["meta"]["name"], /* Sample Addon */
                'version'           => $this->config["meta"]["version"], /* 1.0 */
                'fields'            => $this->fields(),
            ];

            return [
                'page_title'        => 'Sample Addon Module',
                'breadcrumbs'       => [
                    [
                        'link'      => '',
                        'title'     => 'Sample Addon',
                    ],
                ],
                'content'           => $this->view($action.".php",$variables)
            ];
        }

        public function clientArea()
        {
            $action = Filter::init("REQUEST/action","route");
            if(!$action) $action = 'index';

            $variables = [
                'link'              => $this->area_link,  /* https://***..com/addon/SampleAddon/client */
                'dir_link'          => $this->url,       /* https://***..com/coremio/modules/Addons/SampleAddon/ */
                'dir_path'          => $this->dir,      /* /-- DOCUMENT ROOT --/coremio/modules/Addons/SampleAddon/ */
                'dir_name'          => $this->_name,    /* SampleAddon, */
                'name'              => $this->lang["meta"]["name"], /* Sample Addon */
                'version'           => $this->config["meta"]["version"], /* 1.0 */
                'fields'            => $this->fields(),
            ];

            return [
                'page_title'        => 'Sample Addon Module',
                'breadcrumbs'       => [
                    [
                        'link'      => '',
                        'title'     => 'Sample Addon',
                    ],
                ],
                'content'           => $this->view($action.".php",$variables)
            ];
        }

        public function upgrade(){
            if($this->config["meta"]["version"] < 1.1)
            {
                /*
                 * Modules::$init->db->query("ALTER TABLE md_SampleAddon ADD test1 varchar(255);"); # PDO::query()
                */
            }
            elseif($this->config["meta"]["version"] < 1.2)
            {
                /*
                 * Modules::$init->db->query("ALTER TABLE md_SampleAddon ADD test2 varchar(255);"); # PDO::query()
                */
            }

            /*
             * If you want to give an error:
             * $this->error = "sample error text here";
             * return false;
            */

            return true;
        }

        public function main()
        {
            $action = Filter::init("REQUEST/action","route");
            if(!$action) $action = 'index';

            $variables = [
                'link'              => $this->area_link,  /* https://***..com/addon/SampleAddon/client */
                'dir_link'          => $this->url,       /* https://***..com/coremio/modules/Addons/SampleAddon/ */
                'dir_path'          => $this->dir,      /* /-- DOCUMENT ROOT --/coremio/modules/Addons/SampleAddon/ */
                'dir_name'          => $this->_name,    /* SampleAddon, */
                'name'              => $this->lang["meta"]["name"], /* Sample Addon */
                'version'           => $this->config["meta"]["version"], /* 1.0 */
                'fields'            => $this->fields(),
            ];

            return [
                'use_with_theme'   => true,
                'header_background' => 'https://pixabay.com/get/54e8d4404e5aab14f6d1867dda6d49214b6ac3e456567641752d73d592/nature-2813487_1920.jpg',
                'page_title'        => 'Sample Addon Module',
                'breadcrumbs'       => [
                    [
                        'link'      => '',
                        'title'     => 'Sample Addon',
                    ],
                ],
                'content'           => $this->view($action.".php",$variables)
            ];
        }

    }