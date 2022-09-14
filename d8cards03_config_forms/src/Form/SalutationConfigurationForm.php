<?php

namespace Drupal\d8cards03_config_forms\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form definition for the salutation message.
 */
class SalutationConfigurationForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    // This function is returning an array of the config names we are editing.
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
        // This assignment loads our editable configuration object from the Drupal configuration factory
        // and check the value currently stored in it.
        $config = $this->config('d8cards03_config_forms.custom_salutation');
        // Defining our form elements.
        $form['salutation'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Salutation'),
            '#description' => $this->t('Please provide the salutation you want to use.'),
            // The value present when the user goes to the form.
            '#default_value' => $config->get('salutation'),
        );
        // Provides the form submit button.
        return parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    // This is the submit handler.
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // Loads the config to set and save it.
        $this->config('d8cards03_config_forms.custom_salutation')
        ->set('salutation', $form_state->getValue('salutation'))
        ->save();
        // After submitting, sends a confirmation message to the user
        parent::submitForm($form, $form_state);
    }
}
