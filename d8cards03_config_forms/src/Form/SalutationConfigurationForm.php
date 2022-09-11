<?php

namespace Drupal\d8cards03_config_forms\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Confifuration form definition for the salutation message.
 */
class SalutationConfigurationForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['d8cards03_config_forms.custom_salutation'];
    }
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'salutation_configuration_form';
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('d8cards03_config_forms.custom_salutation');
        $form['salutation'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Salutation'),
            '#description' => $this->t('Please provide the salutation you want to use.'),
            '#default_value' => $config->get('salutation'),
        );
        return parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('d8cards03_config_forms.custom_salutation')
        ->set('salutation', $form_state->getValue('salutation'))
        ->save();
        parent::submitForm($form, $form_state);
    }
}
