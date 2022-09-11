<?php

namespace Drupal\d8cards03_config_forms;
use Drupal\Core\StringTranslation\StringTranslationTrait;
/**
 * Prepares the salutation to the world
 */
class D8Cards03ConfigFormsSalutation {
    use StringTranslationTrait;
    /**
     * Returns the salutation
     */
    public function getSalutation() {
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
