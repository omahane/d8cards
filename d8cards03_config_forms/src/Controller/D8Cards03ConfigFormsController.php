<?php

namespace Drupal\d8cards03_config_forms\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\d8cards03_config_forms\D8Cards03ConfigFormsSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the salutation message.
 */
class D8Cards03ConfigFormsController extends ControllerBase {
    /**
     * @var \Drupal\d8cards03_config_forms\D8Cards03ConfigFormsSalutation
     *
     */
    protected $salutation;

    /**
     * D8Cards03ConfigFormsController constructor.
     *
     * @param \Drupal\d8cards03_config_forms\D8Cards03ConfigFormsSalutation $salutation
     *   The salutation service.
     */
    public function __construct(D8Cards03ConfigFormsSalutation $salutation) {
        $this->salutation = $salutation;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('d8cards03_config_forms.salutation')
        );
    }

    /**
     * Hello World.
     *
     * @return array
     *   Our message
     */
    public function helloWorld() {
        return [
            '#markup' => $this->salutation->getSalutation(),
        ];
    }
}








