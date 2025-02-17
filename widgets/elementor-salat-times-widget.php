<?php
if (!defined('ABSPATH')) exit;

class Elementor_Salat_Times_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'salat_times';
    }

    public function get_title() {
        return __('Salat Times', 'salat-times');
    }

    public function get_icon() {
        return 'eicon-clock-o';
    }

    public function get_categories() {
        return ['salat-times'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'salat-times'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'widget_width',
            [
                'label' => __('Widget Width', 'salat-times'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '100%',
                'options' => [
                    '300px' => __('300px', 'salat-times'),
                    '400px' => __('400px', 'salat-times'),
                    '500px' => __('500px', 'salat-times'),
                    '100%' => __('100% (Responsive)', 'salat-times'),
                ],
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Styles', 'salat-times'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .salat-times-widget',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Get existing options
        $st_options = get_option("st_options");
        if (!is_array($st_options)) {
            $st_options = array();
        }
        
        // Override width if set in Elementor
        if (isset($settings['widget_width'])) {
            $st_options['width'] = $settings['widget_width'];
        }
        
        // Output the prayer times
        echo '<div class="elementor-salat-times">';
        echo daily_salat_times();
        echo '</div>';
    }
}
