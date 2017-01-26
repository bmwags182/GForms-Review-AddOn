<?php

/**
 * Get available fields and return as an array of options
 * @param  object $form     gavity forms object
 * @return array            field choice options
 */
function get_field_choices($form) {
    foreach ($form['fields'] as $field) {
        $field_title = $field['label'];
        $choice = array(
                        'label' => $field_title,
                        'value' => $field_title,
                        );
        $choices[] = $choice;
    }
    return $choices;
}
