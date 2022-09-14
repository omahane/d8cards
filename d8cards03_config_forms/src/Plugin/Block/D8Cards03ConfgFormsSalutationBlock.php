<?php
namespace Drupal\d8cards03_config_forms\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8cards03_config_forms\D8Cards03ConfigFormsSalutation;
/**
 * D8Cards03 Config Forms Salutation block.
 *
 * @Block(
 *  id = "d8cards03_config_forms_salutation_block",
 *  admin_label = @Translation("D8Cards03 Config Forms salutation"),
 * )
 */
class D8Cards03ConfigFormsSalutationBlock extends BlockBase implements ContainerFactoryPluginInterface {
    /**
     * The salutation service.
     *
     * @var \Drupal\d8cards03_config_forms\D8Cards03ConfigFormsSalutation
     */
    protected $salutation;
    /**
     * Constructs a D8Cards03ConfigFormsSalutationBlock.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, D8Cards03ConfigFormsSalutation $salutation) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->salutation = $salutation;
    }
    /**
     * {@inhertidoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('d8cards03config_forms.salutation')

        );
    }
    /**
     * {@inheritdoc}
     */
    public function build() {
        return [
            '#markup' => $this->salutation->getSalutation(),
        ];
    }
}
