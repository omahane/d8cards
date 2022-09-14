<?php

namespace Drupal\d8cards03_config_forms;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;



/**
 * Prepares the salutation to the world
 */
class D8Cards03ConfigFormsSalutation {

    /**
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected $configFactory;

    /**
     * D8Cards03ConfigFormsSalutation constructor
     *
     * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
     */
    public function __construct(ConfigFactoryInterface $config_factory) {
        // Sets the config factory service on a property.
        $this->configFactory = $config_factory;
    }

    use StringTranslationTrait;
    /**
     * Returns the salutation
     */
    public function getSalutation() {
        // Loads the configuration object saved in the form.
        $config = $this->configFactory->get('d8cards03_config_forms.custom_salutation');
        // Assigns the salutation from the form from the key in the form.
        $salutation = $config->get('salutation');
        if ($salutation !== "" && $salutation) {
            return $salutation;
        }
        $time = new \DateTime();
        \Drupal::logger('d8cards0_3config_forms')->notice('The time is @time.',
        array(
            '@time' => (int) $time->format('G'),
        ));
        // return $this->t('Good morning, world.');

        if((int) $time->format('G') >= 0 && (int) $time->format('G') < 12) {
            return $this->t('Good morning, world.');
        }
        if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
            return $this->t('Good afternoon, world.');
        }
        if ((int) $time->format('G') >= 18) {
            return $this->t('Good evening, world.');
        }
    }
}
