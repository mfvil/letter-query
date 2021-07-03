<?php

namespace Drupal\letter_query\Plugin\views\query;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\query\QueryPluginBase;
use Drupal\views\Annotation\ViewsQuery;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Views query plugin
 *
 * @ViewsQuery(
 *   id = "views_letter_query",
 *   title = @Translation("Letter Query"),
 *   help = @Translation("Query against the API.")
 * )
 */

class ViewsLetterQuery extends QueryPluginBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\letter_query\Plugin\views\letterQueryClient
   */
  protected $letterQueryClient;


  /**
   * ViewsLetterQuery constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param $letterQueryClient \Drupal\letter_query\Plugin\views\letterQueryClient
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $letterQueryClient) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->letterQueryClient = $letterQueryClient;

  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('letter_query_client')

    );
  }

  public function execute(ViewExecutable $view) {
    $index = 0;
    if ($letter_items = $this->letterQueryClient->getLetters())
    {
      foreach ($letter_items as $letter_item) {
        $row['title'] = $letter_item['title'];
        $row['field_note'] = $letter_item['field_****'];
        $row['index'] = $index++;
        $view->result[] = new ResultRow($row);

      }

    }


  }

/**
*Bypass checks for database table as we are connecting to a remote endpoint
**/

  public function ensureTable($table, $relationship = NULL) {
    return '';
  }

  public function addField($table, $field, $alias = '', $params = []) {
    return $field;
  }
}
