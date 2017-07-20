<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.5 (https://modulestudio.de).
 */

namespace Zikula\RoutesModule\Form\Type\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\RoutesModule\Entity\Factory\EntityFactory;
use Zikula\RoutesModule\Form\Type\Field\ArrayType;
use Zikula\RoutesModule\Form\Type\Field\MultiListType;
use Zikula\UsersModule\Form\Type\UserLiveSearchType;
use Zikula\RoutesModule\Helper\ListEntriesHelper;

/**
 * Route editing form type base class.
 */
abstract class AbstractRouteType extends AbstractType
{
    use TranslatorTrait;

    /**
     * @var EntityFactory
     */
    protected $entityFactory;

    /**
     * @var ListEntriesHelper
     */
    protected $listHelper;

    /**
     * RouteType constructor.
     *
     * @param TranslatorInterface $translator    Translator service instance
     * @param EntityFactory       $entityFactory EntityFactory service instance
     * @param ListEntriesHelper   $listHelper    ListEntriesHelper service instance
     */
    public function __construct(
        TranslatorInterface $translator,
        EntityFactory $entityFactory,
        ListEntriesHelper $listHelper
    ) {
        $this->setTranslator($translator);
        $this->entityFactory = $entityFactory;
        $this->listHelper = $listHelper;
    }

    /**
     * Sets the translator.
     *
     * @param TranslatorInterface $translator Translator service instance
     */
    public function setTranslator(/*TranslatorInterface */$translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addEntityFields($builder, $options);
        $this->addModerationFields($builder, $options);
        $this->addReturnControlField($builder, $options);
        $this->addSubmitButtons($builder, $options);
    }

    /**
     * Adds basic entity fields.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function addEntityFields(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('bundle', TextType::class, [
            'label' => $this->__('Bundle') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the bundle of the route')
            ],
            'required' => true,
        ]);
        
        $builder->add('controller', TextType::class, [
            'label' => $this->__('Controller') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the controller of the route')
            ],
            'required' => true,
        ]);
        
        $builder->add('action', TextType::class, [
            'label' => $this->__('Action') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the action of the route')
            ],
            'required' => true,
        ]);
        
        $builder->add('path', TextType::class, [
            'label' => $this->__('Path') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the path of the route')
            ],
            'required' => true,
        ]);
        
        $builder->add('host', TextType::class, [
            'label' => $this->__('Host') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the host of the route')
            ],
            'required' => false,
        ]);
        
        $listEntries = $this->listHelper->getEntries('route', 'schemes');
        $choices = [];
        $choiceAttributes = [];
        foreach ($listEntries as $entry) {
            $choices[$entry['text']] = $entry['value'];
            $choiceAttributes[$entry['text']] = ['title' => $entry['title']];
        }
        $builder->add('schemes', MultiListType::class, [
            'label' => $this->__('Schemes') . ':',
            'label_attr' => [
                'class' => 'checkbox-inline'
            ],
            'empty_data' => 'http',
            'attr' => [
                'class' => '',
                'title' => $this->__('Choose the schemes')
            ],
            'required' => true,
            'choices' => $choices,
            'choices_as_values' => true,
            'choice_attr' => $choiceAttributes,
            'multiple' => true,
            'expanded' => true
        ]);
        
        $listEntries = $this->listHelper->getEntries('route', 'methods');
        $choices = [];
        $choiceAttributes = [];
        foreach ($listEntries as $entry) {
            $choices[$entry['text']] = $entry['value'];
            $choiceAttributes[$entry['text']] = ['title' => $entry['title']];
        }
        $builder->add('methods', MultiListType::class, [
            'label' => $this->__('Methods') . ':',
            'label_attr' => [
                'class' => 'checkbox-inline'
            ],
            'empty_data' => 'GET',
            'attr' => [
                'class' => '',
                'title' => $this->__('Choose the methods')
            ],
            'required' => true,
            'choices' => $choices,
            'choices_as_values' => true,
            'choice_attr' => $choiceAttributes,
            'multiple' => true,
            'expanded' => true
        ]);
        
        $builder->add('prependBundlePrefix', CheckboxType::class, [
            'label' => $this->__('Prepend bundle prefix') . ':',
            'attr' => [
                'class' => '',
                'title' => $this->__('prepend bundle prefix ?')
            ],
            'required' => false,
        ]);
        
        $builder->add('translatable', CheckboxType::class, [
            'label' => $this->__('Translatable') . ':',
            'attr' => [
                'class' => '',
                'title' => $this->__('translatable ?')
            ],
            'required' => false,
        ]);
        
        $builder->add('translationPrefix', TextType::class, [
            'label' => $this->__('Translation prefix') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the translation prefix of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('defaults', ArrayType::class, [
            'label' => $this->__('Defaults') . ':',
            'help' => $this->__('Enter one entry per line.'),
            'empty_data' => '',
            'attr' => [
                'class' => '',
                'title' => $this->__('Enter the defaults of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('requirements', ArrayType::class, [
            'label' => $this->__('Requirements') . ':',
            'help' => $this->__('Enter one entry per line.'),
            'empty_data' => '',
            'attr' => [
                'class' => '',
                'title' => $this->__('Enter the requirements of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('options', ArrayType::class, [
            'label' => $this->__('Options') . ':',
            'help' => $this->__('Enter one entry per line.'),
            'empty_data' => '',
            'attr' => [
                'class' => '',
                'title' => $this->__('Enter the options of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('condition', TextType::class, [
            'label' => $this->__('Condition') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the condition of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('description', TextType::class, [
            'label' => $this->__('Description') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the description of the route')
            ],
            'required' => false,
        ]);
        
        $builder->add('sort', IntegerType::class, [
            'label' => $this->__('Sort') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 11,
                'class' => ' validate-digits',
                'title' => $this->__('Enter the sort of the route.') . ' ' . $this->__('Only digits are allowed.')
            ],
            'required' => false,
            'scale' => 0
        ]);
    }

    /**
     * Adds special fields for moderators.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function addModerationFields(FormBuilderInterface $builder, array $options)
    {
        if (!$options['has_moderate_permission']) {
            return;
        }
    
        $builder->add('moderationSpecificCreator', UserLiveSearchType::class, [
            'mapped' => false,
            'label' => $this->__('Creator') . ':',
            'attr' => [
                'maxlength' => 11,
                'class' => ' validate-digits',
                'title' => $this->__('Here you can choose a user which will be set as creator')
            ],
            'empty_data' => 0,
            'required' => false,
            'help' => $this->__('Here you can choose a user which will be set as creator')
        ]);
        $builder->add('moderationSpecificCreationDate', DateTimeType::class, [
            'mapped' => false,
            'label' => $this->__('Creation date') . ':',
            'attr' => [
                'class' => '',
                'title' => $this->__('Here you can choose a custom creation date')
            ],
            'empty_data' => '',
            'required' => false,
            'with_seconds' => true,
            'date_widget' => 'single_text',
            'time_widget' => 'single_text',
            'help' => $this->__('Here you can choose a custom creation date')
        ]);
    }

    /**
     * Adds the return control field.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function addReturnControlField(FormBuilderInterface $builder, array $options)
    {
        if ($options['mode'] != 'create') {
            return;
        }
        $builder->add('repeatCreation', CheckboxType::class, [
            'mapped' => false,
            'label' => $this->__('Create another item after save'),
            'required' => false
        ]);
    }

    /**
     * Adds submit buttons.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function addSubmitButtons(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['actions'] as $action) {
            $builder->add($action['id'], SubmitType::class, [
                'label' => $action['title'],
                'icon' => ($action['id'] == 'delete' ? 'fa-trash-o' : ''),
                'attr' => [
                    'class' => $action['buttonClass']
                ]
            ]);
        }
        $builder->add('reset', ResetType::class, [
            'label' => $this->__('Reset'),
            'icon' => 'fa-refresh',
            'attr' => [
                'class' => 'btn btn-default',
                'formnovalidate' => 'formnovalidate'
            ]
        ]);
        $builder->add('cancel', SubmitType::class, [
            'label' => $this->__('Cancel'),
            'icon' => 'fa-times',
            'attr' => [
                'class' => 'btn btn-default',
                'formnovalidate' => 'formnovalidate'
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'zikularoutesmodule_route';
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                // define class for underlying data (required for embedding forms)
                'data_class' => 'Zikula\RoutesModule\Entity\RouteEntity',
                'empty_data' => function (FormInterface $form) {
                    return $this->entityFactory->createRoute();
                },
                'error_mapping' => [
                    'isSchemesValueAllowed' => 'schemes',
                    'isMethodsValueAllowed' => 'methods',
                ],
                'mode' => 'create',
                'actions' => [],
                'has_moderate_permission' => false,
            ])
            ->setRequired(['mode', 'actions'])
            ->setAllowedTypes('mode', 'string')
            ->setAllowedTypes('actions', 'array')
            ->setAllowedTypes('has_moderate_permission', 'bool')
            ->setAllowedValues('mode', ['create', 'edit'])
        ;
    }
}
