<?php
/**
 * Implements hook_views_data().
 */
function letter_query_views_data(){
  $data =[];
  //base data
$data['letter_query']['table']['group'] = t('Letter Query');
  $data['letter_query']['table']['base'] = [
  'title' => t('Letter Query'),
    'query_id' => 'views_letter_query',
    'help' => t('Querying API endpoint for letters'),
  ];

//fields
  $data['letter_query']['title']=[
    'title' => t('Letter Title'),
    'help' => t('Title of the letter'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  $data['letter_query']['field_***']=[
    'title' => t('Note'),
    'help' => t('Letter Note'),
    'field' => [
      'id' => 'standard',
    ],
  ];

return $data;
}
